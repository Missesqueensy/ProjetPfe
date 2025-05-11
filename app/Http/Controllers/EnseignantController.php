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
use App\Models\Evaluation;
use App\Models\Note;
use App\Models\EmploiDuTemps;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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
    /*public function dashboard()
    {
        $enseignant = Auth::guard('enseignant')->user();

    $evaluations = Evaluation::where('id_enseignant', $enseignant->id)
                              ->with(['cours', 'classe'])
                              ->get();
        // On récupère l'enseignant connecté
        return view('enseignant.dashboard', compact('enseignant', 'evaluations'));
    }*/
    public function dashboard()
{
    $enseignant = Auth::guard('enseignant')->user();
    
    // Debug 1 - Vérifiez l'utilisateur connecté
    if (!$enseignant) {
        dd('Aucun enseignant connecté');
    }

    $evaluations = Evaluation::where('id_enseignant', $enseignant->id)
                          ->with(['cours', 'classe'])
                          ->get();

    // Debug 2 - Vérifiez les évaluations
    if ($evaluations->isEmpty()) {
        dd('Aucune évaluation trouvée pour cet enseignant', $enseignant);
    }

    return view('enseignant.dashboard', [
        'enseignant' => $enseignant,
        'evaluations' => $evaluations
    ]);
}

    public function updateprofile(Request $request)
    {
        // 1. Récupérer l'enseignant authentifié
        $enseignant = Auth::guard('enseignant')->user();
        
        // 2. Validation des données
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|string|max:255',
            'prenom' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:enseignant,email,'.$enseignant->id_enseignant.',id_enseignant',
            'specialite' => 'sometimes|string|max:255',
            'departement' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:8|confirmed',
            //'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /*if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }*/

        // 3. Préparation des données à mettre à jour
        $data = $request->only([
            'nom', 'prenom', 'email', 
            'specialite', 'departement'
        ]);

        // 4. Gestion du mot de passe si fourni
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 5. Gestion de l'avatar si présent
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars/enseignants', 'public');
            $data['avatar'] = $avatarPath;
            
            // Supprimer l'ancien avatar si nécessaire
            if ($enseignant->avatar) {
                Storage::disk('public')->delete($enseignant->avatar);
            }
        }

        // 6. Mise à jour du profil
        $enseignant->update($data);

        // 7. Retourner la réponse
        return response()->json([
            'status' => 'success',
            'message' => 'Profil mis à jour avec succès',
            'enseignant' => $enseignant->fresh()
        ], 200);
    }


public function register(Request $request)
{
    // Validation des données
    $validator = Validator::make($request->all(), [
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:enseignant',
        'password' => 'required|string|min:8|confirmed',
        'specialite' => 'required|string|max:255',
        'departement' => 'required|string|max:255',
    ]);

    // Retour en cas d'erreur de validation
    if ($validator->fails()) {
        return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
    }

    // Création de l'enseignant avec sauvegarde explicite
    $enseignant = new Enseignant();
    $enseignant->nom = $request->nom;
    $enseignant->prenom = $request->prenom;
    $enseignant->email = $request->email;
    $enseignant->password = Hash::make($request->password);
    $enseignant->specialite = $request->specialite;
    $enseignant->departement = $request->departement;
    $enseignant->save(); // Sauvegarde manuelle qui gère correctement l'auto-incrément

    // Connexion automatique
    auth('enseignant')->login($enseignant);

    // Redirection avec message de succès
    return redirect()->route('front.index')
               ->with('success', 'Inscription réussie ! Vous êtes maintenant connecté');
}
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

