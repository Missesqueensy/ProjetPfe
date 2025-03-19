<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexEtudiantController extends Controller
{
    //
    public function index(){
        
        return view('etudiant.index');
    }
}
