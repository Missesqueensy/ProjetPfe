<?php

namespace App\Http\Controllers;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Route; // Ajoutez cette ligne en haut du contrôleur
use Illuminate\Support\Facades\Log; 
use Carbon\Carbon;

class FormationController extends Controller
{
    public function afficher()
{
    $formations = Formation::all();
    return view('Admin.Lesformations', compact('formations'));
}
public function show($id_formation)
{
    // Récupère UNE seule formation spécifique
    $formation = Formation::findOrFail($id_formation);
    
    // Retourne une vue de détail
    return view('Admin.formation-show', compact('formation'));
}
public function edit($id_formation)
{
    // Récupère la formation à éditer ou renvoie une 404 si non trouvée
    $formation = Formation::findOrFail($id_formation);
    
    // Formatage des dates pour l'affichage dans le formulaire
    if ($formation->date_debut && $formation->date_fin) {
        $formation->date_debut = $formation->date_debut->format('Y-m-d');
        $formation->date_fin = \Carbon\Carbon::parse($formation->date_fin)->format('Y-m-d');
    }

    return view('admin.formations-edit', [
        'formation' => $formation,
        'title' => 'Modifier la formation'
    ]);
}
public function create()
{
    return view('Admin.formation-create', [
        'title' => 'Créer une nouvelle formation'
    ]);
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'contenu_video' => 'required|string',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        // 'duree' => 'required|integer|min:1' // Supprimez ou ajoutez le champ dans la migration
    ]);

    // Debug: afficher les données validées
    // dd($validated);

    try {
        // Upload image
        $imagePath = $request->file('image')->store('public/formations/images');
        $validated['image'] = str_replace('public/', 'storage/', $imagePath);

        // Création
        Formation::create($validated);

        // Redirigez vers la bonne route (vérifiez votre web.php)
        return redirect()->route('admin.formations.index') // ou le nom de votre route
            ->with('success', 'Formation créée avec succès!');

    } catch (\Exception $e) {
        // Log l'erreur pour débogage
        Log::error('Erreur création formation: ' . $e->getMessage());
        
        // Nettoyage en cas d'erreur
        if (isset($imagePath) ){
            Storage::delete($imagePath);
        }

        return back()->withInput()
            ->with('error', 'Erreur lors de la création: ' . $e->getMessage());
    }
}
public function update(Request $request, $id_formation)
{
    // Validation des données
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'contenu_video' => 'required|string',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'duree' => 'required|integer|min:1'
    ]);

    try {
        // Trouver la formation à mettre à jour
        $formation = Formation::findOrFail($id_formation);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($formation->image && Storage::exists(str_replace('storage/', 'public/', $formation->image))) {
                Storage::delete(str_replace('storage/', 'public/', $formation->image));
            }
            
            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('public/formations/images');
            $validated['image'] = str_replace('public/', 'storage/', $imagePath);
        } else {
            // Conserver l'image existante si aucune nouvelle image n'est uploadée
            $validated['image'] = $formation->image;
        }

        // Formater les dates correctement
        $validated['date_debut'] = Carbon::parse($validated['date_debut'])->format('Y-m-d H:i:s');
        $validated['date_fin'] = Carbon::parse($validated['date_fin'])->format('Y-m-d H:i:s');

        // Mettre à jour la formation
        $formation->update($validated);

        return redirect()->route('admin.formations.show', $formation->id_formation)
            ->with('success', 'Formation mise à jour avec succès!');

    } catch (\Exception $e) {
        // En cas d'erreur, supprimer l'image uploadée si elle existe
        if (isset($imagePath) && Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        return back()->withInput()
            ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
    }
}
    /**
     * Nettoie et valide le code d'embed vidéo
     */
    protected function sanitizeVideoEmbed($video)
    {
        // Permet seulement les iframes (pour les intégrations YouTube, Vimeo, etc.)
        $allowedTags = '<iframe>';
        $video = strip_tags($video, $allowedTags);

        // Ajout des attributs nécessaires pour les iframes
        if (Str::contains($video, '<iframe')) {
            $video = preg_replace('/<iframe/', '<iframe width="100%" height="315" frameborder="0" allowfullscreen', $video);
        }

        return $video;
    }
/**
 * Supprime une formation spécifique
 *
 * @param  int  $id_formation
 * @return \Illuminate\Http\Response
 */
public function destroy($id_formation)
{
    try {
        // Récupère la formation
        $formation = Formation::findOrFail($id_formation);
        
        // Supprime l'image associée si elle existe
        if ($formation->image && Storage::exists(str_replace('storage/', 'public/', $formation->image))) {
            Storage::delete(str_replace('storage/', 'public/', $formation->image));
        }
        
        // Supprime la formation
        $formation->delete();
        
        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation supprimée avec succès!');
            
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
    }
}
}