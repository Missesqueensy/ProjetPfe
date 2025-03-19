<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InscriptionController extends Controller
{
    public function store(Request $request){
        //validation données forum
        $validatedData= $request->validate([
            'nom'=>'required|string|max:255',
             'email'=>'required|string|max:255|unique:users',
             'mot_de_passe'=>'required|string|min:8',
        ]);
        //création d'un nouvel user
        $user= User::create(['name'=>$validatedData['nom'],
                             'email'=>$validatedData['email'],
                             'password'=>Hash::make($validatedData['mot_de_passe']),
    ]);
    //redirection vers une page de succés ou de connexion
    redirect()->Route('accueil');
    }
    public function join(Request $request){
        return view('Inscription');
    }
}
