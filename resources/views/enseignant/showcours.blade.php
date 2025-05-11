<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant - Mes Cours</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    
    <!-- Meta pour le référencement et les réseaux sociaux -->
    <meta name="description" content="Gestion des cours pour enseignants">
    <meta property="og:title" content="Dashboard Enseignant">
    <meta property="og:description" content="Plateforme de gestion des cours pour enseignants">
</head>

<body>
<div class="dashboard-container">
    <!-- Sidebar amélioré -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{ asset('assets/img/logosvg.svg') }}" width="50" alt="Logo de l'établissement" loading="lazy">
                <div class="brand-icons">
                    <span class="las la-bell"></span>
                    <span class="las la-user-circle"></span>
                </div>
            </div>
        </div>
        
        <div class="sidebar-user">
            <img src="{{ Auth::guard('enseignant')->user()->image ? asset('assets/img/'.Auth::guard('enseignant')->user()->image) : asset('assets/img/user1.jpeg') }}" 
                 width="50" height="50" alt="Photo de profil" class="rounded-circle" loading="lazy">
            <div>
                <span>{{ Auth::guard('enseignant')->user()->prenom }} {{ Auth::guard('enseignant')->user()->nom }}</span>
                <small class="text-muted d-block">{{ Auth::guard('enseignant')->user()->email }}</small>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('enseignant.dashboard') }}">
                        <span class="las la-user"></span>
                        Mon Profil
                    </a>
                </li>
                <li class="active">
                    <a href="{{ route('enseignant.courses.index') }}">
                        <span class="las la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li>
                <a href="{{url('/enseignant/evaluations')}}">

                        <span class="las la-clipboard-list"></span>
                        Évaluations
                    </a>
                </li>
                @isset($evaluations)
    @foreach($evaluations as $eval)
        <li>
            <a href="{{ route('enseignant.notes.index', ['evaluation' => $eval->id_evaluation]) }}">
                <span class="la la-check-circle"></span>
                Résultats {{ $eval->titre }}
            </a>
        </li>
    @endforeach
@endisset
                <li>
                <a href="{{route('enseignant.reclamations.index')}}">
                        <span class="la la-chalkboard-teacher"></span>
                        Réclamations
                    </a>
                </li>
                <li>
                    <a href="{{ route('Enseignant.emails') }}">
                        <span class="las la-envelope"></span>
                        Boîte e-mails
                    </a>
                </li>
                <li>
    <form action="{{ route('enseignant.logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
            <span class="las la-sign-out-alt"></span>
            Déconnexion
        </button>
    </form>
</li>

            </ul>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        <header class="sticky-top bg-white shadow-sm">
            <div class="container-fluid py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="menu-toggle">
                        <button class="btn btn-outline-secondary">
                            <span class="las la-bars"></span>
                        </button>
                    </div>
                    <span class="me-3 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span> 
                </div>
            </div>
        </header>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Détails du Cours</h3>
                        <div class="btn-group">
                            <a href="{{ route('enseignant.courses.edit', $cours->id_cours) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ route('enseignant.courses.destroy', $cours->id_cours) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            @if($cours->image)

                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">Aucune image</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h2 class="text-primary">{{ $cours->titre }}</h2>
                            <p class="text-muted">
                                <i class="fas fa-calendar-alt"></i> 
                                Publié le: {{ $cours->date_publication ? $cours->date_publication->format('d/m/Y H:i') : 'Non publié' }}
                            </p>
                            <p class="text-muted">
                                <i class="fas fa-eye"></i> 
                                Statut: {{ $cours->est_public ? 'Public' : 'Privé' }}
                            </p>
                            <div class="mt-3">
                                <h5>Description:</h5>
                                <p class="text-justify">{{ $cours->description ?? 'Aucune description disponible' }}</p>
                            </div>
                        </div>
                    </div>

                    @if($cours->video_path)
                    <div class="border-top pt-3">
                        <h4 class="mb-3">Contenu vidéo</h4>
                        <div class="embed-responsive embed-responsive-16by9">
                            <video controls class="embed-responsive-item">
                                <source src="{{ asset('storage/' . $cours->video_path) }}" type="video/{{ $cours->format_video ?? 'mp4' }}">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        </div>
                        <p class="mt-2 text-muted">
                            Format: {{ $cours->format_video ?? 'Inconnu' }}
                        </p>
                    </div>
                    @endif

                    <div class="border-top mt-4 pt-3">
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">
                            Créé le: {{ $cours->created_at ? $cours->created_at->format('d/m/Y H:i') : 'Date non disponible' }}
                            </small>
                            <small class="text-muted">
                            <p>Dernière mise à jour : {{ $cours->updated_at?->format('d/m/Y H:i') ?? 'Non disponible' }}</p>

                            </small>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <a href="{{ route('enseignant.courses.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    .img-fluid {
        max-height: 250px;
        object-fit: cover;
        width: 100%;
    }
    .embed-responsive {
        border-radius: 8px;
        overflow: hidden;
        background-color: #f8f9fa;
    }
</style>
    </div>
</div>
</body>
</html>