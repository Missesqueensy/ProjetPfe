<?php

namespace App\Http\Controllers;

use App\Models\NoteDeCours;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteCoursController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:etudiant');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isEtudiant()) {
                abort(403, 'Accès réservé aux étudiants');
            }
            return $next($request);
        });
    }

    // Méthode privée pour récupérer l'étudiant connecté
    private function getEtudiant()
    {
        return Etudiant::where('id_etudiant', Auth::id())->firstOrFail();
    }

    public function index()
    {
        $etudiant = $this->getEtudiant();
        $notes = NoteDeCours::where('id_etudiant', $etudiant->id_etudiant)
                           ->latest()
                           ->get();
        
        return view('etudiant.notes', compact('notes'));
    }

    /*public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string|max:5000',
        ]);

        $etudiant = $this->getEtudiant();

        NoteDeCours::create([
            'id_etudiant' => $etudiant->id_etudiant,
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('etudiant.notes.index')->with('success', 'Note enregistrée avec succès !');
    }

public function store(Request $request)
{
    $request->validate([
        'contenu' => 'required|string',
    ]);

    // Nettoyage du HTML pour sécurité
    $contenu = clean($request->contenu); // Nécessite le package "purifier"

    $etudiant = $this->getEtudiant();

    NoteDeCours::create([
        'id_etudiant' => $etudiant->id_etudiant,
        'contenu' => $contenu,
    ]);

    return redirect()->route('etudiant.notes.index')
                   ->with('success', 'Note enregistrée avec succès !');
}
public function store(Request $request)
{
    $request->validate([
        'contenu' => 'required|string',
    ]);

    $etudiant = $this->getEtudiant();
    
    // Solution alternative à clean() - Filtrage basique
    $contenu = strip_tags($request->contenu); // Supprime les balises HTML
    $contenu = htmlspecialchars($contenu, ENT_QUOTES, 'UTF-8'); // Échappe les caractères spéciaux

    NoteDeCours::create([
        'id_etudiant' => $etudiant->id_etudiant,
        'contenu' => $contenu,
    ]);

    return redirect()->route('etudiant.notes.index')
                   ->with('success', 'Note enregistrée avec succès !');
}*/
public function store(Request $request)
{
    $request->validate([
        'contenu' => 'required|string',
    ]);

    $etudiant = $this->getEtudiant();
    
    // Nettoyage basique tout en conservant les balises essentielles
    $allowedTags = '<p><strong><em><u><strike><h1><h2><h3><ul><ol><li><a><br><span>';
    $contenu = strip_tags($request->contenu, $allowedTags);
    
    // Suppression des attributs dangereux
    $contenu = preg_replace('/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i', '<$1$2>', $contenu);

    try {
        NoteDeCours::create([
            'id_etudiant' => $etudiant->id_etudiant,
            'contenu' => $contenu,
        ]);

        return redirect()->route('etudiant.notes.index')
                       ->with('success', 'Note enregistrée avec succès !');
    } catch (\Exception $e) {
        return back()->withInput()
                   ->with('error', 'Erreur lors de l\'enregistrement: '.$e->getMessage());
    }
}
    public function edit($id)
    {
        $etudiant = $this->getEtudiant();
        $note = NoteDeCours::where('id_etudiant', $etudiant->id_etudiant)
                          ->findOrFail($id);
        
        $notes = NoteDeCours::where('id_etudiant', $etudiant->id_etudiant)
                          ->latest()
                          ->get();
        
        return view('etudiant.notes', compact('note', 'notes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'contenu' => 'required|string|max:5000',
        ]);

        $etudiant = $this->getEtudiant();
        $note = NoteDeCours::where('id_etudiant', $etudiant->id_etudiant)
                          ->findOrFail($id);

        $note->update(['contenu' => $request->contenu]);

        return redirect()->route('etudiant.notes.index')->with('success', 'Note mise à jour avec succès !');
    }

    public function destroy($id)
    {
        $etudiant = $this->getEtudiant();
        $note = NoteDeCours::where('id_etudiant', $etudiant->id_etudiant)
                          ->findOrFail($id);

        $note->delete();

        return redirect()->route('etudiant.notes.index')->with('success', 'Note supprimée avec succès !');
    }
    // Dans NoteCoursController.php
}