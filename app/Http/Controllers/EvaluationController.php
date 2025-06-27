<?php
namespace App\Http\Controllers;
use App\Models\Classe;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evaluation;
use App\Models\CoursClasse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 


class EvaluationController extends Controller{

    
/*public function create1()
{
    $enseignant = Auth::guard('enseignant')->user();
    
    if (!$enseignant) {
        return redirect()->route('enseignant.login')->with('error', 'Veuillez vous connecter.');
    }

    // Cours avec au moins une classe associée
    $cours = $enseignant->cours()
              ->whereHas('classes')
              ->with('classes')
              ->get();

    // Classes associées aux cours de l'enseignant
    $classes = $enseignant->cours()
               ->with('classes')
               ->get()
               ->pluck('classes')
               ->flatten()
               ->unique('id_classe');

    return view('enseignant.create', [
        'classes' => $classes,
        'cours' => $cours,
        'enseignant' => $enseignant
    ]);
}*/
public function create()
{
    $enseignant = Auth::guard('enseignant')->user();
    
    if (!$enseignant) {
        return redirect()->route('enseignant.login')->with('error', 'Veuillez vous connecter.');
    }

    // Cours avec au moins une classe associée
    $cours = $enseignant->cours()
              ->whereHas('classes')
              ->with(['classes' => function($query) {
                  $query->orderBy('niveau')->orderBy('filiere');
              }])
              ->get();

    // Types d'évaluation disponibles
    $typesEvaluation = [
        'examen' => 'Examen',
        'devoir' => 'Devoir',
        'quiz' => 'Quiz',
        'projet' => 'Projet'
    ];

    // Statuts possibles
    $statuts = [
        'brouillon' => 'Brouillon',
        'programme' => 'Programmé',
        'publie' => 'Publié'
    ];

    return view('enseignant.create_evaluation', [
        'classes' => $cours->pluck('classes')->flatten()->unique('id_classe'),
        'cours' => $cours,
        'typesEvaluation' => $typesEvaluation,
        'statuts' => $statuts,
        'enseignant' => $enseignant
    ]);
}
public function index()
{
    $enseignant = Auth::guard('enseignant')->user();
    
    // Requête de base
    $query = Evaluation::with(['cours', 'classe'])
        ->where('id_enseignant', $enseignant->id_enseignant);
    //liens vers fichiers
    $evaluations = $query->orderBy('date_debut', 'desc')->paginate(10);
    $evaluations->getCollection()->transform(function ($evaluation) {
        if ($evaluation->fichier_consigne) {
            $evaluation->consigne_url = Storage::disk('public')->url('evaluations/consignes/'.$evaluation->fichier_consigne);
        }
        if ($evaluation->fichier_correction) {
            $evaluation->correction_url = Storage::disk('public')->url('evaluations/corrections/'.$evaluation->fichier_correction);
        }
        return $evaluation;
    });


    // Appliquer les filtres
    if(request('cours')) {
        $query->where('id_cours', request('cours'));
    }
    
    if(request('classe')) {
        $query->where('id_classe', request('classe'));
    }
    
    if(request('statut')) {
        $query->where('statut', request('statut'));
    }
    
    if(request('type')) {
        $query->where('type', request('type'));
    }
    
    if(request('date_debut')) {
        $query->where('date_debut', '>=', request('date_debut'));
    }
    
    if(request('date_fin')) {
        $query->where('date_limite', '<=', request('date_fin'));
    }
    
    $evaluations = $query->orderBy('date_debut', 'desc')->paginate(10);

    // Récupérer les cours et classes pour les filtres
    $cours = $enseignant->cours()->pluck('titre', 'id_cours');
    $classes = Classe::whereHas('cours', function($query) use ($enseignant) {
            $query->where('id_enseignant', $enseignant->id_enseignant);
        })
        ->pluck('nom', 'id_classe');

    // Statistiques
    $stats = [
        'total' => $enseignant->evaluations()->count(),
        'a_venir' => $enseignant->evaluations()->where('date_debut', '>', now())->count(),
        'en_cours' => $enseignant->evaluations()
            ->where('date_debut', '<=', now())
            ->where('date_limite', '>=', now())
            ->count(),
        'terminees' => $enseignant->evaluations()->where('date_limite', '<', now())->count()
    ];
    
    return view('enseignant.evaluationindex', [
        'evaluations' => $evaluations,
        'cours' => $cours,
        'classes' => $classes,
        'stats' => $stats
    ]);
}
   /* public function index()
{
    $enseignant = Auth::guard('enseignant')->user();
    
    // Récupérer les évaluations de l'enseignant avec les relations
    $evaluations = Evaluation::with(['cours', 'classe'])
        ->where('id_enseignant', $enseignant->id_enseignant)
        ->orderBy('date_debut', 'desc')
        ->paginate(10);

    // Récupérer les cours et classes pour les filtres
    $cours = $enseignant->cours()->pluck('titre', 'id_cours');
    $classes = Classe::whereHas('cours', function($query) use ($enseignant) {
            $query->where('id_enseignant', $enseignant->id_enseignant);
        })
        ->pluck('nom', 'id_classe');

    // Statistiques
    $stats = [
        'total' => $enseignant->evaluations()->count(),
        'a_venir' => $enseignant->evaluations()->where('date_debut', '>', now())->count(),
        'en_cours' => $enseignant->evaluations()
            ->where('date_debut', '<=', now())
            ->where('date_limite', '>=', now())
            ->count(),
        'terminees' => $enseignant->evaluations()->where('date_limite', '<', now())->count()
    ];

    return view('enseignant.evaluationindex', [
        'evaluations' => $evaluations,
        'cours' => $cours,
        'classes' => $classes,
        'stats' => $stats
    ]);
}*/
   
/*public function edit_evaluation($id_evaluation)
{
    try {
        // Récupérer l'évaluation avec ses relations
        $evaluation = Evaluation::with(['cours', 'enseignant', 'classe'])
                              ->findOrFail($id_evaluation);

        // Récupérer l'enseignant connecté
        $enseignant = Auth::guard('enseignant')->user();
        
        if (!$enseignant) {
            abort(403, 'Accès non autorisé');
        }

        // Vérifier les permissions
        if ($enseignant->id_enseignant !== $evaluation->id_enseignant && !Auth::guard('admin')->check()) {
            abort(403, 'Vous ne pouvez pas modifier cette évaluation');
        }

        // Vérifier que l'évaluation est modifiable
        if (!$evaluation->estModifiable()) {
            return redirect()->back()
                           ->with('error', 'Cette évaluation ne peut plus être modifiée');
        }

        // Récupérer les cours de l'enseignant
        $cours = $enseignant->cours()->get();
        
        // Récupérer les classes (adaptez selon votre relation réelle)
        $classes = Classe::all();

        return view('enseignant.edit_evaluation', [
            'evaluation' => $evaluation,
            'cours' => $cours,
            'classes' => $classes,
            'statuts' => Evaluation::getStatutOptions(),
            'types' => Evaluation::getTypeOptions(),
            'currentClasse' => $evaluation->classe,
            'currentCours' => $evaluation->cours
        ]);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('enseignant.evaluations.index')
                       ->with('error', 'Évaluation introuvable');
    } catch (\Exception $e) {
        return redirect()->back()
                       ->with('error', 'Une erreur est survenue: '.$e->getMessage());
    }
}*/
public function edit_evaluation(Evaluation $evaluation)
{
    try {
        // Chargez les relations nécessaires
        $evaluation->load(['cours', 'enseignant', 'classe']);
        
        // Récupérez l'enseignant connecté
        $enseignant = Auth::guard('enseignant')->user();
        
        if (!$enseignant) {
            return redirect()->route('enseignant.login')->with('error', 'Veuillez vous connecter');
        }

        // Vérifiez les permissions
        if ($enseignant->id_enseignant !== $evaluation->id_enseignant) {
            return back()->with('error', 'Action non autorisée');
        }

        // Vérifiez si l'évaluation est modifiable
        if (!$evaluation->estModifiable()) {
            return back()->with('error', 'Cette évaluation ne peut plus être modifiée');
        }

        return view('enseignant.evaluations.edit_evaluation', [
            'evaluation' => $evaluation,
            'cours' => $enseignant->cours,
            'classes' => Classe::all(),
            'statuts' => Evaluation::getStatutOptions(),
            'types' => Evaluation::getTypeOptions()
        ]);

    } catch (\Exception $e) {
        return back()->with('error', 'Erreur: '.$e->getMessage());
    }
}
protected function validateEvaluationData(Request $request)
{
    return $request->validate([
        'titre' => 'required|string|max:100',
        'description' => 'nullable|string',
        'type' => 'required|in:examen,devoir,quiz,projet',
        'date_publication' => 'required|date|after_or_equal:now',
        'date_debut' => 'required|date|after_or_equal:date_publication',
        'date_limite' => 'required|date|after_or_equal:date_debut',
        'duree_minutes' => 'required|integer|min:1',
        'bareme_total' => 'required|numeric|min:0|max:100',
        'est_visible' => 'boolean',
        'statut' => 'required|in:brouillon,programme,en_cours,corrige,archive',
        'id_cours' => 'required|exists:cours,id_cours',
        'id_classe' => 'required|exists:classes,id_classe',
        'fichier_consigne' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        'fichier_correction' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
    ]);
}

/*public function update_evaluation(Request $request, $id_evaluation)
{
    try {
        $evaluation = Evaluation::findOrFail($id_evaluation);
        
        // Vérifier les permissions
        $enseignant = Auth::guard('enseignant')->user();
        if ($enseignant->id_enseignant !== $evaluation->id_enseignant && !Auth::guard('admin')->check()) {
            abort(403, 'Action non autorisée');
        }

        // Valider les données
        $validated = $this->validateEvaluationData($request);
        
        // Gestion des fichiers
        $this->handleFileUploads($request, $evaluation);
        
        // Mise à jour
        $evaluation->update($validated);
        
        return redirect()->route('enseignant.evaluations.index')
                       ->with('success', 'Évaluation mise à jour avec succès');

    } catch (\Exception $e) {
        return redirect()->back()
                       ->withInput()
                       ->with('error', 'Erreur lors de la mise à jour: '.$e->getMessage());
    }
}*/
public function update_evaluation(Request $request, $id_evaluation)
{
    DB::beginTransaction();
    
    try {
        // 1. Récupération de l'évaluation avec les relations
        $evaluation = Evaluation::with(['cours', 'classe'])
                              ->findOrFail($id_evaluation);
        
        // 2. Vérification des permissions
        $enseignant = Auth::guard('enseignant')->user();
        if (!$enseignant || $enseignant->id_enseignant !== $evaluation->id_enseignant) {
            throw new \Exception('Action non autorisée');
        }

        // 3. Validation des données
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'id_cours' => 'required|exists:cours,id_cours',
            'classe_id' => 'required|exists:classes,id',
            'type' => 'required|in:examen,devoir,quiz,projet',
            'statut' => 'required|in:brouillon,programme,en_cours,corrige,archive',
            'date_evaluation' => 'required|date',
            'duree_minutes' => 'required|integer|min:1|max:360',
            'bareme_total' => 'required|numeric|min:1|max:100',
            'description' => 'nullable|string',
            'fichier_consigne' => 'nullable|file|mimes:pdf|max:5120',
            'remove_file' => 'nullable|boolean'
        ]);

        // 4. Gestion du fichier
        if ($request->hasFile('fichier_consigne')) {
            // Supprimer l'ancien fichier si existe
            if ($evaluation->fichier_consigne) {
                Storage::delete($evaluation->fichier_consigne);
            }
            
            // Stocker le nouveau fichier
            $path = $request->file('fichier_consigne')
                          ->store('evaluations/consignes');
            $validatedData['fichier_consigne'] = $path;
        } elseif ($request->input('remove_file')) {
            if ($evaluation->fichier_consigne) {
                Storage::delete($evaluation->fichier_consigne);
            }
            $validatedData['fichier_consigne'] = null;
        }

        // 5. Mise à jour de l'évaluation
        $evaluation->update($validatedData);
        
        DB::commit();

        // 6. Redirection avec message de succès
        return redirect()->route('enseignant.evaluations.show', $evaluation->id_evaluation)
                       ->with('success', 'Évaluation mise à jour avec succès');

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
        return redirect()->back()
                       ->withErrors($e->validator)
                       ->withInput();
                       
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()
                       ->withInput()
                       ->with('error', 'Erreur lors de la mise à jour: '.$e->getMessage());
    }
}
public function store_evaluation(Request $request)
{
    $enseignant = Auth::guard('enseignant')->user();

    // 1. Validation simple
    $validated = $request->validate([
        'titre' => 'required|string|max:100',
        'description' => 'nullable|string',
        'type' => 'required|in:examen,devoir,quiz,projet',
        'date_publication' => 'required|date|after_or_equal:now',
        'date_debut' => 'required|date|after_or_equal:date_publication',
        'date_limite' => 'required|date|after_or_equal:date_debut',
        'duree_minutes' => 'required|integer|min:1',
        'bareme_total' => 'required|numeric|min:0',
        'id_cours' => 'required|exists:cours,id_cours',
        'id_classe' => 'required|exists:classe,id_classe',
        'fichier_consigne' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        'fichier_correction' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
    ]);

    // 2. Vérifier que le cours appartient à l'enseignant
    $cours = \App\Models\Cours::where('id_cours', $validated['id_cours'])
                               ->where('id_enseignant', $enseignant->id_enseignant)
                               ->first();
    Log::info('Validation passée');
    Log::info('Cours trouvé: ' . ($cours ? 'oui' : 'non'));
    if (!$cours) {
        return back()->withInput()->with('error', 'Le cours sélectionné ne vous appartient pas.');
    }

    // 3. Vérifier que la classe est liée au cours dans cours_classe

    $existe = DB::table('cours_classe')
                ->where('id_cours', $validated['id_cours'])
                ->where('id_classe', $validated['id_classe'])
                ->exists();
                Log::info('Lien cours-classe existe: ' . ($existe ? 'oui' : 'non'));

    if (!$existe) {
        return back()->withInput()->with('error', 'Ce cours n\'est pas lié à la classe sélectionnée.');
    }

    // 4. Création de l'évaluation
    try {
        $evaluation = Evaluation::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'date_publication' => $validated['date_publication'],
            'date_debut' => $validated['date_debut'],
            'date_limite' => $validated['date_limite'],
            'duree_minutes' => $validated['duree_minutes'],
            'bareme_total' => $validated['bareme_total'],
            'id_cours' => $validated['id_cours'],
            'id_classe' => $validated['id_classe'],
            'id_enseignant' => $enseignant->id_enseignant,
            'statut' => $request->has('publish') ? Evaluation::STATUT_PROGRAMME : Evaluation::STATUT_BROUILLON,
            'est_visible' => $request->has('publish')
        ]);

        // Fichiers
        if ($request->hasFile('fichier_consigne')) {
            $path = $request->file('fichier_consigne')->store('evaluations/consignes', 'public');
            $evaluation->update(['fichier_consigne' => $path]);
        }

        if ($request->hasFile('fichier_correction')) {
            $path = $request->file('fichier_correction')->store('evaluations/corrections', 'public');
            $evaluation->update(['fichier_correction' => $path]);
        }

        return redirect()->route('enseignant.evaluations.index', $evaluation->id_evaluation)
            ->with('success', 'Évaluation créée avec succès');

    } catch (\Exception $e) {
        return back()->withInput()->with('error', 'Erreur: ' . $e->getMessage());
    }
}

