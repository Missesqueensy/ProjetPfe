<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats - {{ $evaluation->titre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        .note-high { color: #28a745; }
        .note-low { color: #dc3545; }
        .table-responsive { overflow-x: auto; }
        .card-header { font-weight: 600; }
        .stat-card { border-left: 4px solid #007bff; }
        #notesChartContainer { height: 300px; }
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
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">Résultats : {{ $evaluation->titre }}</h2>
                    <p class="text-muted mb-0">
                        <strong>Cours:</strong> {{ $evaluation->cours->titre ?? 'Non spécifié' }} | 
                        <strong>Classe:</strong> {{ $evaluation->classe->nom ?? 'Non spécifié' }} | 
                        <strong>Note max:</strong> {{ $evaluation->note_maximale }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('enseignant.evaluations.index') }}" class="btn btn-outline-secondary">
                        <i class="las la-arrow-left"></i> Retour
                    </a>
                    <button class="btn btn-outline-primary" onclick="window.print()">
                        <i class="las la-print"></i> Imprimer
                    </button>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <!-- Tableau des notes -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="las la-clipboard-list"></i> Notes des étudiants</h4>
        </div>
        
        <div class="card-body">
            @if($notes->isEmpty())
                <div class="alert alert-info">Aucune note enregistrée pour cette évaluation</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <!-- En-têtes du tableau -->
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Étudiant</th>
                                <th>Matricule</th>
                                <th>Note</th>
                                <th>%</th>
                                <th>Statut</th>
                                <th>Commentaire</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $index => $note)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}</td>
                                <td>{{ $note->etudiant->matricule ?? 'N/A' }}</td>
                                <td class="@if($note->valeur >= ($evaluation->note_maximale * 0.5)) note-high @else note-low @endif">
                                    {{ $note->valeur ?? 'Non noté' }}
                                </td>
                                <td>
                                    @if($note->valeur && $evaluation->note_maximale > 0)
                                        {{ round(($note->valeur / $evaluation->note_maximale) * 100) }}%
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <span class="badge 
                                        @if($note->statut == 'publie') bg-success
                                        @elseif($note->statut == 'corrige') bg-warning text-dark
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $note->statut)) }}
                                    </span>
                                </td>
                                <td>{{ $note->commentaire ?? 'Aucun commentaire' }}</td>
                                <td>
                                    <a href="{{ route('enseignant.notes.edit', ['note' => $note->id_note]) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Modifier">
                                        <i class="las la-edit"></i>
                                    </a>
                                    <form action="{{ route('enseignant.notes.destroy', $note->id_note) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger confirm-delete" title="Supprimer">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Statistiques -->
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="las la-chart-bar"></i> Statistiques</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Moyenne
                                        <span class="badge bg-primary rounded-pill">
                                            {{ number_format($notes->avg('valeur'), 2) ?? 'N/A' }}
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Note maximale
                                        <span class="badge bg-success rounded-pill">
                                            {{ $notes->max('valeur') ?? 'N/A' }}
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Note minimale
                                        <span class="badge bg-danger rounded-pill">
                                            {{ $notes->min('valeur') ?? 'N/A' }}
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Taux de réussite
                                        <span class="badge bg-info rounded-pill">
                                            @php
                                                $successCount = 0;
                                                foreach($notes as $note) {
                                                    if($note->valeur >= ($evaluation->note_maximale * 0.5)) {
                                                        $successCount++;
                                                    }
                                                }
                                                echo round(($successCount / $notes->count()) * 100) . '%';
                                            @endphp
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Graphique -->
                    <div class="col-md-8 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="las la-chart-pie"></i> Répartition</h5>
                                <div id="notesChartContainer">
                                    <canvas id="notesChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart