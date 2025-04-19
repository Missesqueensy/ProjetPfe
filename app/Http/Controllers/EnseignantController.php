<?php

namespace App\Http\Controllers;
use App\Models\enseignant;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Etudiant;



class EnseignantController extends Controller
{
    public function showRegistrationForm()
    {
        return view('inscription'); 
    }
    public function showLoginForm()
    {
        return view('Authen_professeur'); // Créez cette vue
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:enseignant',
            'password' => 'required|string|min:8|confirmed',
            'specialite' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $enseignant = Enseignant::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'specialite' => $request->specialite,
            'departement' => $request->departement,
        ]);
        auth('enseignant')->login($enseignant);

        return redirect()->route('front.index')->with('success', 'Inscription réussie ! Veuillez se connecter');

    }
   /* public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::guard('enseignant')->attempt($credentials)) {
        $request->session()->regenerate();
        
        return redirect()->intended('/enseignant/dashboard'); // Redirigez vers le tableau de bord
    }

    return back()->withErrors([
        'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
    ])->onlyInput('email');
}*/
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');
    
    if (Auth::guard('enseignant')->attempt($credentials, $request->remember)) {
        $request->session()->regenerate();
        return redirect()->intended('/enseignant/dashboard');
    }

    return back()->withErrors([
        'email' => 'Identifiants incorrects',
    ])->withInput($request->only('email', 'remember'));
}

    public function index_prof()
{
    $enseignants = Enseignant::orderBy('nom')->paginate(10); // Pagination avec 10 éléments par page
    return view('Admin.indexprof', compact('enseignants'));
}
public function index_cours()
{
        $courses = Cours::all();
        $courses = Cours::orderBy('created_at', 'desc')->get();

        return view('Enseignant.coursesenseignant', compact('courses'));
    }
    
public function create()
{
    $departements = ['Informatique', 'Mathématiques', 'Physique', 'Chimie','Biologie'];
    return view('enseignant.create', compact('departements'));
}

// Traiter la création
public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:50',
        'prenom' => 'required|string|max:50',
        'email' => 'required|email|unique:enseignant',
        'specialite' => 'required|string|max:100',
        'departement' => 'required|string|max:50'
    ]);
    $password = Str::random(12); // 12 caractères aléatoires
    $validated['password'] = bcrypt($password); // Hashage sécurisé

    Enseignant::create($validated);

    return redirect()
           ->route('Admin.professeurs.indexprofesseur')
           ->with('success', 'Enseignant créé avec succès');
}
    public function show($id_enseignant)
{
    // Récupérer le cours avec l'ID
    $enseignant = enseignant::findOrFail($id_enseignant);

    // Retourner la vue avec le cours
    return view('Admin.showprof', compact('enseignant'));
}
public function edit($id_enseignant)
{
    // Récupère l'enseignant ou renvoie une erreur 404 si non trouvé
    $enseignant = Enseignant::findOrFail($id_enseignant);
    
    // Si vous avez des données supplémentaires à passer (comme des départements)
    $departements = ['Informatique', 'Mathématiques', 'Physique', 'Chimie']; // Exemple
    
    return view('Admin.editprof', compact('enseignant', 'departements'));
}

public function update(Request $request, $id_enseignant)
{
    // Validation des données
    $validated = $request->validate([
        'nom' => 'required|string|max:50',
        'prenom' => 'required|string|max:50',
        'email' => 'required|email|unique:enseignant,email,'.$id_enseignant.',id_enseignant',
        'specialite' => 'required|string|max:100',
        'departement' => 'required|string|max:50'
    ]);

    // Trouve l'enseignant à modifier
    $enseignant = Enseignant::findOrFail($id_enseignant);
    
    // Met à jour les données
    $enseignant->update($validated);
    
    // Redirection avec message de succès
    return redirect()
           ->route('Admin.professeurs.showprofesseur', $enseignant->id_enseignant)
           ->with('success', 'Les informations de l\'enseignant ont été mises à jour avec succès');
}
public function destroy($id_enseignant)
{
    try {
        $enseignant = Enseignant::findOrFail($id_enseignant);
        
        // Vérification des dépendances optionnelle
        if ($enseignant->cours()->exists()) {
            return back()->with('error', 'Impossible de supprimer : professeur associé à des cours');
        }

        $enseignant->delete();

        return redirect()
               ->route('Admin.professeurs.index')
               ->with('success', 'Professeur supprimé avec succès');

    } catch (\Exception $e) {
        return back()->with('error', 'Erreur lors de la suppression');
    }
}
public function createProfVersEtud()
{
    $etudiants = Etudiant::all();
    return view('reclamations.create', [
        'type' => 'prof_vers_etud',
        'destinataires' => $etudiants,
        'destinataireType' => Etudiant::class
    ]);
}
public function logout(Request $request)
{
    auth('enseignant')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}
}