<?php

namespace App\Http\Controllers\Etudiant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 
use App\Models\enseignant;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Models\cours;
use App\Models\Note;
use App\Models\Evaluation;
use App\Models\Admin;
use App\Models\Reclamation;
use Carbon\Carbon; // Ajoutez en haut du fichier

class DashboardController extends Controller
    {
        public function etudiant()

        {
            $etudiant = Auth::guard('etudiant')->user(); // Ou une logique pour obtenir l'étudiant connecté

        return view('etudiant.dashboardetd', compact('etudiant'));
        //test
        if (!$etudiant) {
            return redirect()->route('login');  // Rediriger si l'étudiant n'est pas connecté
        }
    
        return view('etudiant.dashboardetd', compact('etudiant'));  // Passer la variable $etudiant à la vue
    }
        
        /*public function etudiant()
{
    $etudiant = Auth::user(); // récupère l'étudiant connecté
    return view('etudiant.etudiantdash', compact('etudiant')); // Passe $etudiant à la vue
}*/
         public function index()
    {
        // Récupérer l'étudiant actuellement connecté via le guard 'etudiant'
        $etudiant = Auth::guard('etudiant')->user();

        // Retourner la vue avec les données de l'étudiant
        return view('etudiant.dashboardetd', compact('etudiant'));
    }
/*public function mesCours()
{
    if (!Auth::guard('etudiant')->check()) {
        return redirect()->route('etudiant.login');
    }

    return view('etudiant.cours');
}*/

public function login(Request $request)
    {
        // Validation des champs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Tentative d'authentification
        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('etudiant')->attempt($credentials, $request->remember)) {
            // Régénération de la session pour prévenir le fixation attack
            $request->session()->regenerate();
            
            // Récupération de l'étudiant connecté
            $etudiant = Auth::guard('etudiant')->user();
            
            // Redirection vers le dashboard avec message de succès
            return redirect()->intended(route('etudiant.dashboard'))
                            ->with('success', 'Bienvenue ' . $etudiant->prénom . ' !');
        }

        // Si l'authentification échoue
        return back()->withErrors([
            'email' => 'Identifiants incorrects ou compte inexistant.',
        ])->onlyInput('email');
    }
    public function authenticated(Request $request, $user)
{
    if ($user->isEtudiant()) {
        return redirect()->route('etudiant.dashboard'); // Assurez-vous que la route existe
    }

    // Autres redirections selon le rôle
}
public function mescours()
    {
        // Récupérer l'étudiant connecté (vous devrez adapter selon votre système d'authentification)
        $etudiant = auth()->user();
        
        // Récupérer les cours de l'étudiant (supposons une relation many-to-many via une table pivot)
        $cours = $etudiant->cours()->paginate(6);
        
        return view('etudiant.cours', compact('cours'));
    }
        
/*public function indexForStudents(Request $request)
{
    // Debug 1: Vérifier si la requête retourne des cours
    $allCourses = Cours::all();
    Log::info('Total courses in DB: '.$allCourses->count());
    
    // Récupère tous les cours publics avec pagination
    $cours = Cours::with(['enseignant'])
                  //->where('est_public', true)
                  ->orderBy('created_at', 'desc')
                  ->paginate(9);
    
    // Debug 2: Vérifier les cours publics
    Log::info('Public courses count: '.$cours->count());
    Log::info('Public courses: '.$cours);
    
    // Si l'étudiant est connecté
        if (auth()->guard('etudiant')->check()) {

        // Debug 3: Vérifier l'utilisateur connecté
        Log::info('Current user: '.auth()->user()->id_etudiant);
        
        // Chargement efficace des cours suivis
        $coursSuivis = auth()->user()->cours()->pluck('cours.id_cours')->toArray();
        Log::info('Followed courses: '.json_encode($coursSuivis));
        
        // Ajout de l'information isFollowing à chaque cours
        $cours->getCollection()->transform(function ($cour) use ($coursSuivis) {
            $cour->isFollowing = in_array($cour->id_cours, $coursSuivis);
            return $cour;
        });
    }
    
    return view('etudiant.etudiant-cours-index', compact('cours'));
}*/
   public function followCourse($id_cours)
    {
        $etudiant = Auth::guard('etudiant')->user();
        
        if (!$etudiant) {
            return redirect()->route('etudiant.login');
        }
        
        if ($etudiant->cours()->where('cours.id_cours', $id_cours)->exists()) {
            return back()->with('error', 'Vous suivez déjà ce cours.');
        }
        
        $etudiant->cours()->attach($id_cours);
        
        return back()->with('success', 'Cours ajouté à votre liste avec succès.');
    }
   /* public function indexForStudents(Request $request)
    {
        $cours = Cours::with(['enseignant'])
                      ->where('est_public', true)
                      ->orderBy('created_at', 'desc')
                      ->paginate(9);
        
        $coursSuivis = [];
        
        if (Auth::guard('etudiant')->check()) {
            $etudiant = Auth::guard('etudiant')->user();
            $coursSuivis = $etudiant->cours->pluck('id_cours')->toArray();
        }
        
        return view('etudiant.etudiant-cours-index', [
            'cours' => $cours,
            'coursSuivis' => $coursSuivis
        ]);
    }*/
    public function indexForStudents(Request $request)
{
    $cours = Cours::where('est_public', true)
                  ->orderBy('created_at', 'desc')
                  ->paginate(9);
    
    $coursSuivis = [];
    
    if (Auth::guard('etudiant')->check()) {
        $etudiant = Auth::guard('etudiant')->user();
        $coursSuivis = $etudiant->cours->pluck('cours.id_cours')->toArray();
    }
    
    return view('etudiant.etudiant-cours-index', [
        'cours' => $cours,
        'coursSuivis' => $coursSuivis
    ]);
}
public function showCours($id_cours)
{
    $cour = Cours::where('id_cours', $id_cours)
                ->where('est_public', 1)
                ->firstOrFail();
$dateFormatted = $cour->date_publication 
        ? Carbon::parse($cour->date_publication)->format('d/m/Y') 
        : 'Date non disponible';
    $coursSuivis = [];
    
    if (Auth::guard('etudiant')->check()) {
        $etudiant = Auth::guard('etudiant')->user();
        $coursSuivis = $etudiant->cours()->pluck('cours.id_cours')->toArray();
    }

    return view('etudiant.show-cours', [
        'cour' => $cour,
        'coursSuivis' => $coursSuivis
    ]);
}

