<?php

namespace App\Http\Controllers;
use App\Models\Etudiant;
use App\Models\Conversation;
use App\Model\Participant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        $etudiant = Auth::guard('etudiant')->user();
        
        // Récupérer les conversations où l'étudiant est participant
        $conversations = Conversation::whereHas('participants', function($query) use ($etudiant) {
            $query->where('id_etudiant', $etudiant->id_etudiant);
        })
        ->with(['messages' => function($query) {
            $query->latest()->limit(1);
        }])
        ->get();

        return view('etudiant.messagerie-index', compact('conversations'));
    }

    public function create()
    {
        $etudiants = Etudiant::where('id_etudiant', '!=', Auth::guard('etudiant')->user()->id_etudiant)->get();
        return view('etudiant.messagerie-create', compact('etudiants'));
    }

    /*public function store(Request $request)
    {
        $request->validate([
            'participants' => 'required|array|min:1',
            'message' => 'required|string',
        ]);

        $conversation = Conversation::create();

        // Ajouter l'expéditeur
        $conversation->participants()->create([
            'id_etudiant' => Auth::guard('etudiant')->user()->id_etudiant
        ]);

        // Ajouter les destinataires
        foreach ($request->participants as $etudiantId) {
            $conversation->participants()->create([
                'id_etudiant' => $etudiantId
            ]);
        }

        // Créer le premier message
        $conversation->messages()->create([
            'id_etudiant' => Auth::guard('etudiant')->user()->id_etudiant,
            'content' => $request->message
        ]);

        return redirect()->route('etudiant.messagerie.show', $conversation);
    }*/
    public function store(Request $request)
{
    $validated = $request->validate([
        'participants' => 'required|array|min:1',
        'message' => 'required|string|min:1', // Ajout de min:1 pour s'assurer que ce n'est pas vide
    ]);

    // Debug si nécessaire
    // logger($validated);

    $conversation = Conversation::create();

    // Ajout des participants
    $participants = array_merge(
        [Auth::guard('etudiant')->user()->id_etudiant],
        $validated['participants']
    );

    foreach ($participants as $id) {
        $conversation->participants()->create(['id_etudiant' => $id]);
    }

    // Création du message
    $message = $conversation->messages()->create([
        //'id_etudiant' => Auth::id(),
            'id_etudiant' => Auth::guard('etudiant')->user()->id_etudiant,

        'content' => $validated['message']
    ]);

    if (!$message) {
        logger()->error('Échec de la création du message', $validated);
        return back()->with('error', 'Impossible d\'envoyer le message');
    }

    return redirect()->route('etudiant.messagerie.show', $conversation);
}

    public function show(Conversation $conversation)
    {
        // Vérifier que l'étudiant fait partie de la conversation
        $isParticipant = $conversation->participants()
            ->where('id_etudiant', Auth::guard('etudiant')->user()->id_etudiant)
            ->exists();

        if (!$isParticipant) {
            abort(403);
        }

        $messages = $conversation->messages()
            ->with('etudiant')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('etudiant.message-show', compact('conversation', 'messages'));
    }

    public function sendMessage(Request $request, Conversation $conversation)
    {
        // Vérifier que l'étudiant fait partie de la conversation
        $isParticipant = $conversation->participants()
            ->where('id_etudiant', Auth::guard('etudiant')->user()->id_etudiant)
            ->exists();

        if (!$isParticipant) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        $conversation->messages()->create([
            'id_etudiant' => Auth::guard('etudiant')->user()->id_etudiant,
            'content' => $request->message
        ]);

        return back();
    }
}
