<?php
namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Formulaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, $id_formulaire)
    {
        // Validation des données
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        // Vérification que le formulaire existe et est public
        $formulaire = Formulaire::findOrFail($id_formulaire);
        
        // Optionnel: Vérifier si le formulaire est public ou appartient à l'étudiant
        if ($formulaire->type != 'public' && $formulaire->id_etudiant != Auth::id()) {
            abort(403, 'Vous ne pouvez pas commenter ce formulaire');
        }

        // Création du commentaire
        $commentaire = new Commentaire();
        $commentaire->contenu = $request->contenu;
        $commentaire->id_formulaire = $id_formulaire;
        $commentaire->id_etudiant = Auth::id();
        $commentaire->save();

        return redirect()->back()
                         ->with('success', 'Votre commentaire a été ajouté avec succès.');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy($id_commentaire)
    {
        $commentaire = Commentaire::findOrFail($id_commentaire);

        // Vérifier que l'étudiant est l'auteur du commentaire ou du formulaire
        if ($commentaire->id_etudiant != Auth::id() && 
            $commentaire->formulaire->id_etudiant != Auth::id()) {
            abort(403, 'Action non autorisée');
        }

        $commentaire->delete();

        return redirect()->back()
                         ->with('success', 'Commentaire supprimé avec succès.');
    }
}