public function evaluation(Request $request)
{
    $enseignant = Auth::guard('enseignant')->user();
    
    // Récupérer les cours de l'enseignant
    $cours = Cours::where('id_enseignant', $enseignant->id_enseignant)
                ->select('id_cours', 'titre')
                ->orderBy('titre')
                ->pluck('titre', 'id_cours');

    // Récupérer les évaluations avec pagination
    $evaluations = Evaluation::where('id_enseignant', $enseignant->id_enseignant)
        ->with(['cours'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        $stats = [
            'total' => Evaluation::where('id_enseignant', $enseignant->id_enseignant)->count(),
            'a_venir' => Evaluation::where('id_enseignant', $enseignant->id_enseignant)
                          ->where('date_debut', '>', now())->count(),
            'en_cours' => Evaluation::where('id_enseignant', $enseignant->id_enseignant)
                           ->where('date_debut', '<=', now())
                           ->where('date_limite', '>=', now())->count(),
            'terminees' => Evaluation::where('id_enseignant', $enseignant->id_enseignant)
                            ->where('date_limite', '<', now())->count(),
        ];
    return view('enseignant.evaluationindex', [
        'evaluations' => $evaluations,
        'enseignant' => $enseignant,
        'cours' => $cours // Ajout de la variable $cours
    ]);
}
public function create_evaluation()
{
    // Récupérer l'enseignant connecté
    $enseignant = Auth::guard('enseignant')->user();
    
    // Récupérer les cours de l'enseignant pour le dropdown
    $cours = $enseignant->courses()
        ->select('id_cours', 'titre')
        ->orderBy('titre')
        ->pluck('titre', 'id_cours');

    // Types d'évaluation disponibles
    $types = [
        'examen' => 'Examen',
        'devoir' => 'Devoir',
        'quiz' => 'Quiz',
        'projet' => 'Projet'
    ];

    return view('enseignant.create_evaluation', [
        'cours' => $cours,
        'types' => $types,
        'default_date' => now()->addWeek()->format('Y-m-d\TH:i'), // Valeur par défaut pour le datetime-local
        'default_bareme' => 20.00 // Barème par défaut
    ]);
}
/*public function show_evaluation($id_evaluation)
{
    $evaluation = Evaluation::with(['cours', 'enseignant'])
        ->where('id_enseignant', Auth::guard('enseignant')->id())
        ->findOrFail($id_evaluation);

    return view('enseignant.show_evaluation', [
        'evaluation' => $evaluation,
        //'participants' => $this->getParticipantsCount($id_evaluation) // Fonction helper
    ]);
}*/
/*public function show_evaluation($id_evaluation)
{
    $evaluation = Evaluation::with(['cours', 'enseignant', 'classe.etudiants'])
        ->where('id_enseignant', Auth::guard('enseignant')->id())
        ->findOrFail($id_evaluation);

    // Si vous avez besoin des notes, vous devrez les récupérer séparément
    $notes = Note::where('id_evaluation', $id_evaluation)
                ->with('etudiant')
                ->get();

    return view('enseignant.show_evaluation', [
        'evaluation' => $evaluation,
        'notes' => $notes
    ]);
}*/
public function show_evaluation2($id_evaluation)
{
    $evaluation = Evaluation::with([
            'classe.etudiants', // Charge la classe et ses étudiants
            'notes.etudiant',   // Charge les notes et leurs étudiants associés
            'cours'             // Charge le cours associé
        ])
        ->withCount('notes')    // Optimisation pour compter les notes
        ->findOrFail($id_evaluation);

    // Solution alternative si withCount n'est pas possible
    if ($evaluation->classe) {
        $evaluation->classe->loadCount('etudiants');
    }

    return view('enseignant.show_evaluation', compact('evaluation'));
}


// Fonction helper pour compter les participants
/*private function getParticipantsCount($evaluationId)
{
    return DB::table('evaluation_etudiant')
        ->where('id_evaluation', $evaluationId)
        ->count();
}*/
public function edit_evaluation($id_evaluation)
{
    $evaluation = Evaluation::where('id_enseignant', Auth::guard('enseignant')->id())
        ->findOrFail($id_evaluation);

    $cours = Auth::guard('enseignant')->user()
        ->courses()
        ->pluck('titre', 'id_cours');

    return view('enseignant.edit_evaluation', [
        'evaluation' => $evaluation,
        'cours' => $cours,
        'types' => [
            'examen' => 'Examen',
            'devoir' => 'Devoir', 
            'quiz' => 'Quiz',
            'projet' => 'Projet'
        ],
        'statuts' => [
            'brouillon' => 'Brouillon',
            'programme' => 'Programmé',
            'publie' => 'Publié',
            'archive' => 'Archivé'
        ]
    ]);
}
public function destroy_evaluation($id_evaluation)
{
    // Trouver l'évaluation avec vérification des relations
    $evaluation = Evaluation::with(['cours', 'enseignant'])
                          ->findOrFail($id_evaluation);

    // Récupérer l'utilisateur authentifié selon son type
    $user = null;
    $userType = null;

    if (Auth::guard('enseignant')->check()) {
        $user = Auth::guard('enseignant')->user();
        $userType = 'enseignant';
    } elseif (Auth::guard('admin')->check()) {
        $user = Auth::guard('admin')->user();
        $userType = 'admin';
    } else {
        return redirect()->route('login')->with('error', 'Authentification requise');
    }

    // Vérifier les permissions
    if ($userType === 'enseignant' && $user->id_enseignant !== $evaluation->id_enseignant) {
        return redirect()->route('evaluations.index')
                       ->with('error', 'Action non autorisée.');
    }

    // Admins ont automatiquement la permission, pas besoin de vérification supplémentaire

    // Vérifier que l'évaluation peut être supprimée (statut approprié)
    if (!in_array($evaluation->statut, ['brouillon', 'programme'])) {
        return redirect()->back()
                       ->with('error', 'Impossible de supprimer une évaluation en cours ou terminée.');
    }

    // Suppression des fichiers associés
    foreach (['fichier_consigne', 'fichier_correction'] as $fileAttribute) {
        if ($evaluation->$fileAttribute) {
            Storage::disk('public')->delete($evaluation->$fileAttribute);
        }
    }

    // Suppression en utilisant soft delete
    $evaluation->delete();

    // Redirection avec message contextualisé
    $redirectRoute = $userType === 'admin' 
                   ? 'Admin.evaluations' 
                   : 'enseignant.evaluations';

    return redirect()->route($redirectRoute)
                   ->with('success', "L'évaluation '{$evaluation->titre}' a été supprimée avec succès.");
}
/*public function destroy_evaluation($id_evaluation)
{
    // Trouver l'évaluation avec vérification des relations
    $evaluation = Evaluation::with(['cours', 'enseignant'])
                          ->findOrFail($id_evaluation);

    // Vérifier que l'utilisateur est l'enseignant associé ou un admin
    if (Auth::id() !== $evaluation->id_enseignant && !Auth::user()->hasRole('admin')) {
        return redirect()->route('evaluations.index')
                       ->with('error', 'Action non autorisée.');
    }

    // Vérifier que l'évaluation peut être supprimée (statut approprié)
    if (!in_array($evaluation->statut, ['brouillon', 'programme'])) {
        return redirect()->back()
                       ->with('error', 'Impossible de supprimer une évaluation en cours ou terminée.');
    }

    // Suppression des fichiers associés
    foreach (['fichier_consigne', 'fichier_correction'] as $fileAttribute) {
        if ($evaluation->$fileAttribute) {
            Storage::disk('public')->delete($evaluation->$fileAttribute);
        }
    }

    // Suppression en utilisant soft delete
    $evaluation->delete();

    // Redirection avec message contextualisé
    $redirectRoute = Auth::user()->hasRole('admin') 
                    ? 'Admin.evaluations' 
                    : 'enseignant.evaluations';

    return redirect()->route($redirectRoute)
                   ->with('success', "L'évaluation '{$evaluation->titre}' a été supprimée avec succès.");
}*/
/*public function store_evaluation(Request $request)
{
    $validated = $this->validateEvaluation($request);
    
    DB::beginTransaction();
    try {
        $evaluation = new Evaluation();
        $evaluation->fill($validated);
        $evaluation->id_enseignant = Auth::guard('enseignant')->id();
        $evaluation->date_limite = Carbon::parse($validated['date_evaluation'])
            ->addMinutes($validated['duree_minutes']);
        
        $this->handleFileUpload($request, $evaluation);
        
        $evaluation->save();
        
        DB::commit();
        
        return redirect()
            ->route('enseignant.evaluations.show', $evaluation->id_evaluation)
            ->with('success', 'Évaluation créée avec succès!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()
            ->withInput()
            ->with('error', "Erreur lors de la création: " . $e->getMessage());
    }
}*/
public function store_evaluation(Request $request)
{
    // Debug: Log les données reçues
    Log::debug('Données reçues:', $request->all());
    
    $validated = $this->validateEvaluation($request);
    
    DB::beginTransaction();
    try {
        $evaluation = new Evaluation();
        
        // Assignation manuelle pour mieux contrôler
        $evaluation->titre = $validated['titre'];
        $evaluation->description = $validated['description'];
        $evaluation->type = $validated['type'];
        $evaluation->date_evaluation = $validated['date_evaluation'];
        $evaluation->duree_minutes = $validated['duree_minutes'];
        $evaluation->bareme_total = $validated['bareme_total'];
        $evaluation->id_cours = $validated['id_cours'];
        $evaluation->id_enseignant = Auth::guard('enseignant')->id();
        $evaluation->statut = 'brouillon'; // Valeur par défaut
        $evaluation->est_visible = false; // Valeur par défaut
        
        // Calcul date limite
        $evaluation->date_limite = Carbon::parse($validated['date_evaluation'])
            ->addMinutes($validated['duree_minutes']);
        
        // Gestion fichier
        if ($request->hasFile('fichier_consigne')) {
            $path = $request->file('fichier_consigne')
                ->store('evaluations/consignes', 'public');
            $evaluation->fichier_consigne = $path;
        }
        
        // Debug avant sauvegarde
        Log::debug('Évaluation à sauvegarder:', $evaluation->toArray());
        
        if ($evaluation->save()) {
            DB::commit();
            Log::info('Évaluation créée avec ID: '.$evaluation->id);
            return redirect()
                ->route('enseignant.evaluations.show', $evaluation->id_evaluation)
                ->with('success', 'Évaluation créée avec succès!');
        } else {
            throw new \Exception("Échec de l'enregistrement sans erreur");
        }

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Erreur création évaluation: '.$e->getMessage());
        Log::error('Stack trace: '.$e->getTraceAsString());
        return back()
            ->withInput()
            ->with('error', "Erreur lors de la création: " . $e->getMessage());
    }
}

// Validation des données
private function validateEvaluation(Request $request)
{
    return $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string',
        'type' => 'required|in:examen,devoir,quiz,projet',
        'id_cours' => 'required|exists:cours,id_cours',
        'date_evaluation' => 'required|date|after_or_equal:now',
        'duree_minutes' => 'required|integer|min:1|max:360',
        'bareme_total' => 'required|numeric|min:1|max:100',
        'fichier_consigne' => 'nullable|file|mimes:pdf|max:5120',
        'statut' => 'required|in:brouillon,programme,publie,archive'
    ]);
}

