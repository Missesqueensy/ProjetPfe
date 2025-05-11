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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-user-graduate"></i> {{ $title }}
                    </h3>
                </div>
                
                <div class="card-body">
                    <!-- Section Informations étudiant -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4><i class="fas fa-info-circle"></i> Informations étudiant</h4>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Nom complet:</strong> {{ $etudiant->nom_complet }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Classe:</strong> {{ $etudiant->classe->nom ?? 'Non spécifié' }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Moyenne générale:</strong> 
                                    <span class="badge badge-{{ $moyenne_generale >= 10 ? 'success' : 'danger' }}">
                                        {{ number_format($moyenne_generale, 2) }}/20
                                    </span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-md-6">
                            <h4><i class="fas fa-chart-pie"></i> Statistiques par cours</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Cours</th>
                                            <th>Moyenne</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($moyennes_par_cours as $id_cours => $moyenne)
                                            <tr>
                                                <td>{{ $etudiant->notes->firstWhere('evaluation.id_cours', $id_cours)->evaluation->cours->nom ?? 'Cours inconnu' }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $moyenne >= 10 ? 'success' : 'warning' }}">
                                                        {{ number_format($moyenne, 2) }}/20
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center">Aucune note disponible</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Section Détail des notes -->
                    <div class="row">
                        <div class="col-md-12">
                            <h4><i class="fas fa-list-alt"></i> Détail des évaluations</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Date</th>
                                            <th>Cours</th>
                                            <th>Évaluation</th>
                                            <th>Note</th>
                                            <th>Commentaire</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($etudiant->notes->sortByDesc('evaluation.date_evaluation') as $note)
                                            <tr>
                                                <td>{{ $note->evaluation->date_evaluation->format('d/m/Y') }}</td>
                                                <td>{{ $note->evaluation->cours->nom }}</td>
                                                <td>{{ $note->evaluation->nom }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $note->valeur >= 10 ? 'success' : 'danger' }}">
                                                        {{ $note->valeur }}/20
                                                    </span>
                                                </td>
                                                <td>{{ $note->commentaire ?? 'Aucun commentaire' }}</td>
                                                <td>
                                                    @switch($note->statut)
                                                        @case('publie')
                                                            <span class="badge badge-success">Publié</span>
                                                            @break
                                                        @case('corrige')
                                                            <span class="badge badge-info">Corrigé</span>
                                                            @break
                                                        @default
                                                            <span class="badge badge-secondary">En attente</span>
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Aucune note enregistrée</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer text-right">
                    <a href="{{ route('notes.export', $etudiant->id) }}" class="btn btn-info">
                        <i class="fas fa-file-export"></i> Exporter en PDF
                    </a>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    .card-header {
        border-radius: 0.25rem 0.25rem 0 0 !important;
    }
    .table th {
        white-space: nowrap;
    }
    .badge {
        font-size: 0.9em;
        padding: 0.4em 0.6em;
    }
</style>
@endsection