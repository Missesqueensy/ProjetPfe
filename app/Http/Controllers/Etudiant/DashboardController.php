<?php

namespace App\Http\Controllers\Etudiant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
    {
        public function etudiant()

        {
            $etudiant = Auth::guard('etudiant')->user(); // Ou une logique pour obtenir l'étudiant connecté

        return view('etudiant.etudiantdash', compact('etudiant'));
        //test
        if (!$etudiant) {
            return redirect()->route('login');  // Rediriger si l'étudiant n'est pas connecté
        }
    
        return view('etudiant.etudiantdash', compact('etudiant'));  // Passer la variable $etudiant à la vue
    }
        
        /*public function etudiant()
{
    $etudiant = Auth::user(); // récupère l'étudiant connecté
    return view('etudiant.etudiantdash', compact('etudiant')); // Passe $etudiant à la vue
}*/
        public function dashboard() {
            return view('etudiant.etudiantdash', ['user' => Auth::guard('web')->user()]);
        }
        

    public function __construct()
{
    $this->middleware('auth'); // Empêche l'accès si l'utilisateur n'est pas connecté
}

        
    }
    

