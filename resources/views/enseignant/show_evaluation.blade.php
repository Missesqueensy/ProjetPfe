<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'évaluation - {{ $evaluation->titre }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <style>
        .evaluation-header {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
        }
        .file-preview {

            max-height: 200px;
            overflow: hidden;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }
        .badge-pill {
            padding: 0.35em 0.65em;
        }
        .action-btns .btn {
            min-width: 100px;
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
                                <li><a class="dropdown-item text-danger" href="{{ route('enseignant.logout') }}">Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-fluid py-4">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.evaluations.index') }}">Évaluations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($evaluation->titre, 30) }}</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="fas fa-clipboard-list text-primary me-2"></i>
                    Détails de l'évaluation
                </h1>
                <div class="d-flex">
                    <a href="{{ route('enseignant.evaluations.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> Retour
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="actionsDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-cog me-1"></i> Actions
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionsDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('enseignant.evaluations.edit', $evaluation->id_evaluation) }}">
                                    <i class="fas fa-edit text-warning me-2"></i> Modifier
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('enseignant.evaluations.destroy', $evaluation->id_evaluation) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette évaluation ?')">
                                        <i class="fas fa-trash me-2"></i> Supprimer
                                    </button>
                                </form>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-print me-2"></i> Imprimer
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow">
                <div class="card-header evaluation-header text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $evaluation->titre }}</h5>
                        <span class="badge bg-light text-dark fs-6">
                            <i class="fas fa-calendar-day me-1"></i>
                            @if($evaluation->date_evaluation)
                                {{ \Carbon\Carbon::parse($evaluation->date_evaluation)->format('d/m/Y') }}
                            @else
                                Date non définie
                            @endif
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-3">
                                        <i class="fas fa-info-circle me-2"></i>Informations de base
                                    </h6>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-book me-2 text-primary"></i> Cours</span>
                                            <span class="fw-bold">{{ $evaluation->cours->titre ?? 'Non spécifié' }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-users me-2 text-primary"></i> Classe</span>
                                            <span class="fw-bold">
                                                @if($evaluation->classe)
                                                    {{ $evaluation->classe->nom }} {{ $evaluation->classe->filiere }}
                                                    @else
                                                    Non spécifié
                                                @endif
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-tag me-2 text-primary"></i> Type</span>
                                            <span class="badge bg-primary rounded-pill">{{ ucfirst($evaluation->type) }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-calendar-alt me-2 text-primary"></i> Date de publication</span>
                                            <span class="fw-bold">
                                                @if($evaluation->date_publication)
                                                    {{ \Carbon\Carbon::parse($evaluation->date_publication)->format('d/m/Y H:i') }}
                                                @else
                                                    Non spécifiée
                                                @endif
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-3">
                                        <i class="fas fa-chart-line me-2"></i>Statistiques
                                    </h6>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-percentage me-2 text-primary"></i> Coefficient</span>
                                            <span class="badge bg-info rounded-pill">{{ $evaluation->coefficient }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-check-circle me-2 text-primary"></i> Statut</span>
                                            @php
                                                $statusColors = [
                                                    'brouillon' => 'secondary',
                                                    'programme' => 'info',
                                                    'en_cours' => 'warning',
                                                    'corrige' => 'success',
                                                    'archive' => 'dark'
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$evaluation->statut] ?? 'secondary' }} rounded-pill">
                                                {{ ucfirst($evaluation->statut) }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-user-graduate me-2 text-primary"></i> Étudiants</span>
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $evaluation->notes_count }} / 
                                                {{ $evaluation->classe?->etudiants_count ?? $evaluation->classe?->etudiants->count() ?? 0 }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-align-left text-primary me-2"></i>Description
                                    </h5>
                                    <div class="p-3 bg-light rounded">
                                        @if($evaluation->description)
                                            {!! $evaluation->description !!}
                                        @else
                                            <p class="text-muted fst-italic">Aucune description fournie</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-paperclip text-primary me-2"></i>Fichiers associés
                                    </h5>
                                    @if($evaluation->fichier_consigne || $evaluation->fichier_correction)
                                        <div class="d-grid gap-2">
                                            @if($evaluation->fichier_consigne)
                                            
                                           
                                            @php
    $fichier = basename($evaluation->fichier_consigne); // enlève le chemin
@endphp

<a href="{{ route('telecharger-consigne', urlencode($fichier)) }}" class="btn btn-primary">
    Télécharger la consigne
</a>
              

                                            @endif
                                            @if($evaluation->fichier_correction)
                                                <a href="{{ asset('storage/'.$evaluation->fichier_correction) }}" 
                                                   target="_blank" class="btn btn-outline-success text-start">
                                                    <i class="fas fa-check-circle me-2"></i> Correction
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-muted fst-italic">Aucun fichier joint</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-user-graduate text-primary me-2"></i>
                                    Notes des étudiants
                                </h5>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-download me-1"></i> Exporter
                                    </button>
                                    <a href="{{ route('enseignant.notes.create', $evaluation->id_evaluation) }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Ajouter des notes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Note</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($evaluation->notes as $index => $note)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $note->etudiant->nom }}</td>
                                                <td>{{ $note->etudiant->prenom }}</td>
                                                <td>
                                                    @if($note->valeur)
                                                        <span class="badge bg-primary rounded-pill">{{ $note->valeur }}/{{ $evaluation->bareme_total }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $note->valeur ? 'success' : 'warning' }} rounded-pill">
                                                        {{ $note->valeur ? 'Noté' : 'En attente' }}
                                                    </span>
                                                </td>
                                                <td class="action-btns">
                                                    <button class="btn btn-sm btn-outline-primary" title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                                                    <p class="text-muted">Aucune note enregistrée pour cette évaluation</p>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNotesModal">
                                                        <i class="fas fa-plus me-1"></i> Ajouter des notes
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex justify-content-between">
                    <small class="text-muted">
                        Créé le {{ $evaluation->created_at->format('d/m/Y à H:i') }}
                        @if($evaluation->created_at != $evaluation->updated_at)
                            <br>Modifié le {{ $evaluation->updated_at->format('d/m/Y à H:i') }}
                        @endif
                    </small>
                    <div class="d-flex">
                        <button class="btn btn-sm btn-outline-secondary me-2">
                            <i class="fas fa-history me-1"></i> Historique
                        </button>
                        <button class="btn btn-sm btn-success">
                            <i class="fas fa-paper-plane me-1"></i> Publier les notes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNotesModal" tabindex="-1" aria-labelledby="addNotesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addNotesModalLabel">Ajouter des notes - {{ $evaluation->titre }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                @include('enseignant.add_notes', ['evaluation' => $evaluation])
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/enseignantdash.js') }}"></script>
<script>
    // Activer les tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Toggle sidebar
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('expanded');
        });
    });
</script>
</body>
</html>