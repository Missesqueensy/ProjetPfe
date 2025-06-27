<?php
namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class InscripController extends Controller

{
    /*public function register(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'prénom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiant,email',
            'password' => 'required|string|min:6|confirmed',
            'tel' => 'required|string|max:20',
            'CNI' => 'required|string|max:20',
        ]);

        // Création de l'étudiant
        $etudiant = Etudiant::create([
            'nom' => $validatedData['nom'],
            'prénom' => $validatedData['prénom'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'password_confirmation' => 'required|string|min:6',
            'tel' => $validatedData['tel'],
            'CNI' => $validatedData['CNI'],

        ]);

        // Retourne une réponse ou redirection après inscription réussie
        //return redirect()->route('login')->with('success', 'Inscription réussie !');
        return redirect()->route('front.index')->with('success', 'Inscription réussie veuillez vous connecter à votre compte !');

    }*/
    public function showRegistrationForm()
    {
        return view('inscription'); // Votre vue d'inscription
    }

   /* public function register(Request $request)
    {
        // Détermine si c'est un étudiant ou un enseignant
        $userType = $request->has('cni') ? 'etudiant' : 'enseignant';

        if ($userType === 'etudiant') {
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:etudiants',
                'password' => 'required|string|min:8|confirmed',
                'tel' => 'required|string|max:20',
                'cni' => 'required|string|max:20|unique:etudiants',
            ]);

            $user = Etudiant::create([
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'tel' => $validated['tel'],
                'cni' => $validated['cni'],
            ]);

            return redirect()->route('login')->with('success', 'Inscription étudiante réussie!');
        } else {
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:enseignants',
                'password' => 'required|string|min:8|confirmed',
                'specialite' => 'required|string|max:255',
                'departement' => 'required|string|max:255',
            ]);

            $user = Enseignant::create([
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'specialite' => $validated['specialite'],
                'departement' => $validated['departement'],
            ]);

            return redirect()->route('enseignant.login')->with('success', 'Inscription enseignant réussie!');
        }
    }*/
    public function registerEtudiant(Request $request)
{
    // Vérifiez quelle route a été utilisée
    if ($request->route()->named('register.submit')) {
        // Traitement étudiant
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:etudiants',
            'password' => 'required|string|min:8|confirmed',
            'tel' => 'required|string|max:20',
            'cni' => 'required|string|max:20|unique:etudiants',
        ]);

        $user = Etudiant::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'tel' => $validated['tel'],
            'cni' => $validated['cni'],
        ]);

        return redirect()->route('front.index')->with('success', 'Inscription réussie!');
    }
else{

        // Traitement enseignant
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:enseignants',
            'password' => 'required|string|min:8|confirmed',
            'specialite' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
        ]);

        $user = Enseignant::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'specialite' => $validated['specialite'],
            'departement' => $validated['departement'],
        ]);

        return redirect()->route('front.index')->with('success', 'Inscription enseignant réussie!');
    }
}
}


?>