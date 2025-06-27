@extends('front.layout.app')

@php
    $noNavbar = true;
    $noFooter = true;
@endphp

@section('content')
<style>
    .messagerie-container {
        display: flex;
        height: 100vh;
        font-family: 'Segoe UI', sans-serif;
    }
    .sidebar {
        width: 250px;
        background: linear-gradient(to right,  #3e1e68,  #b9c5fd);
        color: white;
        padding: 20px;
    }
    .sidebar h4 {
        margin-bottom: 30px;
    }
    .sidebar a {
        display: block;
        margin-bottom: 15px;
        color: white;
        text-decoration: none;
        padding: 10px;
        border-radius: 8px;
        transition: 0.3s;
    }
    .sidebar a.disabled {
        pointer-events: none;
        opacity: 0.6;
        background:  #b9c5fd;
    }
    .sidebar a:hover:not(.disabled) {
        background: #b9c5fd;
        ;
    }
    .main-content {
        flex: 1;
        padding: 20px;
        background-color: #f8f9fc;
        overflow-y: auto;
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
        box-shadow: 0 0 5px  #b9c5fd;
    }
    .message-card:hover {
        background: #f1f1f1;
    }
    .message-card .title {
        font-weight: bold;
    }
    .btn-primary {
        background:  #3e1e68;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }
</style>

<div class="messagerie-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>📧 Messagerie</h4>
        <a href="https://mail.google.com" target="_blank">📤 Ouvrir Gmail</a>
        <a href="{{ route('etudiant.messagerie.index') }}">📥 Boîte de réception</a>

        <!-- Liens désactivés -->
        <a href="{{ route('etudiant.messagerie.sent') }}" >📨 Envoyés</a>
        <a href="{{ route('etudiant.messagerie.starred') }}" >⭐ Importants</a>
        <a href="{{ route('etudiant.messagerie.trash') }}" >🗑️ Corbeille</a>

        <div style="margin-top: 30px; background: rgba(255,255,255,0.2); padding: 10px; border-radius: 8px;">
            Cliquez sur "Ouvrir Gmail" pour accéder à votre messagerie complète.
        </div>
    </div>

    <!-- Main content -->
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
@endsection
