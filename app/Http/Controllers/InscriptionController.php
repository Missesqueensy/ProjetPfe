<?php

namespace App\Http\Controllers;
use App\Models\Etudiant; 

use Illuminate\Http\Request;

class InscriptionController extends Controller
{
public function index(Request $request)
{
    $query = Etudiant::query()->latest();

    // Recherche
    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nom', 'like', "%$search%")
              ->orWhere('prénom', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%");
        });
    }

    $etudiants = $query->paginate(10);

    return view('Admin.Lesinscriptions', compact('etudiants'));
}
public function show($id_etudiant)
{
    try {
        $etudiant = Etudiant::findOrFail($id_etudiant);
        $formattedData = [
            'id' => $etudiant->id_etudiant,
            'nom_complet' => $etudiant->nom . ' ' . $etudiant->prenom,
            'email' => $etudiant->email,
            'téléphone' => $etudiant->tel,
            'cni' => $etudiant->CNI,
        ];
        
        // 4. Retourne la vue avec les données
        return view('Admin.showetudiant', [
            'etudiant' => $etudiant,
            'formattedData' => $formattedData
        ]);
        
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Gestion spécifique des erreurs 404
        abort(404, 'Étudiant non trouvé');
    } catch (\Exception $e) {
        // Gestion des autres erreurs
        return redirect()->route('admin.etudiants.index')
               ->with('error', 'Erreur lors de la récupération des données');
    }
}
}
