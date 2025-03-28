<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class InscripController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'tel' => 'required|string|max:15',
            'role' => 'required|in:etudiant,professeur', // Validation du rôle

        ]);
        dd($request->all());

       /* $user= User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->passwd),
            'tel' => $request->tel,
            'role' => $request->role,  // On ajoute le rôle */
            $user = new User();
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->password = Hash::make($request->password); // Hachage du mot de passe
            $user->tel = $request->tel;
            $user->save();
    
            // Retourner une réponse de succès ou rediriger
            return redirect()->route('inscription')->with('success', 'Inscription réussie');
    

       
        Auth::login($user); // Connexion automatique après inscription

        return redirect()->route('dashboard')->with('succes','Inscription réussie!'); // Redirection vers le dashboard
    }
    

}