public function updateProgress(Request $request, $coursId)
{
    $etudiant = auth()->user()->etudiant;
    $etudiant->cours()->updateExistingPivot($coursId, [
        'progression' => $request->progress
    ]);
    
    return response()->json(['success' => true]);
}
 public function indexNotes()
{
    $notesDeCours = Auth::guard('etudiant')->user()
                     ->notesDeCours()
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);
                         return view('etudiant.notes', compact('notesDeCours'));

    
}
public function storeNotes(Request $request)
{
    $request->validate(['contenu' => 'required|string']);

    Auth::guard('etudiant')->user()->notes()->create([
        'contenu' => $request->contenu
    ]);

    return redirect()->route('etudiant.notes')->with('success', 'Note enregistrée.');
}
/*public function etudiant_createReclam()
{
    // Récupérer la liste des étudiants (à adapter selon votre logique)
    $enseignants = enseignant::all(); 
    $type = 'etud_vers_prof'; // Définit explicitement le type

    return view('etudiant.create-Reclamation', compact('enseignants','etudiants'));
}*/
public function etudiant_createReclam()
{
    // Récupérer la liste des enseignants
    $enseignants = Enseignant::all();
    
    // Récupérer la liste des étudiants (sauf l'étudiant connecté)
    $etudiants = Etudiant::where('id_etudiant', '!=', auth()->id())->get();
    
    $type = 'etud_vers_prof'; // Valeur par défaut

    return view('etudiant.create-Reclamation', compact('enseignants', 'etudiants', 'type'));
}
public function index_etudiant_reclamation()
{
    // Récupère l'étudiant authentifié
    $etudiant = Auth::guard('etudiant')->user();
    
    // Récupère les réclamations où l'étudiant est concerné
    $reclamations = Reclamation::where(function($query) use ($etudiant) {
            // Réclamations reçues (destinataire)
            $query->where('destinataire_id', $etudiant->id)
                  ->where('destinataire_type', 'App\Models\Etudiant');
        })
        ->orWhere(function($query) use ($etudiant) {
            // Réclamations envoyées (expéditeur)
            $query->where('expediteur_id', $etudiant->id)
                  ->where('expediteur_type', 'App\Models\Etudiant');
        })
        ->with(['expediteur', 'destinataire']) // Chargement des relations
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('etudiant.reclamations', compact('reclamations'));
}
/*public function index_etudiant()
{
    $etudiant = Auth::guard('etudiant')->user();
    
    $reclamations = Reclamation::where(function($query) use ($etudiant) {
            // Réclamations reçues
            $query->where('destinataire_id', $etudiant->id)
                  ->where('destinataire_type', 'App\Models\Etudiant')
                  ->whereIn('type', ['prof_vers_etud', 'etud_vers_etud']);
        })
        ->orWhere(function($query) use ($etudiant) {
            // Réclamations envoyées
            $query->where('expediteur_id', $etudiant->id)
                  ->where('expediteur_type', 'App\Models\Etudiant')
                  ->whereIn('type', ['etud_vers_prof', 'etud_vers_etud']);
        })
        ->with(['expediteur', 'destinataire'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('etudiant.reclamations', compact('reclamations'));
}*/
public function index_etudiant()
{
    $etudiant = Auth::guard('etudiant')->user();

    // Optimisation de la requête avec sélection des colonnes nécessaires
    $reclamations = Reclamation::query()
        ->select([
            'id',
            'contenu',
            'type',
            'statut',
            'expediteur_id',
            'expediteur_type',
            'destinataire_id',
            'destinataire_type',
            'reponse',
            'date_reponse',
            'created_at'
        ])
        ->where(function($query) use ($etudiant) {
            // Réclamations où l'étudiant est destinataire
            $query->where('destinataire_id', $etudiant->id)
                  ->where('destinataire_type', 'App\Models\Etudiant');
        })
        ->orWhere(function($query) use ($etudiant) {
            // Réclamations où l'étudiant est expéditeur
            $query->where('expediteur_id', $etudiant->id)
                  ->where('expediteur_type', 'App\Models\Etudiant');
        })
        ->with([
            'expediteur:id,nom,prenom',
            'destinataire:id,nom,prenom'
        ])
        ->latest()
        ->paginate(10)
        ->through(function ($reclamation) use ($etudiant) {
            // Ajout de métadonnées utiles pour la vue
            $reclamation->is_from_me = $reclamation->expediteur_id === $etudiant->id;
            $reclamation->is_to_me = $reclamation->destinataire_id === $etudiant->id;
            return $reclamation;
        });

    return view('etudiant.reclamations.index', [
        'reclamations' => $reclamations,
        'statistics' => $this->getReclamationStatistics($etudiant)
    ]);
}

