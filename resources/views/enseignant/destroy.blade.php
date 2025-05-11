<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <title>Dashboard Enseignant - Mes Cours</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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
            <img src="{{ Auth::guard('enseignant')->user()->image ? asset('assets/img/user1.jpeg'.Auth::guard('enseignant')->user()->image) : asset('assets/img/user1.jpeg') }}" 
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
                        <span class="badge bg-primary float-end">{{ Auth::guard('enseignant')->user()->courses->count() }}</span>
                    </a>
                </li>
                <li>
                <a href="{{route('enseignant.evaluations.index')}}">

                        <span class="las la-clipboard-list"></span>
                        Évaluations
                    </a>
                </li>
                <li>
                <a href="{{ route('enseignant.notes.index') }}">
                        <span class="la la-check-circle"></span>
                     Résultats étudiants
                    </a>
                </li>
                <li>
                <a href="{{route('enseignant.reclamations.index')}}">
                        <span class="la la-chalkboard-teacher"></span>
                        Réclamations
                       </a>
                </li>
                <li>
                    <a href="{{route('Enseignant.emails')}}">
                    <span class="las la-envelope"></span>
                      boîte e-mails
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
<div class="main-content">
        <header>
            <h1>Enseignant dashboard</h1>
        </header>

        <div class="container">
            <h1>Tous Mes Cours</h1>
            <ul>
                @foreach($courses as $cours)
                    <li>
                        <strong>{{ $cours->titre }}</strong><br>
                        <small>{{ $cours->description }}</small><br>
                        <a href="{{ route('enseignant.courses.show', $cours->id_cours) }}">Voir</a>

                        <!-- Formulaire de suppression -->
                        <form action="{{ route('enseignant.courses.destroy', $cours->id_cours) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')" class="btn btn-danger">Supprimer</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</body>
</html>