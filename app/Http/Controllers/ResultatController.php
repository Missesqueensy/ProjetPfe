<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Evaluation;
use App\Models\Note;

class ResultatController extends Controller
{
    public function index()
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

        return view('etudiant.resultats.index', compact('notes', 'evaluationsSansNote'));
    }
}