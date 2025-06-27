@extends('front.layout.app')

@php
    $noNavbar = true;
    $noFooter = true;
@endphp

@section('content')
<style>
    body {
        background: #f4f6f9;
    }
    
    /* Style pour le premier sidebar (menu principal) */
    .main-sidebar {
        background: #b9c5fd;
        min-height: 100vh;
        color: white;
        padding: 2rem 1rem;
        position: fixed;
        width: 250px;
    }
    
    .main-sidebar a {
        color: white;
        display: block;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        text-decoration: none;
    }
    
    .main-sidebar a:hover {
        background: #3e1e68;
    }
    
    /* Style pour le deuxième sidebar (messagerie) */
    .messagerie-sidebar {
        width: 250px;
        background: linear-gradient(to right, #4e73df, #1cc88a);
        color: white;
        padding: 20px;
        position: fixed;
        left: 250px;
        height: 100vh;
    }
    
    .messagerie-sidebar h4 {
        margin-bottom: 30px;
    }
    
    .messagerie-sidebar a {
        display: block;
        margin-bottom: 15px;
        color: white;
        text-decoration: none;
        padding: 10px;
        border-radius: 8px;
        transition: 0.3s;
    }
    
    .messagerie-sidebar a.disabled {
        pointer-events: none;
        opacity: 0.6;
        background: rgba(255,255,255,0.1);
    }
    
    .messagerie-sidebar a:hover:not(.disabled) {
        background: rgba(255, 255, 255, 0.2);
    }
    
    /* Contenu principal */
    .main-content {
        margin-left: 500px; /* 250px + 250px pour les deux sidebars */
        padding: 20px;
        background-color: #f8f9fc;
    }
    
    .header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        align-items: center;
    }
    
    .message-card {
        background: white;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }
    
    .message-card:hover {
        background: #f1f1f1;
    }
    
    .message-card .title {
        font-weight: bold;
    }
    
    .btn-primary {
        background: #1cc88a;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }
    
    /* Style pour le bouton de déconnexion */
    .btn-logout {
        background-color: #ff4d4d;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        width: 100%;
        margin-top: 20px;
        cursor: pointer;
    }
    
    .btn-logout:hover {
        background-color: #e60000;
    }
    
</style>

<div class="container-fluid">
    <div class="row">
        <!-- Premier sidebar (menu principal) -->
        <div class="main-sidebar">
            <h4>Menu</h4>
            <a href="{{ route('etudiant.dashboardetd') }}">🏠 Accueil</a>
            <a href="{{route('etudiant.cours')}}">📚 Mes cours</a>
            <a href="{{ route('etudiant.notes') }}">📝 Notes</a>
            <a href="{{ route('etudiant.reclamations') }}">📨 Réclamations</a>
            <a href="{{ route('etudiant.messagerie.index') }}">💬 Messagerie</a>
            <a href="{{ route('etudiant.parametres') }}">⚙️ Paramètres</a>

            <form action="{{ route('etudiant.logout') }}" method="POST">
                @csrf
                <button class="btn-logout">Déconnexion</button>
            </form>
        </div>

        <!-- Deuxième sidebar (messagerie) -->
        <div class="messagerie-sidebar">
            <h4>📧 Messagerie</h4>
            <a href="https://mail.google.com" target="_blank">📤 Ouvrir Gmail</a>
            <a href="{{ route('etudiant.messagerie.index') }}">📥 Boîte de réception</a>
            <a href="{{ route('etudiant.messagerie.sent') }}" class="disabled">📨 Envoyés</a>
            <a href="{{ route('etudiant.messagerie.starred') }}" class="disabled">⭐ Importants</a>
            <a href="{{ route('etudiant.messagerie.trash') }}" class="disabled">🗑️ Corbeille</a>
            
            <div style="margin-top: 30px; background: rgba(255,255,255,0.2); padding: 10px; border-radius: 8px;">
                Cliquez sur "Ouvrir Gmail" pour accéder à votre messagerie complète.
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="main-content">
            <div class="header">
                <h2>Boîte de réception</h2>
                <button type="button" class="btn-primary" onclick="document.getElementById('formulaire').style.display='block'">Nouveau message</button>
            </div>

            <!-- Formulaire caché -->
            <div id="formulaire" style="display: none; background: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
                <form action="{{ route('etudiant.messagerie.send') }}" method="POST">
                    @csrf
                    <div>
                        <label for="receiver_email">Destinataire :</label><br>
                        <input type="email" name="receiver_email" placeholder="Entrez l'email du destinataire" required>
                    </div>

                    <input type="hidden" name="receiver_type" value="{{ auth()->user()->type === 'etudiant' ? 'enseignant' : 'etudiant' }}">

                    <div style="margin-top: 10px;">
                        <label for="message_Chatter">Message :</label><br>
                        <textarea name="message_Chatter" rows="4" cols="50" required></textarea>
                    </div>

                    <div style="margin-top: 10px;">
                        <button type="submit" class="btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>

            <!-- Liste des messages -->
            @forelse ($messages as $message)
                <div class="message-card">
                    <div class="d-flex justify-content-between">
                        <span class="title">{{ $message->sender->nom ?? 'Inconnu' }}</span>
                        <small>{{ \Carbon\Carbon::parse($message->date_Chatter)->diffForHumans() }}</small>
                    </div>
                    <div>{{ $message->message_Chatter }}</div>
                </div>
            @empty
                <div class="alert alert-info">Aucun message reçu pour le moment.</div>
            @endforelse
        </div>
    </div>
</div>

<script>
    // Script pour afficher/masquer le formulaire
    function toggleForm() {
        const form = document.getElementById('formulaire');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endsection