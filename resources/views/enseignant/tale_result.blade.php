<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant - Mes Évaluations</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <!-- Meta pour le référencement et les réseaux sociaux -->
    <meta name="description" content="Gestion des évaluations pour enseignants">
    <meta property="og:title" content="Dashboard Enseignant - Évaluations">
    <meta property="og:description" content="Plateforme de gestion des évaluations pour enseignants">
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
                <li>
                    <a href="{{ route('enseignant.courses.index') }}">
                        <span class="las la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li class="active">
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
                    <a href="{{route ('Enseignant.emails') }}">
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
<div class="card">
    <div class="card-header">
        <h4>Résultats des étudiants</h4>
    </div>
    <div class="card-body">
        @if($results->isEmpty())
            <p>Aucun résultat disponible.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Note</th>
                            <th>Appréciation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $result)
                            <tr>
                                <td>{{ $result->etudiant->nom_complet }}</td>
                                <td>{{ $result->note ?? 'Non noté' }}/{{ $evaluation->note_max }}</td>
                                <td>{{ $result->appreciation ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('enseignant.results.edit', $result->id) }}" class="btn btn-sm btn-warning">
                                        Modifier
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Statistiques -->
            <div class="mt-4">
                <h5>Statistiques</h5>
                <p>Moyenne : {{ $stats['moyenne'] ?? '-' }}/{{ $evaluation->note_max }}</p>
                <p>Note maximale : {{ $stats['max'] ?? '-' }}</p>
                <p>Note minimale : {{ $stats['min'] ?? '-' }}</p>
            </div>
        @endif
    </div>
</div>
    </div>
</div>
</body>
</html>