protected function getReclamationStatistics($etudiant)
{
    return [
        'total' => Reclamation::where('expediteur_id', $etudiant->id)
                     ->orWhere('destinataire_id', $etudiant->id)
                     ->count(),
        'en_attente' => Reclamation::where(function($q) use ($etudiant) {
                            $q->where('expediteur_id', $etudiant->id)
                              ->orWhere('destinataire_id', $etudiant->id);
                         })
                         ->where('statut', 'en_attente')
                         ->count(),
        'resolues' => Reclamation::where(function($q) use ($etudiant) {
                          $q->where('expediteur_id', $etudiant->id)
                            ->orWhere('destinataire_id', $etudiant->id);
                       })
                       ->where('statut', 'resolue')
                       ->count()
    ];
}
/*public function store(Request $request)
{
    $request->validate([
        'type' => 'required|in:etud_vers_prof,etud_vers_etud',
        'destinataire_id' => 'required|integer',
        'contenu' => 'required|string|min:10|max:1000',
    ]);

    // Vérification cohérence type/destinataire
    $destinataireType = ($request->type === 'etud_vers_prof') ? 'App\Models\Enseignant' : 'App\Models\Etudiant';
    
    $reclamation = Reclamation::create([
        'contenu' => $request->contenu,
        'type' => $request->type,
        'statut' => 'en_attente',
        'expediteur_id' => Auth::id(),
        'expediteur_type' => 'App\Models\Etudiant',
        'destinataire_id' => $request->destinataire_id,
        'destinataire_type' => $destinataireType,
    ]);

    return redirect()->route('etudiant.reclamations')
                     ->with('success', 'Votre réclamation a été envoyée avec succès.');
}*/
public function store(Request $request)
{
    $request->validate([
        'contenu' => 'required|string|min:10|max:1000',
        'type' => 'required|in:etud_vers_prof,etud_vers_etud',
    ]);

    // Trouver l'admin principal (à adapter selon votre structure)
    $admin = Admin::first(); // ou Admin::find(1);

    // Si c'est une réclamation etud_vers_etud, on redirige vers l'admin
    if ($request->type === 'etud_vers_etud') {
        $reclamation = Reclamation::create([
            'contenu' => $request->contenu,
            'type' => 'etud_vers_etud',
            'statut' => 'en_attente',
            'expediteur_id' => Auth::id(),
            'expediteur_type' => 'App\Models\Etudiant',
            'destinataire_id' => $admin->id,
            'destinataire_type' => 'App\Models\Admin',
            'original_destinataire_id' => $request->destinataire_id, // Stocker l'étudiant cible original
            'original_destinataire_type' => 'App\Models\Etudiant',
        ]);
    } else {
        // Réclamation normale vers professeur
        $reclamation = Reclamation::create([
            'contenu' => $request->contenu,
            'type' => $request->type,
            'statut' => 'en_attente',
            'expediteur_id' => Auth::id(),
            'expediteur_type' => 'App\Models\Etudiant',
            'destinataire_id' => $request->destinataire_id,
            'destinataire_type' => 'App\Models\Enseignant',
        ]);
    }

    return redirect()->route('etudiant.reclamations')
                   ->with('success', 'Votre réclamation a été envoyée avec succès.');
}
public function updateParametres(Request $request)
    {
        $etudiant = Auth::guard('etudiant')->user();
    
        if ($request->filled('email')) {
            $etudiant->email = $request->email;
        }
    
        if ($request->filled('password')) {
            $etudiant->password = bcrypt($request->password);
        }
    
        $etudiant->langue_site = $request->input('langue', 'fr');
        $etudiant->statut_en_ligne = $request->has('statut_en_ligne');
                /** @var \App\Models\Etudiant $etudiant */

        $etudiant->save();
    
        return redirect()->back()->with('success', 'Paramètres mis à jour avec succès.');
    }
    public function supprimerCompte()
{
    /** @var \App\Models\Etudiant $etudiant */
    $etudiant = Auth::guard('etudiant')->user();
    Auth::guard('etudiant')->logout();
    $etudiant->delete();

    return redirect()->route('front.index')->with('message', 'Votre compte a été supprimé avec succès.');
}
/*public function logout(Request $request)
{
    Auth::guard('etudiant')->logout(); // Déconnecter l'étudiant

    // Invalider la session et régénérer le token CSRF
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Rediriger avec un message
    return redirect()->route('bienvenue')->with('message', 'Vous avez été déconnecté avec succès.');
}*/
public function destroy(Request $request)
{
    Auth::guard('etudiant')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/')->with('message', 'Vous avez été déconnecté avec succès.');// Redirection vers la page d'accueil
}
    public function indexResultat()
    {
        // Récupérer l'étudiant connecté
                    $etudiant = Auth::guard('etudiant')->user(); // Ou une logique pour obtenir l'étudiant connecté

        // Récupérer les notes de l'étudiant avec les évaluations associées
        $notes = Note::with(['evaluation.cours', 'evaluation.classe'])
            ->where('id_etudiant', $etudiant->id_etudiant)
            ->where('statut', 'publie')
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Récupérer les évaluations auxquelles l'étudiant est inscrit mais sans note publiée
        $evaluationsSansNote = Evaluation::whereHas('classe.etudiants', function($query) use ($etudiant) {
                $query->where('id_etudiant', $etudiant->id_etudiant);
            })
            ->whereDoesntHave('notes', function($query) use ($etudiant) {
                $query->where('id_etudiant', $etudiant->id_etudiant)
                      ->where('statut', 'publie');
            })
            ->where('statut', 'corrige')
            ->get();

        return view('etudiant.Resultats-index', compact('notes', 'evaluationsSansNote'));
    }
    /*public function indexEvaluation()
{
    $etudiant = Auth::guard('etudiant')->user();
    $statut = request()->query('statut');
    
    $query = Evaluation::with(['cours', 'classe', 'enseignant', 'notes' => function($q) use ($etudiant) {
            $q->where('id_etudiant', $etudiant->etudiant->id_etudiant);
        }])
        ->whereHas('classe.etudiants', function($q) use ($etudiant) {
        $q->where('id_etudiant', $etudiant->id_etudiant);

        })
        ->where('est_visible', true);
    
    if ($statut) {
        $query->where('statut', $statut);
    }
    
    $evaluations = $query->orderBy('date_debut')->paginate(6);
    
    return view('etudiant.evaluations-index', compact('evaluations'));
}*/
public function indexEvaluation()
{
    $etudiant = Auth::guard('etudiant')->user();
    
    // Vérification que l'étudiant est bien connecté
    if (!$etudiant) {
        abort(403, 'Non autorisé');
    }

    $statut = request()->query('statut');
    
    $query = Evaluation::with([
            'cours', 
            'classe', 
            'enseignant', 
            'notes' => function($q) use ($etudiant) {
                $q->where('id_etudiant', $etudiant->id_etudiant); // Correction ici
            }
        ])
        ->whereHas('classe.etudiants', function($q) use ($etudiant) {
            $q->where('id_etudiant', $etudiant->id_etudiant);
        })
        ->where('est_visible', true);
    
    if ($statut) {
        $query->where('statut', $statut);
    }
    
    $evaluations = $query->orderBy('date_debut')->paginate(6);
    
    return view('etudiant.evaluations-index', compact('evaluations'));
}
public function show($id)
{
    $evaluation = Evaluation::with([
        'cours',
        'classe',
        'enseignant',
        'notes' => function($q) {
            $q->where('id_etudiant', auth()->guard('etudiant')->id());
        }
    ])->findOrFail($id);

    return view('etudiant.evaluations-show', compact('evaluation'));
}
}