protected function handleFileUploads(Request $request, Evaluation $evaluation)
{
    foreach (['fichier_consigne', 'fichier_correction'] as $file) {
        if ($request->hasFile($file)) {
            // Supprimer l'ancien fichier
            if ($evaluation->$file) {
                Storage::delete($evaluation->$file);
            }
            
            // Stocker le nouveau fichier
            $path = $request->file($file)->store('evaluations', 'public');
            $evaluation->$file = $path;
        }
    }
    $evaluation->save();
}
    public function store(Request $request)
{
    $validated = $request->validate([
        'id_classe' => 'required|exists:classe,id_classe',
        'id_cours' => 'required|exists:cours,id_cours',
        // autres validations...
    ]);

    // Vérification que la classe appartient bien à l'année en cours
    $classe = Classe::find($request->id_classe);
    if ($classe->annee_scolaire != date('Y')) {
        return back()->withError('La classe sélectionnée n\'est pas valide pour cette année scolaire');
    }

}
/*public function show_evaluation($id_evaluation)
{
    $evaluation = Evaluation::with(['cours', 'enseignant'])
        ->where('id_enseignant', Auth::guard('enseignant')->id())
        ->findOrFail($id_evaluation);

    return view('enseignant.show_evaluation', [
        'evaluation' => $evaluation,
        //'participants' => $this->getParticipantsCount($id_evaluation) // Fonction helper
    ]);
}*/

