<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Etudiant\IndexEtudiantController;
use App\Http\Controllers\Sp\IndexSpController;
use App\Http\Controllers\Enseignant\IndexEnseignantController;
use App\Http\Controllers\Etudiant\InscripController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Etudiant\DashboardController;
use App\Http\Controllers\InscripController as ControllersInscripController;

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


//inscription getting
Route:: get('/inscription',function(){
    return view('inscription');
})->name('inscription');
//inscription posting
Route::post('/inscription', [ControllersInscripController::class, 'register'])->name('register.submit');
Route::post('/inscription', function (Request  $request) {
    // Validation des données envoyées par le formulaire
    $validatedData = $request->validate([
        'prénom' => 'required|string|max:255', // Validation du prénom
        'nom' => 'required|string|max:255', // Validation du nom
        'email' => 'required|email|unique:etudiant,email',  // Email unique dans la table
        'password' => 'required|string|min:6|confirmed', // Mot de passe validé avec confirmation
        'tel' => 'required|string|max:20', // Validation du téléphone
        'CNI' => 'required|string|max:20', // Validation du CNI
    ]);

    // Création de l'étudiant après validation
    $etudiant = Etudiant::create([
        'prénom' => $validatedData['prénom'],
        'nom' => $validatedData['nom'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']), // Hachage du mot de passe
        'tel' => $validatedData['tel'],
        'CNI' => $validatedData['CNI'], // Ajout du CNI
    ]);
    //return view('etudiantdash');
    //Auth::login($etudiant);
    //return redirect()->route('dashboard.etudiant')->with('success', 'Inscription réussie, bienvenue !');

    // Retourner une réponse JSON avec un message de succès
    /*return response()->json([
        'message' => 'Étudiant inscrit avec succès.',
        'etudiant' => $etudiant
    ], 201);*/
});


Route:: get('/login', function(){
    return view('Authentification');
})->name('login');

Route::post('/login', [AuthenController::class, 'login'])->name('login.submit');
//redirection dashboard etudiant
Route::middleware(['auth'])->get('/dashboard/etudiant', [DashboardController::class, 'etudiant'])
    ->name('dashboard.etudiant');


// Dashboard pour les professeurs

//déconnexion
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
//accès dashboard etudiant en vérifiant le role




Route::get('/enseignant', [IndexEnseignantController::class, 'index']);






//sppp
Route::get('/sp', [IndexSpController::class, 'index']);


use Illuminate\Support\Facades\Log;


Route::get('/test-log', function () {
    Log::error('Ceci est un test de log Laravel');
    return 'Log ajouté';
});
