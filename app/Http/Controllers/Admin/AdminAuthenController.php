<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\enseignant;
use App\Models\commentaire;
use App\Models\formulaire;
use App\Models\cours;
use App\Models\Reclamation;
use App\Models\Inscription;


class AdminAuthenController extends \App\Http\Controllers\Controller
{
    // Fonction de gestion de la connexion de l'admin
    public function login(Request $request)
    {
        // Validation des données d'entrée
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            // Si les identifiants sont bons, rediriger vers le dashboard admin
            return redirect()->route('Admin.Admindash')->with('success', 'Bienvenue cher admin !');
        }

        // En cas d'échec, rediriger avec un message d'erreur
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }
    public function courses()
    {
        $courses = Cours::all();  // Récupère tous les cours
        return view('admin.courses', compact('courses'));
    }
    //afficher les etudiants recupérer de la table etudiat
    public function etudiants() {
        $etudiants = Etudiant::all();
        return view('admin.etudiants', compact('etudiants'));
    }
    //affichage des enseignant
    public function enseignants() {
        $enseignants = Enseignant::all();
        return view('Admin.Lesprofesseurs', compact('enseignants'));
    }
    //affichage des commentaires
    public function commentaires() {
        $commentaires = Commentaire::latest()->get();
        return view('Admin.Lescommentaires', compact('commentaires'));
    }

    public function formulaires() {
        $formulaires = Formulaire::latest()->get();
        return view('Admin.Lesformulaires', compact('formulaires'));
    }
    public function newRegistrations()
{
    // Récupérer les nouveaux étudiants inscrits dans la semaine
    $newStudents = Etudiant::where('created_at', '>=', now()->subDays(7))->get();

    // Récupérer les nouveaux enseignants inscrits dans la semaine
    $newTeachers = Enseignant::where('created_at', '>=', now()->subDays(7))->get();

    // Combiner les deux collections (si nécessaire, vous pouvez les trier par date)
    $newRegistrations = $newStudents->merge($newTeachers);

    return view('Admin.Lesinscriptions', compact('newRegistrations'));
}
public function email(){
    return view('Admin.emails');
}
//partie des relamations
public function index()
{
    $reclamations = Reclamation::with(['expediteur', 'destinataire'])
                     ->latest()
                     ->paginate(10);

    return view('Admin.Réclamations', compact('reclamations'));
}

public function show(Reclamation $reclamation)
{
    return view('Admin.showreclamation', compact('reclamation'));
}
    // Déconnexion de l'admin
    public function logout(Request $request)
{
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
       return redirect()->route('LogAdmin.submit')->with('success', 'Déconnexion réussie.');

   // return redirect()->route('admin.login')->with('success', 'Déconnexion réussie.');
}
public function envoyerReponse(Request $request, Reclamation $reclamation)
{
    logger()->info('Réclamation reçue:', [$reclamation->id]);

    $request->validate([
        'reponse' => 'required|string|max:1000'
    ]);

    // Enregistrer la réponse (adaptez selon votre structure)
    $reclamation->update([
        'reponse' => $request->reponse,
        'statut' => 'répondu',
        'date_reponse' => now(),
        'admin_id' => auth('admin')->id()
    ]);

    // Optionnel : Envoyer une notification
    // Notification::send($reclamation->expediteur, new ReclamationReponse($reclamation));

    return redirect()
           ->route('admin.reclamations.show', $reclamation)
           ->with('success', 'Réponse envoyée avec succès');
}
}