public function show_evaluation($id_evaluation)
{
    $evaluation = Evaluation::with([
            'cours', 
            'classe.etudiants', // Charge à la fois la classe et ses étudiants
            'notes.etudiant'
        ])
        ->withCount('notes') // Pour avoir le compte des notes
        ->findOrFail($id_evaluation);

    return view('enseignant.show_evaluation', compact('evaluation'));
}
/**
 * Supprime définitivement une évaluation
 * 
 * @param  int  $id
 * @return \Illuminate\Http\RedirectResponse
 */
public function destroy_evaluation($id)
{
    try {
        DB::beginTransaction();
        
        // Recherche l'évaluation (y compris les soft deleted)
        $evaluation = Evaluation::withTrashed()->findOrFail($id);
        
        // Suppression des fichiers associés
        $filesDeleted = true;
        if ($evaluation->fichier_consigne && !Storage::delete($evaluation->fichier_consigne)) {
            $filesDeleted = false;
            Log::warning("Échec de suppression du fichier consigne: ".$evaluation->fichier_consigne);
        }
        
        if ($evaluation->fichier_correction && !Storage::delete($evaluation->fichier_correction)) {
            $filesDeleted = false;
            Log::warning("Échec de suppression du fichier correction: ".$evaluation->fichier_correction);
        }
        
        // Suppression définitive de l'évaluation
        $evaluation->forceDelete();
        
        DB::commit();
        
        return redirect()->route('evaluations.index')
            ->with('success', 'Évaluation supprimée définitivement avec succès')
            ->with('files_deleted', $filesDeleted ? 'Tous les fichiers ont été supprimés' : 'Certains fichiers n\'ont pas pu être supprimés');
            
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        DB::rollBack();
        Log::error("Évaluation introuvable pour suppression: ".$id);
        return redirect()->back()
            ->with('error', 'Évaluation introuvable');
            
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error("Erreur suppression évaluation ID $id: ".$e->getMessage());
        return redirect()->back()
            ->with('error', 'Une erreur est survenue lors de la suppression');
    }
}
};
?>