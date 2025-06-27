<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Gestion des Réclamations</title>
    <style>
        .reclamation-card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            border-left: 4px solid transparent;
        }
        .reclamation-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .reclamation-card.etud-vers-prof {
            border-left-color: #1cc88a;
        }
        .reclamation-card.prof-vers-etud {
            border-left-color: #f6c23e;
        }
        .reclamation-card.etud-vers-etud {
            border-left-color: #c433ff;
        }
        .status-badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
        .user-badge {
            background-color: #f8f9fa;
            border-radius: 50px;
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .user-badge i {
            margin-right: 0.5rem;
        }
        .content-preview {
            color: #6c757d;
            display: -webkit-box;
            /*-webkit-line-clamp: 2;*
            -webkit-box-orient: vertical;*/
            overflow: hidden;
        }
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
        }
    </style>
</head>
<body> 
<div class="dashboard-container">
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
            <img src="{{ Auth::guard('enseignant')->user()->image ? asset('storage/'.Auth::guard('enseignant')->user()->image) : asset('assets/img/user.jpeg') }}" 
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
                <li>
                <a href="{{route('enseignant.evaluations.index')}}">
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
                <li class="active">
                    <a href="{{ route('enseignant.reclamations.index') }}">
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
                    <a href="{{ route('enseignant.logout') }}">
                        <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
                            <span class="las la-sign-out-alt"></span>
                            Déconnexion
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header class="sticky-top bg-white shadow-sm">
            <div class="container-fluid py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="menu-toggle">
                        <button class="btn btn-outline-secondary sidebar-toggle">
                            <i class="las la-bars"></i>
                        </button>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="me-3 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="las la-user-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('enseignant.dashboard') }}">Mon profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="{{ route('enseignant.logout') }}">Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-fluid py-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Gestion des Réclamations</h1>
                <div>
                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter me-1"></i> Filtrer
                    </a>
                </div>
            </div>

            <!-- Filter Modal --
            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="GET" action="{{ route('enseignant.reclamations.index') }}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterModalLabel">Filtrer les réclamations</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Statut</label>
                                    <select name="statut" class="form-select">
                                        <option value="">Tous les statuts</option>
                                        <option value="en_attente" {{ request('statut') === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                        <option value="traité" {{ request('statut') === 'traité' ? 'selected' : '' }}>Traité</option>
                                        <option value="rejeté" {{ request('statut') === 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select name="type" class="form-select">
                                        <option value="">Tous les types</option>
                                        <option value="etud_vers_prof" {{ request('type') === 'etud_vers_prof' ? 'selected' : '' }}>Étudiant vers Professeur</option>
                                        <option value="prof_vers_etud" {{ request('type') === 'prof_vers_etud' ? 'selected' : '' }}>Professeur vers Étudiant</option>
                                        <option value="etud_vers_etud" {{ request('type') === 'etud_vers_etud' ? 'selected' : '' }}>Étudiant vers Étudiant</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Appliquer les filtres</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des réclamations reçues</h6>
                            <div>
                                <span class="badge bg-primary">
                                    Total: {{ $reclamations->total() }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($reclamations->isEmpty())
                                <div class="empty-state">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <h4>Aucune réclamation trouvée</h4>
                                    <p class="text-muted">Vous n'avez aucune réclamation pour le moment</p>
                                </div>
                            @else
                                @foreach($reclamations as $reclamation)
                                <div class="card reclamation-card mb-3 {{ str_replace('_', '-', $reclamation->type) }}">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <span class="badge status-badge bg-{{ 
                                                    $reclamation->statut === 'en_attente' ? 'warning' : 
                                                    ($reclamation->statut === 'rejeté' ? 'danger' : 'success') 
                                                }}">
                                                    {{ ucfirst(str_replace('_', ' ', $reclamation->statut)) }}
                                                </span>
                                                <small class="text-muted d-block mt-1">
                                                    {{ $reclamation->created_at->isoFormat('LL HH:mm') }}
                                                </small>
                                                <small class="d-block mt-1">
                                                    Type: <strong>{{ str_replace('_', ' ', $reclamation->type) }}</strong>
                                                </small>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="user-badge">
                                                    <i class="fas fa-{{ $reclamation->expediteur_type === 'App\Models\Etudiant' ? 'user-graduate' : 'chalkboard-teacher' }}"></i>
                                                    <span>
                                                        {{ optional($reclamation->expediteur)->prenom }} {{ optional($reclamation->expediteur)->nom ?? 'Expéditeur inconnu' }}
                                                        <small class="text-muted d-block">
                                                            {{ class_basename($reclamation->expediteur_type) }}
                                                        </small>
                                                    </span>
                                                </div>
                                                <div class="user-badge">
                                                    <i class="fas fa-arrow-right text-muted me-2"></i>
                                                    <i class="fas fa-chalkboard-teacher"></i>
                                                    <span>
                                                        @if($reclamation->destinataire)
                                                            {{ $reclamation->destinataire->prenom }} {{ $reclamation->destinataire->nom }}
                                                            <small class="text-muted d-block">
                                                                {{ class_basename($reclamation->destinataire_type) }}
                                                            </small>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="content-preview mb-0">
                                                    {{ Str::limit($reclamation->contenu, 120) }}
                                                </p>
                                                @if($reclamation->reponse)
                                                    <div class="mt-2">
                                                        <small class="text-success">
                                                            <i class="fas fa-reply me-1"></i> Réponse envoyée
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <a href="{{ route('enseignant.reclamations.show', $reclamation) }}" 
                                                   class="btn btn-sm btn-outline-primary"
                                                   title="Voir les détails">
                                                    <i class="fas fa-eye me-1"></i> Détails
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="card-footer">
                            {{ $reclamations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Activer les tooltips Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        // Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Toggle sidebar
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.dashboard-container').classList.toggle('sidebar-collapsed');
        });
    });
</script>
</body>
</html>-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Gestion des Réclamations</title>
    <style>
        .reclamation-card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            border-left: 4px solid transparent;
        }
        .reclamation-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .reclamation-card.etud-vers-prof {
            border-left-color: #1cc88a;
        }
        .reclamation-card.prof-vers-etud {
            border-left-color: #f6c23e;
        }
        .reclamation-card.etud-vers-etud {
            border-left-color: #c433ff;
        }
        .status-badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
        .user-badge {
            background-color: #f8f9fa;
            border-radius: 50px;
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .user-badge i {
            margin-right: 0.5rem;
        }
        .content-preview {
            color: #6c757d;
            display: -webkit-box;
            overflow: hidden;
        }
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
        }
         body {
        overflow-x: hidden; /* Empêche le défilement horizontal */
    }
    
    .dashboard-container {
        min-width: 100vw; /* Prend toute la largeur de l'écran */
    }
    
    .main-content {
        margin-left: 300px; /* Ajustez selon la largeur de votre sidebar */
        width: calc(100% - 250px); /* Largeur totale moins sidebar */
    }
    
    .card.shadow {
        border-radius: 0.5rem;
        border: none;
    }
    
    /* Pour les petits écrans */
    @media (max-width: 990px) {
        .main-content {
            margin-left: 0;
            width: 100%;
        }
    }
    </style>
