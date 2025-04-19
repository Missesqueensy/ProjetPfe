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

public function show($id)
{
    $formulaires = Formulaire::with('etudiant')
                             ->where('statut', 'publiée') // Filtrer pour les formulaires publiés
                             ->orderBy('date_publication', 'desc')
                             ->get();
    return view('formulairesshow', compact('formulaire'));
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
    // On récupère les formulaires avec l'étudiant lié
    $formulaires = Formulaire::with('etudiant')->orderBy('date_publication', 'desc')->get();

    // On retourne la vue avec les données
    return view('admin.Forums', compact('formulaires'));
}

}
