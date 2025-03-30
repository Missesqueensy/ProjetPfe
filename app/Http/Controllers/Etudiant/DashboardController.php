<?php

namespace App\Http\Controllers\Etudiant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
    {
        public function etudiant()
        {
            return view('etudiantdash'); // Vue pour le dashboard étudiant
        }
    
        public function professeur()
        {
            return view('professordash'); // Vue pour le dashboard professeur
        }
    }
    

