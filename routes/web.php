<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Etudiant\IndexEtudiantController;
use App\Http\Controllers\Sp\IndexSpController;
use App\Http\Controllers\Enseignant\IndexEnseignantController;
use App\Http\Controllers\InscripController;
use App\Http\Controllers\DashboardController;


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
    return view('inscription');
})->name('inscription');
Route::post('/inscription', [InscripController::class, 'register'])->name('register.submit');



Route:: get('/login', function(){
    return view('Authentification');
})->name('login');

Route::post('/login', [AuthenController::class, 'login'])->name('login.submit');


Route:: get('/accueil',function(){
    return 'you re registred succefuly!';
});
// Dashboard pour les étudiants
Route::middleware(['auth', 'role:etudiant'])->get('/dashboard/etudiant', [DashboardController::class, 'etudiant'])->name('dashboard.etudiant');

// Dashboard pour les professeurs
Route::middleware(['auth', 'role:professeur'])->get('/dashboard/professeur', [DashboardController::class, 'professeur'])->name('dashboard.professeur');


//accès dashboard etudiant en vérifiant le role

Route::middleware(['role:etudiant'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});



Route::get('/enseignant', [IndexEnseignantController::class, 'index']);






//sppp
Route::get('/sp', [IndexSpController::class, 'index']);


use Illuminate\Support\Facades\Log;


Route::get('/test-log', function () {
    Log::error('Ceci est un test de log Laravel');
    return 'Log ajouté';
});
