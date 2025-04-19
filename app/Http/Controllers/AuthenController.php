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

        $etudiant = Etudiant::where('email', $credentials['email'])->first();

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            

        }

            return redirect()->route('etudiant.etudiantdash')->with('succes','welcome dear student !');


        // En cas d'échec, rediriger avec un message d'erreur
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }
    public function authenticated(Request $request, $user)
{
    if ($user->isEtudiant()) {
        return redirect()->route('etudiant.dashboard'); // Assurez-vous que la route existe
    }

    // Autres redirections selon le rôle
}
}



