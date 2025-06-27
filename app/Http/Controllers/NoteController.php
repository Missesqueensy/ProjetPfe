<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Evaluation;
use App\Models\Classe;
use App\Models\ResultatEvaluation;
class NoteController extends Controller
{
    public function create($id_evaluation)
    {
        $evaluation = Evaluation::with(['classe.etudiants.notes' => function($query) use ($id_evaluation) {
            $query->where('id_evaluation', $id_evaluation);
        }])
        ->with('cours')
        ->findOrFail($id_evaluation);

        return view('enseignant.add_notes', compact('evaluation'));
    }

    /*public function store(Request $request)
    {
        $request->validate([
            'id_evaluation' => 'required|exists:evaluations,id_evaluation',
            'notes' => 'required|array',
            'statut' => 'required|in:en_attente,corrige,publie'
        ]);

        foreach ($request->notes as $id_etudiant => $noteData) {
            Note::updateOrCreate(
                [
                    'id_evaluation' => $request->id_evaluation,
                    'id_etudiant' => $id_etudiant
                ],
                [
                    'valeur' => $noteData['valeur'],
                    'commentaire' => $noteData['commentaire'] ?? null,
                    'statut' => $request->statut,
                    'date_notation' => now()
                ]
            );
        }

        return redirect()
               ->route('enseignant.evaluations.show', $request->id_evaluation)
               ->with('success', 'Les notes ont été enregistrées avec succès.');
    }*/
    

