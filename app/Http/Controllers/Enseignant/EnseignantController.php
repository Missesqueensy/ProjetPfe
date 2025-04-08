<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    // Afficher un enseignant spécifique
    public function show($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        return view('enseignants.show', compact('enseignant'));
    }

    // Afficher la liste des enseignants
    public function index()
    {
        $enseignants = Enseignant::all();
        return view('enseignants.index', compact('enseignants'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('enseignants.create');
    }

    // Enregistrer un nouvel enseignant
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:enseignants,email',
        ]);

        Enseignant::create($request->all());
        return redirect()->route('enseignants.index')->with('success', 'Enseignant ajouté avec succès');
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        return view('enseignants.edit', compact('enseignant'));
    }

    // Mettre à jour un enseignant
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:enseignants,email,' . $id,
        ]);

        $enseignant = Enseignant::findOrFail($id);
        $enseignant->update($request->all());
        return redirect()->route('enseignant.index')->with('success', 'Enseignant mis à jour avec succès');
    }

    // Supprimer un enseignant
    public function destroy($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        $enseignant->delete();
        return redirect()->route('enseignants.index')->with('success', 'Enseignant supprimé avec succès');
    }
}
