<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


    /*public function index()
{
        $courses = Cours::all();
        $courses = Cours::orderBy('created_at', 'desc')->get();

        return view('Admin.index', compact('courses'));
    }
    // CoursController.php

public function create()
{ $enseignants = Enseignant::all(); // Assurez-vous d'avoir le modèle Enseignant
    return view('Admin.create', compact('enseignants'));

    // Ici tu peux retourner une vue avec un formulaire pour créer un cours
    //return view('Admin.create');
}
public function show($id_cours)
{
    // Récupérer le cours avec l'ID
    $cours = Cours::findOrFail($id_cours);

    // Retourner la vue avec le cours
    return view('Admin.show', compact('cours'));
}

    public function store(Request $request)
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
    }

    public function update(Request $request, $id)
    {
        $course = Cours::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
            'titre' => 'required|regex:/^[A-Za-z\s]+$/',
            'description' => 'required',
        ]);

        $data = $request->only(['image', 'titre', 'description']);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }

            $filename = $request->file('image')->store('cours', 'public');
            $data['image'] = $filename;
        }

        $course->update($data);

        return redirect()->route('Admin.courses')->with('success', 'Cours est actualisé avec succès!');
    }
    public function edit($id)
{
    // Récupérer le cours par ID
    $cours = Cours::findOrFail($id);  // Utilise findOrFail pour obtenir le cours ou générer une erreur 404
    return view('Admin.edit', compact('cours'));  // Assure-toi que la vue 'edit' existe
}


    public function destroy($id)
    {
        $course = Cours::findOrFail($id);

        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('Admin.courses')->with('success', 'Cours supprimé proprement!');

    }*/

namespace App\Http\Controllers;

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
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:5000',
            'id_enseignant' => 'required|exists:enseignant,id_enseignant'
        ]);

        // Traitement de l'image
        $imagePath = $request->file('image')->store('courses', 'public');
        
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

}
?>