<?php

namespace App\Http\Controllers\Etudiant;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class IndexEtudiantController extends Controller
{
    /*public function index()
    {
        return view('dashboard', ['user' => Auth::user()]);
    }*/
    public function __construct()
    {
        $this->middleware('auth'); // Empêche les utilisateurs non connectés d'accéder au dashboard
    }

}

