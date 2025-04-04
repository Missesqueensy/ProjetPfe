<?php

/*namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Etudiant;

class AuthenController extends Controller
{
    // Fonction de gestion de la connexion
    public function login(Request $request)
    {
        // Validation des données d'entrée
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Tentative de connexion avec les informations fournies
        if (Auth::attempt(['email' => $credentials['email'], 'mot_de_passe' => $credentials['password']])) {
            // Connexion réussie, rediriger l'utilisateur vers le dashboard étudiant
            return redirect()->route('dashboard.etudiant');
        }

        // En cas d'échec, rediriger avec un message d'erreur
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }
}*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Hash;

class AuthenController extends Controller
{
    // Fonction de gestion de la connexion
    public function login(Request $request)
    {
        // Validation des données d'entrée
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Vérification si l'utilisateur existe avec l'email fourni
        $etudiant = Etudiant::where('email', $credentials['email'])->first();

        // Vérifier si l'étudiant existe et si le mot de passe est correct
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            // Connexion réussie, rediriger l'utilisateur vers le dashboard étudiant
            //Auth::login($etudiant);
            //return redirect()->route('dashboard.etudiant');

        }
                return redirect()->route('etudiant.etudiantdash')->with('welcome dear student !');


        // En cas d'échec, rediriger avec un message d'erreur
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }
}




?>