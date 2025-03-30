<?php
namespace App\Http\Controllers\Etudiant;
use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class InscripController extends Controller
{
    public function register(Request $request)
    {
        // Validation des données de l'utilisateur
        $request->validate([
            'nom' => 'required|string|max:255',
            'prénom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:etudiant,email',
            'password' => 'required|string|min:8',
            'tel' => 'required|string|max:15',
            'role' => 'required|in:etudiant,professeur', // Assure que le rôle est bien sélectionné
        ]);

        // Création de l'utilisateur
        $etudiant = Etudiant::create([
            'nom' => $request->nom,
            'prénom' => $request->prénom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tel' => $request->tel,
            'role' => $request->role,
        ]);

        // Authentifier l'utilisateur après la création
        Auth::login($etudiant);
        session()->flash('success', 'Inscription réussie! Veuillez vous connecter.');


        


        // Si le rôle n'est pas défini, redirige vers la page par défaut (par exemple la page d'accueil)
        return redirect()->route('login');
    }
}
?>