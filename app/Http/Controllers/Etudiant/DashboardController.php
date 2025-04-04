<?php

namespace App\Http\Controllers\Etudiant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
    {
        public function etudiant()

        {
            $etudiant = Auth::user(); // Ou une logique pour obtenir l'étudiant connecté

        return view('dashboard.etudiant', compact('etudiant'));
        }
        public function dashboard() {
            return view('dashboard', ['user' => Auth::user()]);
        }
        

    public function __construct()
{
    $this->middleware('auth'); // Empêche l'accès si l'utilisateur n'est pas connecté
}
        
    }
    