    /**
     * Affiche les résultats/notes d'un étudiant ou d'un groupe
     *
     * @param  Request $request
     * @param  int|null $student_id  ID de l'étudiant (optionnel)
     * @param  int|null $course_id   ID du cours (optionnel)
     * @return \Illuminate\View\View
     */
   /* public function index(Request $request)
{
    // Récupération des paramètres de filtrage
    $id_etudiant = $request->input('id_etudiant');
    $id_evaluation = $request->input('id_evaluation');
    $id_classe = $request->input('id_classe');
    $statut = $request->input('statut');
    
    // Construction de la requête de base avec eager loading optimisé
    $query = Note::with([
        'etudiant.classe', 
        'evaluation:id_evaluation,titre,id_cours,date_debut', 
        'evaluation.cours:id_cours,nom',
        'resultatEvaluation'
    ]);
    
    // Application des filtres
    $this->applyFilters($query, $request);
    
    // Options de tri avec valeurs par défaut
    $sort = $request->input('sort', 'date_notation');
    $order = $request->input('order', 'desc');
    
    // Exécution de la requête avec pagination
    $notes = $query->orderBy($sort, $order)
                  ->paginate(20)
                  ->appends($request->except('page'));
    
    // Préparation des données pour la vue
    return view('enseignant.Notes_index', [
        'notes' => $notes,
        'filters' => $this->getFilterData(),
        'selected' => $request->only(['id_etudiant', 'id_evaluation', 'id_classe', 'statut', 'sort', 'order']),
        'title' => $this->generateTitle($request),
        'evaluation' => $id_evaluation ?  Evaluation::with('cours')->find($id_evaluation) 
         : null
    ]);
}*/

// Exemple dans le contrôleur
/*public function index($id_evaluation)
{
    $evaluation = Evaluation::with([
        'notes.etudiant', 
        'cours', 
        'classe.etudiants'
    ])->findOrFail($id_evaluation);

    return view('enseignant.Notes_index', compact('evaluation'));
}*/
/*public function index(Evaluation $evaluation)
{
    // Récupérer l'évaluation avec les relations nécessaires
    $evaluation = Evaluation::with([
        'notes.etudiant', 
        'cours', 
        'classe.etudiants' => function($query) {
            $query->orderBy('nom')->orderBy('prénom');
        }
    ])->findOrFail($evaluation);


    // Préparer les données pour le formulaire
    $etudiants = $evaluation->classe->etudiants;
    $notesExistantes = $evaluation->notes->keyBy('id_etudiant');

    return view('enseignant.Notes_index', compact('evaluation', 'etudiants', 'notesExistantes'));
}*/
public function index(Evaluation $evaluation)
{
    // Chargement optimisé des relations
    $evaluation->load([
        'notes.etudiant',
        'cours',
        'classe.etudiants' => function($query) {
            $query->orderBy('nom')->orderBy('prénom');
        }
    ]);

    $etudiants = $evaluation->classe->etudiants;
    $notesExistantes = $evaluation->notes->keyBy('id_etudiant');

    return view('enseignant.Notes_index', compact('evaluation', 'etudiants', 'notesExistantes'));
}
/*public function store1(Request $request, $id_evaluation)
{
    $evaluation = Evaluation::findOrFail($id_evaluation);

    // Validation
    $request->validate([
        'notes.*.valeur' => 'required|numeric|min:0|max:'.$evaluation->note_maximale,
        'notes.*.remarque' => 'nullable|string|max:255',
    ]);

    // Traitement des notes
    foreach ($request->notes as $id_etudiant => $noteData) {
        Note::updateOrCreate(
            [
                'id_evaluation' => $id_evaluation,
                'id_etudiant' => $id_etudiant,
            ],
            [
                'valeur' => $noteData['valeur'],
                'remarque' => $noteData['remarque'] ?? null,
            ]
        );
    }

    return redirect()->back()->with('success', 'Les notes ont été enregistrées avec succès.');
}*/
/*11public function store(Request $request, $id_evaluation)
{
    $evaluation = Evaluation::findOrFail($id_evaluation);

    // Validation
    $validated = $request->validate([
        'notes' => 'required|array',
        'notes.*.valeur' => 'required|numeric|min:0|max:'.$evaluation->note_maximale,
        'notes.*.remarque' => 'nullable|string|max:255',
    ]);

    // Vérification supplémentaire
    if (empty($validated['notes'])) {
        return redirect()->back()
            ->with('error', 'Aucune note à enregistrer')
            ->withInput();
    }

    // Traitement des notes
    foreach ($validated['notes'] as $id_etudiant => $noteData) {
        Note::updateOrCreate(
            [
                'id_evaluation' => $id_evaluation,
                'id_etudiant' => $id_etudiant,
            ],
            [
                'valeur' => $noteData['valeur'],
                'remarque' => $noteData['remarque'] ?? null,
            ]
        );
    }

    return redirect()->back()->with('success', 'Les notes ont été enregistrées avec succès.');
}*/
/*public function store(Request $request, $id_evaluation)
{
    $evaluation = Evaluation::findOrFail($id_evaluation);

    // Vérifiez que note_maximale est définie
    if ($evaluation->note_maximale === null) {
        return redirect()->back()
            ->with('error', 'La note maximale n\'est pas définie pour cette évaluation')
            ->withInput();
    }

    // Validation
    $validated = $request->validate([
        'notes' => 'required|array',
        'notes.*.valeur' => [
            'required',
            'numeric',
            'min:0',
            'max:' . (float)$evaluation->note_maximale, // Cast en float pour être sûr
        ],
        'notes.*.remarque' => 'nullable|string|max:255',
    ]);

    // Vérification supplémentaire
    if (empty($validated['notes'])) {
        return redirect()->back()
            ->with('error', 'Aucune note à enregistrer')
            ->withInput();
    }

    // Traitement des notes
    foreach ($validated['notes'] as $id_etudiant => $noteData) {
        Note::updateOrCreate(
            [
                'id_evaluation' => $id_evaluation,
                'id_etudiant' => $id_etudiant,
            ],
            [
                'valeur' => $noteData['valeur'],
                'remarque' => $noteData['remarque'] ?? null,
            ]
        );
    }

    return redirect()->back()->with('success', 'Les notes ont été enregistrées avec succès.');
}
/**
 * Applique les filtres à la requête
 */
public function store(Request $request, $id_evaluation)
{
    $evaluation = Evaluation::findOrFail($id_evaluation);

    // Validation plus flexible
    $validated = $request->validate([
        'notes' => 'required|array',
        'notes.*.valeur' => [
            'nullable', // Permet les valeurs nulles
            'numeric',
            'min:0',
            'max:' . $evaluation->bareme_total // Utilisez le même champ que dans le formulaire
        ],
        'notes.*.commentaire' => 'nullable|string|max:255', // Corrigé pour matcher le formulaire
        'statut' => 'required|in:en_attente,corrige,publie'
    ]);

    // Compteur de notes ajoutées
    $notesAdded = 0;

    foreach ($validated['notes'] as $id_etudiant => $noteData) {
        // Ne créer une note que si une valeur est fournie
        if (!is_null($noteData['valeur'])) {
            Note::updateOrCreate(
                [
                    'id_evaluation' => $id_evaluation,
                    'id_etudiant' => $id_etudiant
                ],
                [
                    'valeur' => $noteData['valeur'],
                    'commentaire' => $noteData['commentaire'] ?? null,
                    'statut' => $validated['statut'],
                    'date_notation' => now()
                ]
            );
            $notesAdded++;
        }
    }

    if ($notesAdded === 0) {
        return back()->with('warning', 'Aucune note valide à enregistrer');
    }

    return redirect()
           ->route('enseignant.evaluations.show', $id_evaluation)
           ->with('success', $notesAdded . ' notes ont été enregistrées avec succès.');
}
protected function applyFilters($query, Request $request)
{
    if ($request->filled('id_etudiant')) {
        $query->where('id_etudiant', $request->id_etudiant);
    }
    
    if ($request->filled('id_evaluation')) {
        $query->where('id_evaluation', $request->id_evaluation);
    }
    
    if ($request->filled('id_classe')) {
        $query->whereHas('etudiant', function($q) use ($request) {
            $q->where('id_classe', $request->id_classe);
        });
    }
    
    if ($request->filled('statut')) {
        $query->where('statut', $request->statut);
    }
}
protected function getFilterData()
{
    return [
        'etudiants' => Etudiant::orderBy('nom')->get(['id_etudiant', 'nom', 'prénom']),
        'evaluations' => Evaluation::with('cours:id_cours,titre')
                             ->orderBy('date_debut', 'desc')
                             ->get(['id_evaluation', 'titre', 'id_cours', 'date_debut']),
        'classes' => Classe::orderBy('nom')->get(['id_classe', 'nom']),
        'statuts' => ['en_attente', 'corrige', 'publie']
    ];
}
    public function showResults(Request $request, $id_etudiant = null)
    {
        // Si un étudiant est spécifié
        if ($id_etudiant) {
            $etudiant = Etudiant::with(['notes.evaluation.cours', 'classe'])->findOrFail($id_etudiant);
            
            // Calcul des moyennes
            $moyenne_generale = $etudiant->notes->avg('valeur');
            $moyenne_par_cours = $etudiant->notes->groupBy('evaluation.id_cours')
                ->map(function($notes) {
                    return $notes->avg('valeur');
                });
            
            return view('enseignant.show_note_etudiant', [
                'etudiant' => $etudiant,
                'moyenne_generale' => $moyenne_generale,
                'moyennes_par_cours' => $moyenne_par_cours,
                'title' => "Résultats détaillés - " . $etudiant->nom_complet
            ]);
        }
        $query = Note::with(['etudiant', 'evaluation.cours'])
        ->where('statut', 'publie');
        
    if ($request->has('id_classe')) {
        $query->whereHas('etudiant', function($q) use ($request) {
            $q->where('id_classe', $request->id_classe);
        });
    }
    
    $notes = $query->orderBy('date_notation', 'desc')
                  ->paginate(15);
    
    return view('enseignant.Notes_index', [
        'notes' => $notes,
        'classes' => Classe::orderBy('nom')->get(),
        'selected_classe' => $request->id_classe ?? null,
        'title' => "Résultats des étudiants"
    ]);
}
private function generateTitle(Request $request)
    {
        $title = "Résultats";
        
        if ($request->id_etudiant) {
            $etudiant = Etudiant::find($request->id_etudiant);
            $title .= " de " . ($etudiant->nom_complet ?? 'l\'étudiant');
        }
        
        if ($request->id_evaluation) {
            $evaluation = Evaluation::find($request->id_evaluation);
            $title .= " pour " . ($evaluation->nom ?? 'l\'évaluation');
        }
        
        if ($request->id_classe) {
            $classe = Classe::find($request->id_classe);
            $title .= " - Classe " . ($classe->nom ?? '');
        }
        
        return $title;
    }
       

};