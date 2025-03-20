<?php

namespace App\Http\Controllers;
    use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthenController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard'); // Redirige après connexion réussie
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }
}
