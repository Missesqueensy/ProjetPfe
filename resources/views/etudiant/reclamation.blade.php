@extends('front.layout.app')

@php
    $noNavbar = true;
    $noFooter = true;
@endphp

@section('content')
<style>
    .sidebar {
        background: #b9c5fd;
        min-height: 100vh;
        color: white;
        padding: 2rem 1rem;
        transition: transform 0.3s ease;
    }

    .sidebar a {
        color: white;
        display: block;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        text-decoration: none;
    }

    .sidebar a:hover {
        background: #3e1e68;
    }

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
        <!-- Sidebar -->
        <div class="col-md-3 sidebar @if(request()->routeIs('dashboard')) fixed-sidebar @endif">
            <h4>Menu</h4>
            <a href="{{ route('etudiant.dashboardetd') }}">🏠 Accueil</a>
            <a href="{{route('etudiant.cours')}}">📚 Mes cours</a>
            <a href="{{ route('etudiant.notes') }}">📝 Mes notes</a>
            <a href="{{ route('etudiant.reclamation') }}">📨 Réclamations</a>
            <a href="{{ route('etudiant.messagerie.index') }}">💬 Messagerie</a>
            <a href="{{ route('etudiant.parametres') }}">⚙️ Paramètres</a>

            <form action="{{ route('etudiant.logout') }}" method="POST">
                @csrf
                <button class="btn-logout">Déconnexion</button>
            </form>
        </div>

        <!-- Contenu principal -->
        <div class="col-md-9 py-5">
            <div class="container">
                <h2 class="mb-4">📨Mes réclamations</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- Formulaire de réclamation --}}
                <form action="{{ route('etudiant.reclamation.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <label for="sujet_Reclamer" class="form-label">Sujet</label>
                        <input type="text" name="sujet_Reclamer" id="sujet_Reclamer" class="form-control" value="{{ old('sujet_Reclamer') }}" required>
                        @error('sujet_Reclamer') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contenu_Reclamer" class="form-label">Contenu</label>
                        <textarea name="contenu_Reclamer" id="contenu_Reclamer" rows="4" class="form-control" required>{{ old('contenu_Reclamer') }}</textarea>
                        @error('contenu_Reclamer') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>

                {{-- Liste des réclamations --}}
                @forelse($reclamations as $reclamation)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <strong>{{ $reclamation->sujet_Reclamer }}</strong>
                            <small>{{ $reclamation->date_pub_Reclamer }}</small>
                        </div>
                        <div class="card-body">
                            {{ $reclamation->contenu_Reclamer }}
                        </div>
                    </div>
                @empty
                    <p>Aucune réclamation trouvée.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
