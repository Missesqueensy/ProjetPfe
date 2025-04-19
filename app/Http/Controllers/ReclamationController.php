<?php

namespace App\Http\Controllers;
use App\Models\Reclamation;
use App\Models\Admin;
use Illuminate\Http\Request;

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
}