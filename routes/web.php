<?php

use App\Http\Controllers\Admin\AdminAuthenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Notes;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Etudiant\IndexEtudiantController;
use App\Http\Controllers\Sp\IndexSpController;
use App\Http\Controllers\Enseignant\IndexEnseignantController;
use App\Http\Controllers\InscripController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EtudiantNotesController; // Import correct

use App\Http\Controllers\Etudiant\DashboardController;
use App\Http\Controllers\InscripController as ControllersInscripController;
use App\Http\Controllers\SupConxController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EtudiantFormulaireController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\FormulaireController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\NoteCoursController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\ResultatController as ControllersResultatController;
use App\Models\Enseignant;
use App\Models\ResultatController;
use App\Http\Livewire\TeacherSchedule;
use App\Livewire\EmploiEnseignant;
use App\Models\NoteDeCours;
use EtudiantNotesController as GlobalEtudiantNotesController;

Route::get('/AdminMails',function(){
    return view('Admin.emails');
})->name('Admin.emails');

// Routes d'inscription
//inscription getting
Route:: get('/inscription',function(){
    return view('inscription');
})->name('inscription');
//inscription posting
Route::get('/inscription/enseignant', [EnseignantController::class, 'showRegistrationForm'])->name('enseignant.register');
Route::post('/inscription/enseignant', [EnseignantController::class, 'register'])->name('enseignant.register.submit');
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
Route::get('/courses', function () {
    $courses = DB::table('cours')->get();
    return view('etudiant.etudiantcours', ['cours' => $courses]);
});
// Dans routes/web.php


// Route pour afficher le formulaire d'inscription
Route::get('/inscription', [InscripController::class, 'showRegistrationForm'])->name('inscription.etudiant');

// Route pour traiter la soumission du formulaire
Route::post('/inscription', [InscripController::class, 'register'])->name('register.submit');
Route::post('/inscription/enseignant', [InscripController::class, 'registerEnseignant'])->name('register.enseignant');

//Route::post('/inscription/enseignant', [InscripController::class, 'register'])->name('register.enseignant');

// Routes d'inscription
Route::get('/inscription', [InscripController::class, 'showRegistrationForm'])->name('inscription');
//hna formulaire inscription etud-ens
Route::post('/inscription/etudiant', [InscripController::class, 'registerEtudiant'])->name('register.etudiant');
Route::post('/inscription/enseignant', [InscripController::class, 'registerEnseignant'])->name('register.enseignant');

// Routes de connexion
Route::get('/login', [AuthenController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthenController::class, 'logout'])->name('logout');
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
    return view('etudiant.dashboardetd');
})->name('etudiant.dashboardetd');
Route::get('/etudiant/login',[DashboardController::class,'login'])->name('etudiant.login');
Route::get('/loginetudiant',[DashboardController::class,'index'])->name('etudiant.dashboardetd');
Route::get('/etudiantcours',[DashboardController::class,'mesCours'])->name('etudiant.cours');
Route::get('/cours/index', [DashboardController::class, 'indexForStudents'])->name('cours.index');
Route::get('/cours/{id_cours}', [DashboardController::class, 'showCours'])
     ->name('cours.show');
Route::post('/etudiant/cours/{id}/follow', [DashboardController::class, 'followCourse'])->name('etudiant.follow');
Route::get('/etudiant/notes', [NoteCoursController::class, 'index'])->name('etudiant.notes.index');
Route::get('/etudiant/notes/store', [NoteCoursController::class, 'store'])->name('etudiant.notes.store');
Route::get('/resultats', [DashboardController::class, 'indexResultat'])->name('etudiant.resultats.index');
// Doit correspondre aux routes utilisées dans le formulaire
Route::get('/evaluations', [DashboardController::class, 'indexEvaluation'])->name('etudiant.evaluations.index');
Route::get('/evaluations/{id}', [DashboardController::class, 'show'])
         ->name('etudiant.evaluations.show')
         ->where('id', '[0-9]+');
Route::put('/etudiant/notes/{note}', [NoteCoursController::class, 'update'])->name('etudiant.notes.update');
Route::get('/etudiant/formulaire/index',[EtudiantFormulaireController::class,'index'])->name('etudiant.formulaires.index');
    Route::post('/etudiant/fomulaires/{id}', [EtudiantFormulaireController::class, 'store'])->name('etudiant.formulaires.store');
Route::post('/etudiant/formulaires', [EtudiantFormulaireController::class, 'store'])
    ->name('etudiant.formulaires.store');
    Route::get('/etudiant/formulaires/{id}', [EtudiantFormulaireController::class, 'show'])
     ->name('etudiant.formulaires.show');
     // Route pour afficher le formulaire d'édition
