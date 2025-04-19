<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Models\Cours;
use App\Models\enseignant;
use App\Models\Etudiant;
use App\Models\Evaluation;
use App\Models\formulaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\facades\Auth;

class CoursController extends Controller
{
    public function index()
{
        $courses = Cours::all();
        $courses = Cours::orderBy('created_at', 'desc')->get();

        return view('Admin.index', compact('courses'));
    }
    public function index_enseignant()
{
    $courses = Cours::where('id_enseignant', auth()->id())->get();
    return view('enseignant.coursesenseignant', compact('courses'));
}

    // CoursController.php

public function create()
{ $enseignants = Enseignant::all(); 
    return view('Admin.create', compact('enseignants'));
}
public function show($id_cours)
{
    // Récupérer le cours avec l'ID
    $cours = Cours::findOrFail($id_cours);

    // Retourner la vue avec le cours
    return view('Admin.show', compact('cours'));
}

    /*public function store(Request $request)
    {
        $validated = $request->validate([
           // 'titre' => 'required|regex:/^[\p{L}\s\'-]+$/u', // Expression régulière plus permissive
           'titre' => 'required|string|max:255',
           'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
            'id_enseignant' => 'required|exists:enseignant,id_enseignant'

        ]);

        $data = [
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'id_enseignant' => $validated['id_enseignant']
        ];
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('courses', 'public');
            $data['image'] = $filename;
        }

        Cours::create($data);

        //return redirect()->route('Admin.courses')->with('success', 'Cours créé avec succès!');
        return redirect()->route('Admin.courses.index')
                   ->with('success', 'Cours créé avec succès!');
    }*/
    /*public function store(Request $request)
{
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
        'id_enseignant' => 'sometimes|exists:enseignant,id_enseignant'
    ]);

    $data = $request->only(['titre', 'description', 'id_enseignant']);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('cours', 'public');
    }

    try {
        Cours::create($data);
        return redirect()->route('Admin.courses.index')
               ->with('success', 'Cours créé avec succès!');
    } catch (\Exception $e) {
        return back()->withInput()
               ->with('error', 'Erreur: ' . $e->getMessage());
    }
}*/
public function store(Request $request)
{
    // Validation
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'file' => 'nullable|file|mimes:pdf|max:10240',
    ]);

    // Stockage des fichiers
    $imagePath = $request->file('image')->store('cours/images', 'public');
    $filePath = $request->hasFile('file') ? $request->file('file')->store('cours/files', 'public') : null;

    // Création du cours avec l'enseignant authentifié
    $cours = new Cours();
    $cours->titre = $validated['titre'];
    $cours->description = $validated['description'];
    $cours->image = $imagePath;
    $cours->file = $filePath;
    $cours->id_enseignant = auth()->id()??1; // L'enseignant connecté
    $cours->save();

    return redirect()->route('Enseignant.courses.index')->with('success', 'Cours créé avec succès');
}
public function edit($id)
{
    // Récupérer le cours par ID
    $cours = Cours::findOrFail($id);  // Utilise findOrFail pour obtenir le cours ou générer une erreur 404
    return view('Admin.edit', compact('cours'));  // Assure-toi que la vue 'edit' existe
}
public function update(Request $request, $id)
    {
        $cours = Cours::findOrFail($id);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
            'id_enseignant' => 'required|exists:enseignant,id_enseignant'
        ]);

        $data = [
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'id_enseignant' => $validated['id_enseignant']
        ];

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($cours->image) {
                Storage::disk('public')->delete($cours->image);
            }
            
            $imagePath = $request->file('image')->store('courses', 'public');
            $data['image'] = $imagePath;
        }

        $cours->update($data);

        return redirect()->route('Admin.courses.index')
                       ->with('success', 'Cours mis à jour avec succès!');
    }
    public function destroy($id)
    {
        $course = Cours::findOrFail($id);

        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('Admin.courses')->with('success', 'Cours supprimé proprement!');
    }
