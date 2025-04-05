<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

/*class AdminAuthenController extends Controller
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
        $admin = Admin::where('email', $credentials['email'])->first();

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            

        }
            return redirect()->route('Admin.Adminlog')->with('succes','welcome dear student !');


        // En cas d'échec, rediriger avec un message d'erreur
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }
}*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthenController extends Controller
{
    // Fonction de gestion de la connexion de l'admin
    public function login(Request $request)
    {
        // Validation des données d'entrée
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // 🔐 On utilise le guard 'admin' pour se connecter
        if (Auth::guard('admin')->attempt($credentials)) {
            // Si les identifiants sont bons, rediriger vers le dashboard admin
            return redirect()->route('admin.dashboard')->with('success', 'Bienvenue cher admin !');
        }

        // En cas d'échec, rediriger avec un message d'erreur
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }

    // Déconnexion de l'admin
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Déconnexion réussie.');
    }
}
