<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant - Mes Évaluations</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <meta name="description" content="Gestion des évaluations pour enseignants">
    <meta property="og:title" content="Dashboard Enseignant - Évaluations">
    <meta property="og:description" content="Plateforme de gestion des évaluations pour enseignants">
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
                @isset($evaluations)
    @foreach($evaluations as $evaluation)
        <li>
            <a href="{{ route('enseignant.notes.index', ['evaluation' => $evaluation->id_evaluation]) }}">
                <span class="la la-check-circle"></span>
                Résultats étudiants {{ $evaluation->titre }}
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
                        <button class="btn btn-outline-secondary">
                            <span class="las la-bars"></span>
                        </button>
                    </div>
                    <span class="me-3 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span> 
                </div>
            </div>
        </header>
        
        <div class="container-fluid">
            <h1 class="h3 mb-4">Mes Évaluations</h1>
            
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label for="cours" class="form-label">Cours</label>
                            <select name="cours" id="cours" class="form-select">
                                <option value="">Tous les cours</option>
                                @foreach($cours as $id => $titre)
                                    <option value="{{ $id }}" {{ request('cours') == $id ? 'selected' : '' }}>
                                        {{ $titre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="classe" class="form-label">Classe</label>
                            <select name="classe" id="classe" class="form-select">
                                <option value="">Toutes les classes</option>
                                @foreach($classes as $id => $nom)
                                    <option value="{{ $id }}" {{ request('classe') == $id ? 'selected' : '' }}>
                                        {{ $nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="statut" class="form-label">Statut</label>
                            <select name="statut" id="statut" class="form-select">
                                <option value="">Tous les statuts</option>
                                <option value="brouillon" {{ request('statut') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                <option value="programme" {{ request('statut') == 'programme' ? 'selected' : '' }}>Programmé</option>
                                <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="corrige" {{ request('statut') == 'corrige' ? 'selected' : '' }}>Corrigé</option>
                                <option value="archive" {{ request('statut') == 'archive' ? 'selected' : '' }}>Archivé</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" id="type" class="form-select">
                                <option value="">Tous types</option>
                                <option value="examen" {{ request('type') == 'examen' ? 'selected' : '' }}>Examen</option>
                                <option value="devoir" {{ request('type') == 'devoir' ? 'selected' : '' }}>Devoir</option>
                                <option value="quiz" {{ request('type') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                                <option value="projet" {{ request('type') == 'projet' ? 'selected' : '' }}>Projet</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="date_debut" class="form-label">Date début</label>
                            <input type="date" name="date_debut" id="date_debut" 
                                   class="form-control" value="{{ request('date_debut') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="date_fin" class="form-label">Date fin</label>
                            <input type="date" name="date_fin" id="date_fin" 
                                   class="form-control" value="{{ request('date_fin') }}">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="las la-filter"></i> Filtrer
                            </button>
                            <a href="{{ route('enseignant.evaluations.index') }}" class="btn btn-secondary">
                                <i class="las la-undo"></i> Réinitialiser
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            @isset($stats)
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-subtitle mb-2 text-muted">Total</h6>
                            <p class="h2">{{ $stats['total'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-subtitle mb-2 text-muted">À venir</h6>
                            <p class="h2">{{ $stats['a_venir'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-subtitle mb-2 text-muted">En cours</h6>
                            <p class="h2">{{ $stats['en_cours'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-subtitle mb-2 text-muted">Terminées</h6>
                            <p class="h2">{{ $stats['terminees'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-warning">Aucune statistique disponible</div>
            @endisset
            
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Liste des évaluations</h5>
                    <a href="{{ route('enseignant.evaluations.create') }}" class="btn btn-success">
                        <i class="las la-plus"></i> Nouvelle évaluation
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Titre</th>
                                    <th>Cours</th>
                                    <th>Classe</th>
                                    <th>Type</th>
                                    <th>Dates</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($evaluations as $evaluation)
                                <tr>
                                    <td>{{ $evaluation->titre }}</td>
                                    <td>{{ $evaluation->cours->titre ?? 'N/A' }}</td>
                                    <td>{{ $evaluation->classe->nom ?? 'SMI' }}</td>
                                    <td>
                                        <span class="badge bg-info text-capitalize">
                                            {{ $evaluation->type }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="d-block">
                                            <strong>Publié:</strong> 
                                            {{ \Carbon\Carbon::parse($evaluation->date_publication)->format('d/m/Y H:i') }}
                                        </small>
                                        <small class="d-block">
                                            <strong>Début:</strong> 
                                            {{ \Carbon\Carbon::parse($evaluation->date_debut)->format('d/m/Y H:i') }}
                                        </small>
                                        <small class="d-block">
                                            <strong>Fin:</strong> 
                                            {{ $evaluation->date_limite->format('d/m/Y H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = [
                                                'brouillon' => 'bg-secondary',
                                                'programme' => 'bg-primary',
                                                'en_cours' => 'bg-warning text-dark',
                                                'corrige' => 'bg-success',
                                                'archive' => 'bg-dark'
                                            ][$evaluation->statut] ?? 'bg-light text-dark';
                                        @endphp
                                        <span class="badge {{ $badgeClass }} text-capitalize">
                                            {{ $evaluation->statut }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('enseignant.evaluations.show', $evaluation->id_evaluation) }}" 
                                               class="btn btn-sm btn-primary" title="Voir">
                                                <i class="las la-eye"></i>
                                            </a>
                                            <a href="{{ route('enseignant.evaluations.edit',['evaluation' => $evaluation->id_evaluation]) }}"  
                                               class="btn btn-sm btn-secondary" title="Modifier">
                                                <i class="las la-pen"></i>
                                            </a>
                                            <form action="{{ route('enseignant.evaluations.destroy', $evaluation->id_evaluation) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger confirm-delete" title="Supprimer">
                                                    <i class="las la-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">Aucune évaluation trouvée</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($evaluations->hasPages())
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $evaluations->withQueryString()->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Confirmation avant suppression
    document.querySelectorAll('.confirm-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            if(!confirm('Êtes-vous sûr de vouloir supprimer cette évaluation ?')) {
                e.preventDefault();
            }
        });
    });
</script>
</body>
</html>