/*public function store(Request $request)
{
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
        'id_enseignant' => 'sometimes|exists:enseignant,id_enseignant' // Modifié en 'sometimes'
    ]);

    // Si id_enseignant n'est pas fourni, utiliser l'ID de l'enseignant connecté
    if (!isset($validated['id_enseignant']) && auth('enseignant')->check()) {
        $validated['id_enseignant'] = auth('enseignant')->id();
    }

    // Vérification finale
    if (!isset($validated['id_enseignant'])) {
        return back()->with('error', 'Aucun enseignant associé au cours');
    }

    // Traitement de l'image
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('cours', 'public');
    }

    try {
        Cours::create($validated);
        return redirect()->route('Enseignant.courses.index')
               ->with('success', 'Cours créé avec succès!');
    } catch (\Exception $e) {
        return back()->withInput()
               ->with('error', 'Erreur: ' . $e->getMessage());
    }
}

    
    public function edit($id)
{
    // Récupérer le cours par ID
    $cours = Cours::findOrFail($id);  // Utilise findOrFail pour obtenir le cours ou générer une erreur 404
    return view('Admin.edit', compact('cours'));  // Assure-toi que la vue 'edit' existe
}
public function update(Request $request, $id)
{
    $course = Cours::findOrFail($id);

    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
    ]);

    $data = [
        'titre' => $request->titre,
        'description' => $request->description,
    ];

    // Gestion de l'image
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($course->image && Storage::disk('public')->exists($course->image)) {
            Storage::disk('public')->delete($course->image);
        }

        // Stocker la nouvelle image
        $imagePath = $request->file('image')->store('cours', 'public');
        $data['image'] = $imagePath;
    }

    $course->update($data);

    return redirect()->route('Admin.courses')
           ->with('success', 'Cours mis à jour avec succès!');
           // Juste avant le return
Log::info('Image path after update: ' . $course->image);
Log::info('Full URL: ' . asset('storage/'.$course->image));
}


    public function destroy($id)
    {
        $course = Cours::findOrFail($id);

        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('Admin.courses')->with('success', 'Cours supprimé proprement!');
    }
// Dans AdminController.php (ou le contrôleur qui gère /AdminAnalyses)
public function analyses()
    {
        // Récupération des statistiques
        $enseignantCount = Enseignant::count();
        $etudiantCount = Etudiant::count();
        $coursCount = Cours::count();
       // $evaluationCount = Evaluation::count();
        //$averageEvaluationScore = Evaluation::avg('score') ?? 0;

        // Cours récents
        $recentCours = Cours::withCount('etudiants')
            ->with('enseignant')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Données pour les graphiques
        $enrollmentData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'data' => [65, 59, 80, 81, 56, 55]
        ];

        $userDistribution = [
            'enseignants' => $enseignantCount,
            'etudiants' => $etudiantCount,
            'admins' => 1 // À remplacer par Admin::count() si vous avez ce modèle
        ];

        return view('analyses', compact(
            'enseignantCount',
            'etudiantCount',
            'coursCount',
            'evaluationCount',
            'averageEvaluationScore',
            'recentCours',
            'enrollmentData',
            'userDistribution'
        ));
    }
    public function afficherFormulaires()
{
    // On récupère les formulaires avec l'étudiant lié
    $formulaires = Formulaire::with('etudiant')->orderBy('date_publication', 'desc')->get();

    // On retourne la vue avec les données
    return view('admin.Forums', compact('formulaires'));
}
    
}




/*namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
    public function index()
    {
        $courses = Cours::with('enseignant')->orderBy('created_at', 'desc')->get();
        return view('Admin.index', compact('courses'));
    }

    public function create()
    {
        $enseignants = Enseignant::all();
        return view('Admin.create', compact('enseignants'));
    }

    public function show($id_cours)
    {
        $cours = Cours::with('enseignant')->findOrFail($id_cours);
        return view('Admin.show', compact('cours'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
            'id_enseignant' => 'required|exists:enseignant,id_enseignant'
        ]);

        // Traitement de l'image
       // $imagePath = $request->file('image')->store('courses', 'public');
        $imagePath = $request->hasFile('image') 
    ? $request->file('image')->store('courses', 'public') 
    : null;
        
        // Création du cours
        $cours = Cours::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'id_enseignant' => $validated['id_enseignant']
        ]);

        return redirect()->route('Admin.courses.index')
                       ->with('success', 'Cours créé avec succès!');
    
                       
    }

    public function edit($id)
    {
        $cours = Cours::findOrFail($id);
        $enseignants = Enseignant::all();
        return view('Admin.edit', compact('cours', 'enseignants'));
    }

    public function update(Request $request, $id)
    {
        $cours = Cours::findOrFail($id);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
            'id_enseignant' => 'required|exists:enseignant,id_enseignant'
        ]);

        $data = [
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'id_enseignant' => $validated['id_enseignant']
        ];

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($cours->image) {
                Storage::disk('public')->delete($cours->image);
            }
            
            $imagePath = $request->file('image')->store('courses', 'public');
            $data['image'] = $imagePath;
        }

        $cours->update($data);

        return redirect()->route('Admin.courses.index')
                       ->with('success', 'Cours mis à jour avec succès!');
    }

    public function destroy($id)
    {
        $cours = Cours::findOrFail($id);

        if ($cours->image) {
            Storage::disk('public')->delete($cours->image);
        }

        $cours->delete();

        return redirect()->route('Admin.courses.index')
                       ->with('success', 'Cours supprimé avec succès!');
    }

}*/
}
?>