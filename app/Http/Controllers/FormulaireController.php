<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\formulaire;
class FormulaireController extends Controller
{
    // Créez un contrôleur avec artisan

// Dans FormulaireController.php
public function index()
{
    $formulaires = Formulaire::all(); // Peut être filtré par statut ou date si nécessaire
    return view('formulaires.index', compact('formulaires'));
}

/*public function show($id_formulaire)
{
    // Récupère le formulaire avec ses relations
    $formulaire = Formulaire::with([
            'etudiant', 
            'commentaires.etudiant' // Charge aussi l'auteur de chaque commentaire
        ])
        ->findOrFail($id_formulaire);

    // Formatage des données pour la vue
    $data = [
        'formulaire' => $formulaire,
        'commentaires' => $formulaire->commentaires,
        'etudiant' => $formulaire->etudiant
    ];

    return view('admin.formulaireshow', $data);
}*/

/*public function show($id_formulaire)
{
    $formulaires = Formulaire::with(['etudiant', 'commentaires.etudiant'])
                   ->where('id_formulaire', $id_formulaire)
                   ->firstOrFail($id_formulaire);
                   
    $formulaires->increment('vues');
    
    return view('admin.formulaireshow', compact('formulaires'));
}*/
public function show1($id_formulaire)
{
    $formulaire = Formulaire::with('etudiant')->findOrFail($id_formulaire);
    return view('Admin.formulaireshow', compact('formulaire'));
}
public function show($id_formulaire)
{
    $formulaire = Formulaire::with(['etudiant' => function($query) {
        $query->select('id_etudiant', 'nom'); // Charge uniquement les champs nécessaires
    }])->findOrFail($id_formulaire);

    // Vérification de débogage (à enlever en production)
    if (!$formulaire->relationLoaded('etudiant')) {
        logger("Relation etudiant non chargée pour le formulaire #".$id_formulaire);
    }

    return view('Admin.formulaireshow', [
        'formulaire' => $formulaire,
        'backUrl' => url()->previous() // Utile pour un bouton Retour
    ]);
}
public function approve($id)
{
    $formulaire = Formulaire::findOrFail($id);
    $formulaire->statut = 'approuvée';
    $formulaire->save();

    return redirect()->route('formulaires.index')->with('success', 'Formulaire approuvé.');
}
public function afficherFormulaires()
{
    // 1. Optimisation des requêtes avec sélection des colonnes nécessaires
    $formulaires = Formulaire::with([
            'etudiant:id_etudiant,nom,prénom,email', // Seulement les champs nécessaires
            'commentaires' => function($query) {
                $query->with('etudiant:id_etudiant,nom')
                      ->orderBy('created_at', 'desc')
                      ->limit(3); // Derniers 3 commentaires
            }
        ])
        ->select('id_formulaire', 'titre', 'contenu', 'type', 'id_etudiant', 'created_at')
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Pagination au lieu de get()

    // 2. Ajout de statistiques (optionnel)
    $stats = [
        'total' => Formulaire::count(),
        'questions' => Formulaire::where('type', 'question')->count(),
        'explications' => Formulaire::where('type', 'explication')->count()
    ];

    // 3. Formatage des dates pour la vue
    $formulaires->each(function($formulaire) {
        $formulaire->date_publication = $formulaire->created_at->translatedFormat('d F Y \à H:i');
    });

    // 4. Retour avec toutes les données
    return view('admin.Forums', [
        'formulaires' => $formulaires,
        'stats' => $stats,
        'types' => ['question', 'explication'] // Pour filtres
    ]);
}

}
