<?php

namespace App\Http\Controllers;

use App\Models\Formulaire;
use App\Models\Commentaire;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EtudiantFormulaireController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isEtudiant()) {
                abort(403, 'Accès réservé aux étudiants');
            }
            return $next($request);
        });
    }*/


    /**
     * Affiche la liste des formulaires
     */
    public function index()
    {
        $etudiant = Etudiant::where('id_etudiant', Auth::id())->firstOrFail();
        
        $formulaires = Formulaire::where('id_etudiant', $etudiant->id_etudiant)
                                ->orWhere('type', 'public')
                                ->with(['etudiant', 'commentaires.etudiant'])
                                ->orderBy('created_at', 'desc')
                                ->paginate(10); // 10 éléments par page
                               // ->get();

        return view('etudiant.formulaires-index', compact('formulaires'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('etudiant.formulaires.create');
    }

    /**
     * Enregistre un nouveau formulaire
     */
    /*public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'type' => 'required|in:question,explication',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $etudiant = Etudiant::where('id_etudiant', Auth::id())->firstOrFail();

        Formulaire::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'type' => $request->type,
            'id_etudiant' => $etudiant->id_etudiant,
        ]);
    return view('etudiant.formulaires-index', compact('formulaire')); // 👈 ici

        //return redirect()->route('etudiant.formulaires.index')
                        //->with('success', 'Formulaire créé avec succès!');
    }*/
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'titre' => 'required|string|max:255',
        'contenu' => 'required|string',
        'type' => 'required|in:question,explication',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
    }

    $etudiant = Etudiant::where('id_etudiant', Auth::id())->firstOrFail();

    $formulaire = Formulaire::create([
        'titre' => $request->titre,
        'contenu' => $request->contenu,
        'type' => $request->type,
        'id_etudiant' => $etudiant->id_etudiant,
    ]);

    return view('etudiant.formulaires-index', compact('formulaire'));
    
    // ou mieux :
    // return redirect()->route('etudiant.formulaires.index')
    //                  ->with('success', 'Formulaire créé avec succès!');
}


    /**
     * Affiche un formulaire spécifique
     */
    public function show($id)
    {
        $formulaire = Formulaire::with(['etudiant', 'commentaires.etudiant'])
                              ->findOrFail($id);

        // Vérifier que l'étudiant est propriétaire ou que le formulaire est public
        if ($formulaire->id_etudiant != Auth::id() && $formulaire->type != 'public') {
            abort(403, 'Accès non autorisé à ce formulaire');
        }

        return view('etudiant.formulaires-show', compact('formulaire'));
    }
public function edit($id)
{
    $formulaire = Formulaire::findOrFail($id);
    
    // Vérifier que l'étudiant est bien le propriétaire du formulaire
    if ($formulaire->id_etudiant != Auth::id()) {
        abort(403, 'Accès non autorisé à ce formulaire');
    }

    return view('etudiant.formulaire-edit', compact('formulaire'));
}
    /**
     * Supprime un formulaire
     */
    public function destroy($id)
    {
        $formulaire = Formulaire::findOrFail($id);

        // Vérifier que l'étudiant est propriétaire
        if ($formulaire->id_etudiant != Auth::id()) {
            abort(403, 'Vous ne pouvez pas supprimer ce formulaire');
        }

        $formulaire->delete();

        return redirect()->route('etudiant.formulaires.index')
                        ->with('success', 'Formulaire supprimé avec succès!');
    }
public function update(Request $request, $id)
{
    // Récupération du formulaire
    $formulaire = Formulaire::findOrFail($id);
    
    // Vérification des droits
    if ($formulaire->id_etudiant != Auth::id()) {
        abort(403, 'Vous n\'êtes pas autorisé à modifier ce formulaire');
    }

    // Validation des données
    $validatedData = $request->validate([
        'titre' => 'required|string|max:255',
        'type' => 'required|in:question,explication',
        'contenu' => 'required|string',
    ]);

    // Mise à jour du formulaire
    $formulaire->update($validatedData);

    // Redirection avec message de succès
    return redirect()
           ->route('etudiant.formulaires.show', $formulaire->id_formulaire)
           ->with('success', 'Le formulaire a été mis à jour avec succès');
}
    /**
     * Ajoute un commentaire à un formulaire
     */
    public function storeCommentaire(Request $request, $id_formulaire)
    {
        $validator = Validator::make($request->all(), [
            'contenu' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $formulaire = Formulaire::findOrFail($id_formulaire);
        $etudiant = Etudiant::where('id_etudiant', Auth::id())->firstOrFail();

        // Vérifier l'accès au formulaire
        if ($formulaire->id_etudiant != $etudiant->id_etudiant && $formulaire->type != 'public') {
            abort(403, 'Accès non autorisé à ce formulaire');
        }

        Commentaire::create([
            'contenu' => $request->contenu,
            'id_formulaire' => $id_formulaire,
            'id_etudiant' => $etudiant->id_etudiant,
        ]);

        return redirect()->back()
                        ->with('success', 'Commentaire ajouté avec succès!');
    }
public function shared()
{
    // Récupère les formulaires publics des autres étudiants
    $sharedFormulaires = Formulaire::with('etudiant')
        ->where('type', 'public')
        ->where('id_etudiant', '!=', Auth::id())
        ->latest()
        ->paginate(9);

    return view('etudiant.formulaires-shared', [
        'formulaires' => $sharedFormulaires
    ]);
}
    /**
     * Supprime un commentaire
     */
    public function destroyCommentaire($id_commentaire)
    {
        $commentaire = Commentaire::findOrFail($id_commentaire);

        // Vérifier que l'étudiant est propriétaire du commentaire
        if ($commentaire->id_etudiant != Auth::id()) {
            abort(403, 'Vous ne pouvez pas supprimer ce commentaire');
        }

        $commentaire->delete();

        return redirect()->back()
                        ->with('success', 'Commentaire supprimé avec succès!');
    }
}
