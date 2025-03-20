<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Etudiant\IndexEtudiantController;
use App\Http\Controllers\Sp\IndexSpController;
use App\Http\Controllers\Enseignant\IndexEnseignantController;
use App\Http\Controllers\InscripController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('front.index');
Route::get('/contact', [IndexController::class, 'contact'])->name('front.contact');

//Route::get('/home', [HomeController::class, 'index'])->name('home');


//Route::get('/etudiant', [IndexEtudiantController::class, 'index']);
Route :: get('/etudiant',function(){
    return 'hello lovely student';
});

Route:: get('/inscription',function(){
    return view('Inscription');
})->name('inscription');
Route::post('/inscription', [InscripController::class, 'register'])->name('register.submit');



Route:: get('/login', function(){
    return view('Authentification');
})->name('login');

Route::post('/login', [AuthenController::class, 'login'])->name('login.submit');


Route:: get('/accueil',function(){
    return 'you re registred succefuly!';
});

Route::get('/enseignant', [IndexEnseignantController::class, 'index']);






//sppp
Route::get('/sp', [IndexSpController::class, 'index']);