// Gestion des fichiers
private function handleFileUpload(Request $request, Evaluation $evaluation)
{
    if ($request->hasFile('fichier_consigne')) {
        // Supprimer l'ancien fichier si existe
        if ($evaluation->fichier_consigne) {
            Storage::disk('public')->delete($evaluation->fichier_consigne);
        }
        
        $path = $request->file('fichier_consigne')
            ->store('evaluations/consignes', 'public');
        $evaluation->fichier_consigne = $path;
    }
}
public function update_evaluation(Request $request, $id_evaluation)
{
    $evaluation = Evaluation::where('id_enseignant', Auth::guard('enseignant')->id())
        ->findOrFail($id_evaluation);

    $validated = $this->validateEvaluation($request);
    
    DB::beginTransaction();
    try {
        $evaluation->fill($validated);
        $evaluation->date_limite = Carbon::parse($validated['date_evaluation'])
            ->addMinutes($validated['duree_minutes']);
        
        $this->handleFileUpload($request, $evaluation);
        
        $evaluation->save();
        
        DB::commit();
        
        return redirect()
            ->route('enseignant.evaluations.show', $evaluation->id_evaluation)
            ->with('success', 'Évaluation mise à jour avec succès!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()
            ->withInput()
            ->with('error', "Erreur lors de la mise à jour: " . $e->getMessage());
    }
}
public function showCours($id)
{
    $enseignantId = Auth::guard('enseignant')->id();

    // Récupérer le cours appartenant à l'enseignant connecté
    $cours = Cours::where('id_cours', $id)
                  ->where('id_enseignant', $enseignantId)
                  ->firstOrFail();

    return view('enseignant..showcours', compact('cours'));
}

public function edit($id_enseignant)
{
    // Récupère l'enseignant ou renvoie une erreur 404 si non trouvé
    $enseignant = Enseignant::findOrFail($id_enseignant);
    
    // Si vous avez des données supplémentaires à passer (comme des départements)
    $departements = ['Informatique', 'Mathématiques', 'Physique', 'Chimie']; // Exemple
    
    return view('Admin.editprof', compact('enseignant', 'departements'));
}

public function edit_cours($id_cours)
{
    // Vérifie que le cours existe et appartient à l'enseignant connecté
    $course = Cours::where('id_cours', $id_cours)
    ->where('id_enseignant', auth('enseignant')->id())  // Modification ici

                ->firstOrFail();
                if (!$course->created_at) {
                    $course->created_at = now();
                }
    // Formatage des dates pour les champs datetime-local
    $formattedDates = [
        'date_publication' => $course->date_publication 
                            ? $course->date_publication->format('Y-m-d\TH:i') 
                            : null,
    ];

    return view('enseignant.edit', [
        'course' => $course,
        'formattedDates' => $formattedDates,
        'currentFile' => $course->file ? [
            'name' => basename($course->file),
            'url' => Storage::url($course->file)
        ] : null,
        'currentVideo' => $course->video_path ? [
            'name' => basename($course->video_path),
            'url' => Storage::url($course->video_path)
        ] : null,
        'currentImage' => $course->image ? [
            'name' => basename($course->image),
            'url' => Storage::url($course->image)
        ] : null,
    ]);
}

public function mescours()
{
    $courses = Auth::guard('enseignant')->user()->courses()
                ->orderBy('created_at', 'desc')
                ->paginate(10);
    
    return view('enseignant.index', compact('courses'));
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
public function updatecours(Request $request, $id)
{
    // Validation
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'video' => 'nullable|file|mimes:mp4,webm,mov|max:51200', // 50MB
        'remove_image' => 'nullable|boolean',
        'remove_video' => 'nullable|boolean',
    ]);

    $course = Cours::findOrFail($id);

    // Gestion de l'image
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        $imagePath = $request->file('image')->store('cours/images', 'public');
        $course->image = $imagePath;
    } elseif ($request->has('remove_image')) {
        // Supprimer l'image
        Storage::disk('public')->delete($course->image);
        $course->image = null;
    }

    // Gestion de la vidéo
    if ($request->hasFile('video')) {
        // Supprimer l'ancienne vidéo si elle existe
        if ($course->video_path) {
            Storage::disk('public')->delete($course->video_path);
        }
        $videoPath = $request->file('video')->store('cours/videos', 'public');
        $course->video_path = $videoPath;
        $course->format_video = $request->file('video')->getClientOriginalExtension();
    } elseif ($request->has('remove_video')) {
        // Supprimer la vidéo
        Storage::disk('public')->delete($course->video_path);
        $course->video_path = null;
        $course->format_video = null;
    }

    // Mise à jour des autres champs
    $course->titre = $validated['titre'];
    $course->description = $validated['description'];
    $course->save();

    return redirect()->route('enseignant.courses.index')->with('success', 'Cours mis à jour avec succès');
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


