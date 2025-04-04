<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as ControllersController;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Controllers\Controller;
use Illuminate\Routing\Controller as RoutingController;

class InscripController extends RoutingController
{
    public function register(Request $request)
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

    }
}
?>