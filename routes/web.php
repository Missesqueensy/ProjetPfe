<?php

use App\Http\Controllers\Admin\AdminAuthenController;
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
use App\Http\Controllers\SupConxController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CoursController;



Route::get('/courses', function () {
    $courses = DB::table('cours')->get();
    return view('etudiant.etudiantcours', ['cours' => $courses]);
});


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
Route::get('/', function () {
    return view('front.index'); // Assurez-vous que la vue s'appelle bien "index.blade.php"
})->name('front.index');
Route::get('/loginprofile',function(){
    return view('etudiant.etudiantdash');
})->name('etudiant.etudiantdash');
Route::get('/contact', [IndexController::class, 'contact'])->name('front.contact');
//route pour les cours 
Route::get('/cours',function(){
    return view('etudiant.etudiantcours');
})->name('etudiant.etudiantcours');
//route pour les formulaires
Route::get('/Mesformulaires',function(){
    return view('etudiant.formulaires');
})->name('etudiant.formulaires');
//route cours favoris
Route::get('/Favoris',function(){
    return view('etudiant.favoris');
})->name('etudiant.favoris');
//route evaluations
Route::get('/Mesévaluations',function(){
    return view('etudiant.evaluations');
})->name('etudiant.evaluations');
//route vers les commentaires
Route::get('/Mescommentaire',function(){
    return view('etudiant.commentaires');
})->name('etudiant.commentaires');
//route de déconnexion
Route::get('/Déconnexion',function(){
    return view('front.index');
})->name('front.indexDec');
//routes des éléments navbar
Route::get('/About',function(){
    return view('front.navbar.about');
})->name('front.navbar.about');
//route admin login
Route::get('/Admin Login',function(){
    return view('Admin.Adminlog');
})->name('Admin.Adminlog');
Route::post('/Admin Login', [AdminAuthenController::class, 'login'])->name('LogAdmin.submit');
//route admin dashboard
Route::get('/Admin dashboard',function(){
    return view('Admin.Admindash');
})->name('Admin.Admindash');
//route admin cours
/*Route::get('/AdminCours',function(){
    return view ('Admin.courses');
})->name('Admin.courses');*/

Route::get('/AdminCours', [CoursController::class, 'index'])->name('Admin.courses');
Route::get('/Admin/courses/{id}/edit', [CoursController::class, 'edit'])->name('Admin.courses.edit');
//suppression du cours
Route::delete('/admin/courses/{id}', [CoursController::class, 'destroy'])->name('admin.courses.destroy');
// afficher tous les cours
Route::get('/admin/courses', [CoursController::class, 'index'])->name('Admin.courses.index');
//creation cours
Route::get('/admin/courses/create', [CoursController::class, 'create'])->name('Admin.courses.create');

// Route pour stocker le cours après soumission du formulaire
Route::post('/admin/courses', [CoursController::class, 'store'])->name('Admin.courses.store');
//affichage cours
Route::get('/admin/courses/{id_cours}', [CoursController::class, 'show'])->name('Admin.courses.show');
//modification du cours 
Route::put('/admin/courses/{id}', [CoursController::class, 'update'])->name('Admin.courses.update');


//route admin analyses
Route::get('/AdminAnalyses',function(){
    return view ('Admin.Analyses');
})->name('Admin.Analyses');
//route admin vers le calendrier
Route::get('/AdminCalendrier',function(){
    return view('Admin.Calendrier');
})->name('Admin.Calendrier');
//route admin vers formulaires
Route::get('/AdminForums',function(){
    return view('Admin.Forums');
})->name('Admin.Forums');
//route admin vers les inscriptions
Route::get('/AdminInscription',function(){
    return view('Admin.Lesinscriptions');
})->name('Admin.Lesinscriptions');
//route admin vers les professeurs
Route::get('/AdminProfesseurs',function(){
    return view('Admin.Lesprofesseurs');
})->name('Admin.Lesprofesseurs');
//route admin vers les formations
Route::get('/AdminFormations',function(){
    return view('Admin.Lesformations');
})->name('Admin.Lesformations');
//route admin vers boite mail
Route::get('/AdminMails',function(){
    return view('Admin.emails');
})->name('Admin.emails');
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
    
    Auth::login($etudiant);

    // Redirection vers Home après l'inscription réussie
    return redirect()->route('front.index')->with('success', 'Inscription réussie ! Veuillez se connecter');
})->name('register.submit');
    


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


