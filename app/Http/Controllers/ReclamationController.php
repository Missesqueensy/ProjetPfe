<?php

namespace App\Http\Controllers;
use App\Models\Reclamation;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Mail\ReclamationResponseMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Etudiant;
class ReclamationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required',
            'type' => 'required|in:prof_vers_etud,etud_vers_prof,etud_vers_etud',
            'destinataire_id' => 'required',
            'destinataire_type' => 'required|in:App\Models\Etudiant,App\Models\Professeur'
        ]);
    
        // Récupération de l'utilisateur authentifié selon son guard
        if (auth()->guard('etudiant')->check()) {
            $expediteur = auth()->guard('etudiant')->user();
            $expediteurType = 'App\Models\Etudiant';
        } elseif (auth()->guard('enseignant')->check()) {
            $expediteur = auth()->guard('enseignant')->user();
            $expediteurType = 'App\Models\enseignant';
        } else {
            abort(403, 'Non autorisé');
        }
    
        Reclamation::create([
            'contenu' => $request->contenu,
            'type' => $request->type,
            'expediteur_id' => $expediteur->id,
            'expediteur_type' => $expediteurType,
            'destinataire_id' => $request->destinataire_id,
            'destinataire_type' => $request->destinataire_type,
            'id' => Admin::first()->id, // À adapter selon votre logique
        ]);
    
        return back()->with('success', 'Réclamation envoyée avec succès');
    }

    public function index()
    {
        $reclamations = Reclamation::with([
                'expediteur' => function($query) {
                    $query->withTrashed(); // Inclut les expéditeurs supprimés
                },
                'destinataire' => function($query) {
                    $query->withTrashed(); // Inclut les destinataires supprimés
                }
            ])
            ->latest()
            ->paginate(10);

        return view('Admin.Réclamations', compact('reclamations'));
    }
    
    public function index_enseignant()
    {
        // Récupère l'enseignant authentifié
        $enseignant = Auth::guard('enseignant')->user();
        
       
        $reclamations = Reclamation::where('destinataire_id', $enseignant->id)
            ->where('destinataire_type', 'App\Models\Enseignant')
            ->where('type', 'etud_vers_prof')
            ->with(['expediteur', 'destinataire']) // Chargement des relations
            ->orderBy('created_at', 'desc')
            ->paginate(10); // 🔁 pagination automatique

        
        return view('enseignant.Réclamations', compact('reclamations'));
    }

    public function show(Reclamation $reclamation)
{
    $reclamation->load(['expediteur', 'destinataire', 'admin']);
    
    return view('Admin.showreclamation', compact('reclamation'));
}

    public function response(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:traité,rejeté',
            'reponse' => 'required|string|min:10'
        ]);

        $reclamation = Reclamation::findOrFail($id);
        
        $reclamation->update([
            'statut' => $request->statut,
            'reponse' => $request->reponse,
            'date_reponse' => now(),
            'admin_id' => auth()->id()
        ]);

        return redirect()->route('reclamations.show', $reclamation->id)
                         ->with('success', 'Réponse enregistrée avec succès');
    }
    
public function showResponseForm(Reclamation $reclamation)
{
    $reclamation->load(['expediteur', 'destinataire']);
    return view('admin.Reclamation.response', compact('reclamation'));
}

public function enseignant_createReclam()
{
    // Récupérer la liste des étudiants (à adapter selon votre logique)
    $etudiants = Etudiant::all(); 
    $type = 'prof_vers_etud'; // Définit explicitement le type

    return view('enseignant.createReclamation', compact('etudiants'));
}

public function enseignant_storeReclam(Request $request)
{
    $request->validate([
        'etudiant_id' => 'required|exists:etudiants,id',
        'contenu' => 'required|string|max:1000',
    ]);

    Reclamation::create([
        'contenu' => $request->contenu,
        'type' => 'prof_vers_etud', // Type spécifique pour cette action
        'statut' => 'en_attente',
        'expediteur_id' => auth()->guard('enseignant')->id(),
        'expediteur_type' => 'App\Models\Enseignant',
        'destinataire_id' => $request->etudiant_id,
        'destinataire_type' => 'App\Models\Etudiant',
    ]);

    return redirect()->route('enseignant.reclamations.index')
         ->with('success', 'Réclamation envoyée à l\'administrateur !');
}
/*public function envoyerReponse(Request $request, Reclamation $reclamation)
{
    $validated = $request->validate([
        'statut' => 'required|in:traité,rejeté,en_cours',
        'reponse' => 'required|string|min:10',
        'notify' => 'sometimes|boolean'
    ]);

    $reclamation->update([
        'statut' => $validated['statut'],
        'reponse' => $validated['reponse'],
        'date_reponse' => now(),
        'admin_id' => auth()->id()
    ]);

    if ($request->notify) {
        Mail::to($reclamation->expediteur->email)
            ->send(new ReclamationResponseMail($reclamation));
    }

    return redirect()->route('admin.reclamations.show', $reclamation)
        ->with('success', 'Réponse enregistrée et notifiée avec succès !');
}*/
public function envoyerReponse(Request $request, Reclamation $reclamation)
{
    // Validation
    $validated = $request->validate([
        'statut' => ['required', 'in:traité,rejeté,en_cours'],
        'reponse' => ['required', 'string', 'min:10'],
        'notify' => ['sometimes', 'boolean']
    ]);

    // Vérification des permissions
    if (!auth()->user()->can('respond-to', $reclamation)) {
        abort(403, 'Action non autorisée');
    }

    // Mise à jour de la réclamation
    $updateData = [
        'statut' => $validated['statut'],
        'reponse' => $validated['reponse'],
        'date_reponse' => now(),
        'admin_id' => auth()->id()
    ];

    // Transaction pour garantir l'intégrité des données
    transaction(function () use ($reclamation, $updateData, $validated) {
        $reclamation->update($updateData);

        // Notification si demandée
        if ($validated['notify'] ?? false) {
            $this->notifyUser($reclamation);
        }
    });

    return redirect()->route('admin.reclamations.show', $reclamation)
        ->with('success', 'Réponse enregistrée' . ($validated['notify'] ? ' et notifiée' : '') . ' avec succès !');
}

/*protected function notifyUser(Reclamation $reclamation)
{
    try {
        Mail::to($reclamation->expediteur->email)
            ->queue(new ReclamationResponseMail($reclamation));
            
        // Alternative pour les notifications en base de données
        $reclamation->expediteur->notify(new ReclamationResponseNotification($reclamation));
    } catch (\Exception $e) {
        error('Échec de la notification', [
            'reclamation' => $reclamation->id,
            'error' => $e->getMessage()
        ]);
    }
}*/
}