Route::get('/etudiant/formulaires/{formulaire}/edit', [EtudiantFormulaireController::class, 'edit'])
     ->name('etudiant.formulaires.edit');
     Route::get('/etudiant/formulaire/create',function(){
    return view('etudiant.formulaire-create');
})->name('etudiant.formulaires.create');
// Mise à jour d'un formulaire
Route::put('/etudiant/formulaires/{formulaire}', [EtudiantFormulaireController::class, 'update'])->name('etudiant.formulaires.update');
// Route pour les formulaires partagés
Route::get('/etudiant/formulaires/partages', [EtudiantFormulaireController::class, 'shared'])
     ->name('etudiant.formulaires.shared');
    // Ajouter un commentaire
Route::post('/formulaires/{id_formulaire}/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
    
    // Supprimer un commentaire
Route::delete('/commentaires/{commentaire}', [CommentaireController::class, 'destroy'])->name('commentaires.destroy');
Route::get('/etudiant/notes',function(){
    return view('etudiant.notes');
})->name('etudiant.notes');
Route::get('/etudiant/reclamation',[DashboardController::class,'index_etudiant_reclamation'])->name('etudiant.reclamations');
Route::get('/etudiant/reclamation/create',[DashboardController::class,'etudiant_createReclam'])->name('etudiant.reclamations.create');

Route::post('/etudiant/reclamations', [DashboardController::class, 'store'])->name('etudiant.reclamations.store');
Route::get('/etudiant/messagerie',[DashboardController::class,'sent'])->name('etudiant.messagerie.index');
Route::get('/etudiant/messagerie',function(){
    return view('etudiant.messagerie');
})->name('etudiant.messagerie.index');
Route::put('/parametres', [DashboardController::class, 'updateParametres'])->name('etudiant.parametres.update');
    Route::get('/parametres', [DashboardController::class, 'parametres'])->name('parametres');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
Route::delete('/etudiant/parametres/supprimer', [DashboardController::class, 'supprimerCompte'])->name('etudiant.compte.supprimer');
 Route::get('/messagerie', [MessageController::class, 'index'])->name('etudiant.messagerie.index');
     Route::get('/messagerie/create', [MessageController::class, 'create'])->name('etudiant.messagerie.create');
Route::post('/etudiant/messagerie/store', [MessageController::class, 'store'])->name('etudiant.messagerie.store');
Route::get('/{conversation}', [MessageController::class, 'show'])->name('etudiant.messagerie.show');

Route::get('/messagerie/sent', [MessageController::class, 'sent'])->name('etudiant.messagerie.sent');
    Route::get('/messagerie/starred', [MessageController::class, 'starred'])->name('etudiant.messagerie.starred');
    Route::get('/messagerie/trash', [MessageController::class, 'trash'])->name('etudiant.messagerie.trash');
    Route::post('/messagerie/send', [MessageController::class, 'send'])->name('etudiant.messagerie.send');
Route::get('/etudiant/parameters',function(){
    return view('etudiant.parametres');
})->name('etudiant.parametres');
Route::post('/etudiant/logout', [DashboardController::class, 'destroy'])
     ->name('etudiant.logout');
Route::get('etudiant/logout',[DashboardController::class,'logout'])->name('etudiant.logout');
Route::get('/etudiant/logout',function(){
    return view('etudiant.logout');
})->name('etudiant.logout');
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
/*route admin login
Route::get('/Admin Login',function(){
    return view('Admin.Adminlog');
})->name('Admin.Adminlogin');*/
// mn hna atdkhli lforum admin
Route::get('/admin/login', [AdminAuthenController::class, 'showLoginForm'])->name('admin.login');

Route::post('/admin/login', [AdminAuthenController::class, 'login'])->name('Admin.login.submit');

Route::post('/admin/logout', [AdminAuthenController::class, 'logout'])->name('admin.logout');

//Route::post('/Admin/Login', [AdminAuthenController::class, 'login'])->name('LogAdmin.submit');
//route admin dashboard
/*Route::get('/Admin dashboard',function(){
    return view('Admin.Admindash');
})->name('Admin.Admindash');*/

Route::get('/Admin/dashboard',[AdminAuthenController::class,'dashboard'])->name('Admin.Admindash');

Route::get('/AdminCours', [CoursController::class, 'index'])->name('Admin.courses');
Route::get('/Admin/courses/{id}/edit', [CoursController::class, 'edit'])->name('Admin.courses.edit');
//suppression du cours
Route::delete('/admin/courses/{id}', [CoursController::class, 'destroy'])->name('admin.courses.destroy');
// afficher tous les cours
//mn hna atdkhli ldashboard admin
Route::get('/admin/courses/index', [CoursController::class, 'index'])->name('Admin.courses.index');
//creation cours
Route::get('/admin/courses/create', [CoursController::class, 'create'])->name('Admin.courses.create');

// Route pour stocker le cours après soumission du formulaire
Route::post('/admin/courses/store', [CoursController::class, 'store'])->name('Admin.courses.store');
//affichage cours
Route::get('/admin/courses/{id_cours}', [CoursController::class, 'show'])->name('Admin.courses.show');
//modification du cours 
Route::put('/admin/courses/{id}', [CoursController::class, 'update'])->name('Admin.courses.update');
//route vers analyses
Route::get('/adminAnalyses', [ReclamationController::class, 'index'])->name('admin.reclamations.index');
Route::get('/adminAnalyses/show/{reclamation}', [ReclamationController::class, 'show'])->name('admin.reclamations.show');
Route::get('/admin/reclamations/{reclamation}/response', [ReclamationController::class, 'showResponseForm'])
     ->name('admin.reclamations.response.form');
     
Route::post('/admin/reclamations/{reclamation}/response', [ReclamationController::class, 'envoyerReponse']) ->name('admin.reclamations.response');
Route::post('/Admin/reclamations/store', [ReclamationController::class, 'store'])->name('admin.reclamations.store');

Route::put('/admin/reclamations/{reclamation}/response', [ReclamationController::class, 'envoyerReponse'])
    ->name('admin.reclamations.response.put');
Route::get('/admin/formulaires/{formulaire}', [FormulaireController::class, 'show'])
     ->name('admin.Unformulaire.show');

//Route::get('/admin/formulaires/{id}', [FormulaireController::class, 'show']) ->name('admin.Unformulaire.show');
Route::get('/AdminForums', [FormulaireController::class, 'afficherFormulaires'])->name('admin.formulaires.show');
//route admin vers professeurs
Route::get('/AdminProfesseurs',[AdminAuthenController::class,'enseignants'])->name('Admin.Lesprofesseurs');
//route admin creation professeur
Route::get('/Admin/professeurs/create',[EnseignantController::class,'create'])->name('Admin.professeurs.createprofesseur');
//route admin index professeur
Route::get('/Admin/professeurs/index',[EnseignantController::class,'index_prof'])->name('Admin.professeurs.indexprofesseur');
//route admin show details prof
Route::get('/Admin/professeurs/{id_enseignant}',[EnseignantController::class,'show'])->name('Admin.professeurs.showprofesseur');
//route professeur modification
Route::get('/Admin/professeurs/{id_enseignant}/edit',[EnseignantController::class,'edit'])->name('Admin.professeurs.editprofesseur');
//route admin pour modifer les infos d'un prof
Route::put('/Admin/professeurs/{id_enseignant}', [EnseignantController::class, 'update'])->name('Admin.professeurs.updateprofesseur');
//Route store prof
Route::post('/admin/professeurs/store', [EnseignantController::class, 'store'])->name('Admin.professeurs.storeprofesseur');

//route admin suppression professeur
Route::delete('/Admin/professeurs/{id_enseignant}', [EnseignantController::class, 'destroy'])
     ->name('Admin.professeurs.destroyprofesseur');


//route admin vers les inscriptions
Route::get('/AdminInscription',[InscriptionController::class,'index'])->name('Admin.Lesinscriptions');
//route admin vers les infod=s inscris
Route::get('/AdminInscripshow/{id_etudiant}',[InscriptionController::class,'show'])->name('admin.etudiant.show');
Route::get('/AdminInscripstatus/{id_etudiant}',[InscriptionController::class,'status'])->name('admin.etudiant.status');
Route::patch('/AdminInscripstatus/{id_etudiant}', [InscriptionController::class, 'status']);

//route admin vers les formations
Route::get('/AdminFormations',[FormationController::class,'afficher'])->name('admin.formations.index');
Route::get('/Admin/formations/create',[FormationController::class,'create'])->name('admin.formations.create');
Route::get('/Admin/formations/{id_formation}',[FormationController::class,'show'])->name('admin.formations.show');
Route::get('/Admin/formations/{id_formation}/edit',[FormationController::class,'edit'])->name('admin.formations.edit');
Route::delete('/Admin/fromations/{id_formation}', [FormationController::class, 'destroy'])->name('admin.formations.destroy');
Route::post('/Admin/formations/store', [FormationController::class, 'store'])->name('admin.formations.store');
Route::put('/Admin/formations/{id_formation}', [FormationController::class, 'update'])->name('admin.formations.update');



//route admin vers boite mail
Route::get('/AdminMails',function(){
    return view('Admin.emails');
})->name('Admin.emails');
//inscription getting
Route:: get('/inscription',function(){
    return view('etudiant.login');
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
    

// mn hna dashboard  table de bord etudiant
Route:: get('/login', function(){
    return view('Authentification');
})->name('login');

Route::post('/login', [AuthenController::class, 'login'])->name('login.submit');
//redirection dashboard etudiant
Route::middleware(['auth'])->get('/dashboard/etudiant', [DashboardController::class, 'etudiant'])
    ->name('dashboard.etudiant');
//mn hna forum inscription profeeseur khedam
Route::get('/inscription/enseignant', [EnseignantController::class, 'showRegistrationForm'])->name('enseignant.register');

Route::post('/inscription/enseignant', [EnseignantController::class, 'register'])->name('enseignant.register.submit');
Route::middleware(['auth:enseignant'])->group(function () {
    Route::get('/enseignant/dashboard', function () {
        return view('enseignant.dashboard');
    })->name('enseignant.dashboard');
});
// Dashboard pour les professeurs
Route::get('/enseignant/login', [EnseignantController::class, 'showLoginForm'])
     ->middleware('enseignant.redirect');
     // Routes d'authentification
Route::get('/enseignant/login', [EnseignantController::class, 'showLoginForm'])
->name('enseignant.login');
//mn hna atdkhli ldashboard enseignant
Route::post('/enseignant/login', [EnseignantController::class, 'login'])
->name('enseignant.login.submit');

Route::post('/enseignant/logout', [EnseignantController::class, 'logout'])
->name('enseignant.logout');
Route::get('/enseignant/logout-simple', function() {
    Auth::logout();
    return redirect('/');
})->name('enseignant.logout.simple');
// Routes protégées supplémentaires (exemples)
Route::middleware(['auth:enseignant'])->group(function () {
Route::get('/enseignant/profile', [EnseignantController::class, 'showProfile'])
    ->name('enseignant.profile');




});
Route::get('/admin/profil',[AdminAuthenController::class,'dashboard'])->name('admin.dashboard');

// Dans web.php
Route::get('/enseignant/cours', [EnseignantController::class, 'mescours'])->name('enseignant.courses.index');
Route::delete('/enseignant/courses/{id}', [EnseignantController::class, 'destroy_cours'])->name('enseignant.courses.destroy');
Route::get('enseignantt/courses/{id_cours}', [EnseignantController::class, 'showCours'])
         ->name('enseignant.courses.show');
Route::get('/enseignant/evaluations',[EnseignantController::class,'evaluation'])->name('enseignant.evaluations');
// web.php
Route::get('/enseignant/evaluations',[EvaluationController::class,'index'])->name('enseignant.evaluations.index');

Route::get('/emploi-du-temps', [EmploiEnseignant::class,'emploi'])->name('enseignant.emploi');
Route::get('/enseignant/evaluation/create',[EvaluationController::class,'create'])->name('enseignant.evaluations.create');
Route::get('/enseignant/evaluation/{id_evaluation}',[EvaluationController::class,'show_evaluation'])->name('enseignant.evaluations.show');
Route::post('/Enseignant/evaluation/store', [EvaluationController::class, 'store_evaluation'])->name('enseignant.evaluations.store');
Route::put('/enseignant/evaluation/{id_evaluation}', [EvaluationController::class, 'update_evaluation'])->name('enseignant.evaluations.update');
//Route::put('/enseignant/evaluation/publish', [EnseignantController::class, 'publier'])->name('enseignant.evaluations.publish');
Route::put('/enseignant/evaluation/{evaluation}/publish', [EnseignantController::class, 'publier'])
    ->name('enseignant.evaluations.publish');
Route::delete('/enseignant/evaluation/{id_evaluation}', [EvaluationController::class, 'destroy_evaluation'])->name('enseignant.evaluations.destroy');
Route::get('/evaluations/{id_evaluation}/notes/create', [NoteController::class, 'create'])
     ->name('notes.create');
Route::get('/enseignant/evaluations/{evaluation}/edit',[EvaluationController::class,'edit_evaluation'])->name('enseignant.evaluations.edit');
/*Route::get('/enseignant/evaluations/notes', [NoteController::class, 'index'])
     ->name('enseignant.notes.index');*/
     //Route::get('/enseignant/evaluations/{id_evaluation}/notes', [NoteController::class, 'index'])
    // ->name('enseignant.notes.index');
    Route::get('/enseignant/notes/{evaluation}', [NoteController::class, 'index'])
    ->name('enseignant.notes.index');
// Temporairement dans la route
Route::post('/enseignant/evaluations/{id_evaluation}/notes', [NoteController::class, 'store'])
    ->name('enseignant.notes.store');
Route::get('/test-find', function() {
    $eval = App\Models\Evaluation::first();
    dd($eval); // Vérifiez qu'une évaluation existe
});
   //Route::get('/enseignant/evaluations/{id}/notes', [NoteController::class, 'index'])->name('enseignant.notes.index');
Route::post('/notes', [NoteController::class, 'store'])
     ->name('enseignant.notes.store');
     Route::post('/notes', [NoteController::class, 'create'])
     ->name('enseignant.notes.create');
     Route::post('/evaluations/{evaluation}/notes', [NoteController::class, 'store'])
     ->name('enseignant.notes.store');
Route::get('/Eenseignant/Reclamations', [ReclamationController::class, 'index_enseignant'])->name('enseignant.reclamations.index');
Route::post('/enseignant/logout', [EnseignantController::class, 'logout'])->name('enseignant.logout');
// Pour afficher le formulaire de création
Route::get('/enseignant/reclamations/create', [ReclamationController::class, 'enseignant_createReclam'])
     ->name('enseignant.reclamations.create');

// Pour soumettre la réclamation
Route::post('/enseignant/reclamations', [ReclamationController::class, 'enseignant_storeReclam'])
     ->name('enseignant.reclamations.store');
//déconnexion
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
//accès dashboard etudiant en vérifiant le role




Route::get('/enseignant', [IndexEnseignantController::class, 'index']);
Route::get('/enseignant/dashboard/infos',[EnseignantController::class,'dashboard'])->name('enseignant.infos');
Route::get('/enseignant/courses/{id_cours}/edit', [EnseignantController::class, 'edit_cours'])->name('enseignant.courses.edit');
Route::get('/enseignant/profile/update',[EnseignantController::class,'updateprofile'])->name('enseignant.profile.update');
//suppression du cours
Route::delete('/Enseignant/courses/{id}', [EnseignantController::class, 'destroy_cours'])->name('enseignant.courses.destroy');
// afficher tous les cours
//creation cours
Route::get('/Enseignant/courses/create', [EnseignantController::class, 'create'])->name('enseignant.courses.create');

// Route pour stocker le cours après soumission du formulaire
Route::post('/Enseignant/courses/store', [CoursController::class, 'store'])->name('enseignant.courses.store');
//affichage cours
//modification du cours 
Route::put('/Enseignant/courses/{id}', [EnseignantController::class, 'updatecours'])->name('enseignant.courses.update');

Route::get('/EnseignantMails',function(){
    return view('enseignant.emails');
})->name('Enseignant.emails');

//sppp
Route::get('/sp', [IndexSpController::class, 'index']);

//partie reclamations
// Pour les étudiants
Route::middleware(['auth:etudiant'])->group(function () {
    Route::get('/reclamations/contre-professeur', [ReclamationController::class, 'createEtudVersProf'])->name('reclamations.etud.prof.create');
    Route::get('/reclamations/contre-etudiant', [ReclamationController::class, 'createEtudVersEtud'])->name('reclamations.etud.etud.create');
});

// Pour les professeurs
Route::middleware(['auth:professeur'])->group(function () {
    Route::get('/reclamations/contre-etudiant', [ReclamationController::class, 'createProfVersEtud'])->name('reclamations.prof.etud.create');
});

// Route commune pour la soumission
Route::post('/reclamations', [ReclamationController::class, 'store'])->name('reclamations.store');
use Illuminate\Support\Facades\Log;
// Dans routes/web.php

Route::get('/test-log', function () {
    Log::error('Ceci est un test de log Laravel');
    return 'Log ajouté';
});
// Route
/*Route::get('/telecharger-consigne/{filename}', function ($filename) {
    return response()->download(storage_path("app/public/evaluations/consignes/$filename"));
});*/
/*Route::get('/telecharger-consigne/{filename}', function ($filename) {
    $path = storage_path("app/public/evaluations/consignes/$filename");

    if (!file_exists($path)) {
        abort(404, "Fichier non trouvé.");
    }

    return response()->download($path);
})->name('telecharger-consigne');
*/



Route::get('/telecharger-consigne/{filename}', function ($filename) {
    $filename = urldecode(trim($filename));
    $path = storage_path("app/public/evaluations/consignes/$filename");

    if (!file_exists($path)) {
        return response("FICHIER INTROUVABLE<br>Nom reçu : [$filename]<br>Chemin : $path", 404);
    }

    return response()->download($path);
})->name('telecharger-consigne');


