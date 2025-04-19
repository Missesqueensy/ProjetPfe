<?php

namespace App\Http\Controllers;
use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function afficher()
{
    // Récupérer toutes les formations depuis la base de données
    $formations = Formation::all();

    // Retourner la vue avec les données
    return view('Admin.Lesformations', compact('formations'));
}
}