</head>
<body> 
<div class="dashboard-container">
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
                    <a href="{{route('enseignant.evaluations.index')}}">
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
    <div class="main-content">
        <header class="sticky-top bg-white shadow-sm">
            <div class="container-fluid py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="menu-toggle">
                        <button class="btn btn-outline-secondary sidebar-toggle">
                            <i class="las la-bars"></i>
                        </button>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="me-3 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="las la-user-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('enseignant.dashboard') }}">Mon profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="{{ route('enseignant.logout.simple') }}">Déconnexion</a></li>
                                <li>
   
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-fluid py-4 px-0">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Gestion des Réclamations</h1>
                <div>
                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter me-1"></i> Filtrer
                    </a>
                </div>
            </div>

            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="GET" action="{{ route('enseignant.reclamations.index') }}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterModalLabel">Filtrer les réclamations</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Statut</label>
                                    <select name="statut" class="form-select">
                                        <option value="">Tous les statuts</option>
                                        @foreach(['en_attente' => 'En attente', 'traité' => 'Traité', 'rejeté' => 'Rejeté'] as $value => $label)
                                            <option value="{{ $value }}" {{ request('statut') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select name="type" class="form-select">
                                        <option value="">Tous les types</option>
                                        @foreach(['etud_vers_prof' => 'Étudiant vers Professeur', 'prof_vers_etud' => 'Professeur vers Étudiant', 'etud_vers_etud' => 'Étudiant vers Étudiant'] as $value => $label)
                                            <option value="{{ $value }}" {{ request('type') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Appliquer les filtres</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
        <a href="{{ route('enseignant.reclamations.create') }}" class="btn btn-sm btn-success me-2">
            <i class="fas fa-plus me-1"></i> Nouvelle Réclamation
        </a>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des réclamations reçues</h6>
                            <div>
                                <span class="badge bg-primary">
                                    Total: {{ $reclamations->total() }}
                                </span>
                            </div>
                        </div>
                        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                        <div class="card-body">
                            @if($reclamations->isEmpty())
                                <div class="empty-state">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <h4>Aucune réclamation trouvée</h4>
                                    <p class="text-muted">Vous n'avez aucune réclamation pour le moment</p>
                                </div>
                            @else
                                @foreach($reclamations as $reclamation)
                                <div class="card reclamation-card mb-3 {{ str_replace('_', '-', $reclamation->type) }}">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <span class="badge status-badge bg-{{ 
                                                    $reclamation->statut === 'en_attente' ? 'warning' : 
                                                    ($reclamation->statut === 'rejeté' ? 'danger' : 'success') 
                                                }}">
                                                    {{ ucfirst($reclamation->statut) }}
                                                </span>
                                                <small class="text-muted d-block mt-1">
                                                    {{ $reclamation->created_at->isoFormat('LL HH:mm') }}
                                                </small>
                                                <small class="d-block mt-1">
                                                    Type: <strong>{{ $reclamation->typeToString() }}</strong>
                                                </small>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="user-badge">
                                                    <i class="fas fa-{{ $reclamation->expediteur_type === 'App\Models\Etudiant' ? 'user-graduate' : 'chalkboard-teacher' }}"></i>
                                                    <span>
                                                        {{ optional($reclamation->expediteur)->prenom }} {{ optional($reclamation->expediteur)->nom ?? 'Expéditeur inconnu' }}
                                                        <small class="text-muted d-block">
                                                            {{ class_basename($reclamation->expediteur_type) }}
                                                        </small>
                                                    </span>
                                                </div>
                                                <div class="user-badge">
                                                    <i class="fas fa-arrow-right text-muted me-2"></i>
                                                    <i class="fas fa-{{ $reclamation->destinataire_type === 'App\Models\Etudiant' ? 'user-graduate' : 'chalkboard-teacher' }}"></i>
                                                    <span>
                                                        @if($reclamation->destinataire_type && $reclamation->destinataire)
                                                            {{ $reclamation->destinataire->prenom }} {{ $reclamation->destinataire->nom }}
                                                            <small class="text-muted d-block">
                                                                {{ class_basename($reclamation->destinataire_type) }}
                                                            </small>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="content-preview mb-0">
                                                    {{ Str::limit($reclamation->contenu, 120) }}
                                                </p>
                                                @if($reclamation->reponse)
                                                    <div class="mt-2">
                                                        <small class="text-success">
                                                            <i class="fas fa-reply me-1"></i> Réponse envoyée le {{ $reclamation->date_reponse->isoFormat('LL') }}
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <a href="{{ route('enseignant.reclamations.show', $reclamation) }}" 
                                                   class="btn btn-sm btn-outline-primary"
                                                   title="Voir les détails">
                                                    <i class="fas fa-eye me-1"></i> Détails
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="card-footer">
                            {{ $reclamations->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Activation des tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Toggle sidebar
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.dashboard-container').classList.toggle('sidebar-collapsed');
        });
    });
</script>
</body>
</html>
