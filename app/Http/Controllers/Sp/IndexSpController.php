<?php

namespace App\Http\Controllers\Sp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexSpController extends Controller
{
    //
    public function index(){
        
        return view('sp.index');
    }
}