public function destroy_cours($id)
{
    $course = Cours::findOrFail($id);
    $course->delete();
    
    return redirect()->route('enseignant.courses.index')
        ->with('success', 'Cours supprimé avec succès');
}
// EmploiDuTempsController.php

// TeacherScheduleController.php
public function index()
{
    $events = EmploiDuTemps::with([
            'cours:id_cours,titre', 
            'enseignant:id_enseignant,nom,prenom'
        ])
        ->where('id_enseignant', auth()->user()->enseignant->id_enseignant)
        ->select('id', 'id_cours', 'id_enseignant', 'debut', 'fin', 'salle')
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->cours->titre,
                'start' => $item->debut->toIso8601String(),
                'end' => $item->fin->toIso8601String(),
                'salle' => $item->salle,
                'extendedProps' => [
                    'enseignant' => $item->enseignant->nom . ' ' . $item->enseignant->prenom
                ]
            ];
        });

    return view('enseignant.emploi-temps', compact('events'));
}
public function emploi(){
    return view('enseignant.emploi-temps');
}
/*public function publier(Request $request)
{
    // Validation
    $request->validate([
        'evaluation_id' => 'required|exists:evaluations,id_evaluation'
    ]);

    // Logique de publication
    $evaluation = Evaluation::find($request->evaluation_id);
    $evaluation->update(['statut' => 'publie']);

    return response()->json([
        'success' => true,
        'message' => 'Évaluation publiée avec succès'
    ]);
}*/
public function publier(Evaluation $evaluation)
{
    // Validation et logique métier
    $evaluation->update(['statut' => 'publié']);

    return redirect()->back()
        ->with('success', 'Les notes ont été publiées avec succès !');
}

}