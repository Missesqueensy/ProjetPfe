<?php

namespace App\Http\Controllers;
    use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InscripController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'tel' => 'required',
            'role' => 'required|in:etudiant,professeur,admin', // Validation du rôle

        ]);

        $user= User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->passwd),
            'tel' => $request->tel,
            'role' => $request->role,  // On ajoute le rôle ici

        ]);
        if ($user && $user->id) {
            return redirect()->route('home')->with('success', 'User created successfully');
        } else {
            return redirect()->back()->with('error', 'There was an issue creating the user.');
        }
    }


}


