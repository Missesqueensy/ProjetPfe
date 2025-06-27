
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours - Étudiant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #c433ff; /* Conservation de votre couleur violette */
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --sidebar-bg: linear-gradient(to bottom, #6a11cb, #2575fc);
        }

        body {
            background: #f5f7fa;
            font-family: 'Poppins', sans-serif;
            color: #495057;
        }

        .sidebar {
            background: var(--sidebar-bg);
            min-height: 100vh;
            color: white;
            padding: 2rem 1rem;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 280px;
            z-index: 100;
        }

        .sidebar h4 {
            color: white;
            font-weight: 600;
            margin-bottom: 2rem;
            padding-left: 10px;
            border-left: 4px solid var(--accent-color);
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }

        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        .dashboard-header {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .dashboard-header h2 {
            color: var(--accent-color); /* Utilisation de votre couleur violette */
            font-weight: 700;
            margin-bottom: 0;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(to right, var(--primary-color), var(--accent-color)); /* Intégration de votre couleur */
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.25rem;
            font-weight: 600;
        }

        .info-item {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .info-value {
            color: #6c757d;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px 15px;
            border-radius: 8px;
            width: 100%;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-logout i {
            margin-right: 8px;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .user-role-badge {
            background: var(--accent-color); /* Utilisation de votre couleur violette */
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            margin-top: 10px;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
                width: 280px;
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block !important;
            }
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: var(--accent-color); /* Utilisation de votre couleur violette */
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-section {
            text-align: center;
            padding: 2rem;
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-top: 1rem;
            color: var(--dark-color);
        }

        .modal-photo {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.8);
        }

        .modal-content {
            margin: 10% auto;
            display: block;
            max-width: 80%;
            max-height: 80%;
            border: 3px solid var(--accent-color); /* Utilisation de votre couleur violette */
            border-radius: 10px;
        }
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #c433ff;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --sidebar-bg: linear-gradient(to bottom, #6a11cb, #2575fc);
            --custom-purple: #6a11cb;
        }

        body {
            background: #f5f7fa;
            font-family: 'Poppins', sans-serif;
            color: #495057;
        }

        .sidebar {
            background: var(--sidebar-bg);
            min-height: 100vh;
            color: white;
            padding: 2rem 1rem;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 280px;
            z-index: 100;
        }

        .sidebar h4 {
            color: white;
            font-weight: 600;
            margin-bottom: 2rem;
            padding-left: 10px;
            border-left: 4px solid var(--accent-color);
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }

        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px 15px;
            border-radius: 8px;
            width: 100%;
            margin-top: auto;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-logout i {
            margin-right: 8px;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        .custom-purple {
            color: var(--custom-purple);
        }

        .bg-purple {
            background-color: var(--primary-color);
        }

        .btn-purple {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-purple:hover {
            background-color: #5a0cb0;
            color: white;
        }

        .btn-outline-purple {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-purple:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .stat-card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .course-card {
            transition: transform 0.3s ease;
        }

        .course-card-inner {
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .course-card-inner:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .course-image-container {
            height: 180px;
            overflow: hidden;
            position: relative;
        }

        .course-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .course-card:hover .course-image {
            transform: scale(1.05);
        }

        .avatar-sm {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .course-progress-indicator {
            height: 10px;
            background-color: #4CAF50;
            transition: width 0.5s ease;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
                width: 280px;
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block !important;
            }
        }
    </style>
</head>
<body>
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar" id="sidebar">
        <h4>Menu Étudiant</h4>
        <a href="{{route('etudiant.dashboardetd')}}" class="active">
            <i class="fas fa-home"></i> Accueil
        </a>
        <a href="{{route('cours.index')}}">
            <i class="fas fa-book"></i>Cours publiés
        </a>
        <a href="{{route('etudiant.cours')}}">
            <i class="fas fa-book"></i> Mes cours
        </a>
        <a href="{{ route('etudiant.evaluations.index') }}">

                    <i class="fas fa-clipboard-check"></i> Évaluations
                    </a>
        <a href="{{ route('etudiant.notes') }}">
            <i class="fas fa-clipboard-list"></i> Notes
        </a>
        <a href="{{route('etudiant.formulaires.index')}}">
            <i class="fas fa-file-alt"></i>Formulaires
        </a>
        <a href="{{ route('etudiant.reclamations') }}">
            <i class="fas fa-exclamation-circle me-2 "></i> Réclamations
        </a>
        <a href="{{ route('etudiant.messagerie.index') }}">
            <i class="fas fa-comments"></i> Messagerie
        </a>
        <a href="{{ route('etudiant.parametres') }}">
            <i class="fas fa-cog"></i> Paramètres
        </a>

        <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold custom-purple"><i class="fas fa-book-open me-2"></i>Mes Cours</h2>
            <div class="d-flex align-items-center">
                <span class="badge bg-purple me-3">
                    <i class="fas fa-bookmark me-1"></i> {{ $cours->total() }} cours
                </span>
                <button class="btn btn-sm btn-outline-purple" data-bs-toggle="modal" data-bs-target="#helpModal">
                    <i class="fas fa-question-circle"></i> Aide
                </button>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card stat-card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">En cours</h6>
                                <h3 class="card-title mb-0">{{ $cours->where('pivot.statut', 'progress')->count() }}</h3>
                            </div>
                            <i class="fas fa-spinner fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Terminés</h6>
                                <h3 class="card-title mb-0">{{ $cours->where('pivot.statut', 'completed')->count() }}</h3>
                            </div>
                            <i class="fas fa-check-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card bg-warning text-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Progression moyenne</h6>
                                <h3 class="card-title mb-0">{{ round($cours->avg('pivot.progression') ?? 25) }}%</h3>
                            </div>
                            <i class="fas fa-chart-line fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" class="form-control border-start-0" placeholder="Rechercher un cours..." id="search-courses">
                            <button class="btn btn-purple" type="button">
                                <i class="fas fa-filter me-1"></i> Filtrer
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <select class="form-select me-2" id="filter-courses">
                                <option value="all">Tous les cours</option>
                                <option value="recent">Récemment ajoutés</option>
                                <option value="progress">En cours</option>
                                <option value="completed">Terminés</option>
                            </select>
                            <select class="form-select" id="sort-courses">
                                <option value="recent">Plus récents</option>
                                <option value="oldest">Plus anciens</option>
                                <option value="name-asc">A-Z</option>
                                <option value="name-desc">Z-A</option>
                                <option value="progress">Progression</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="courses-container">
            @forelse($cours as $cour)
                <div class="col course-card" 
                     data-course-name="{{ strtolower($cour->titre) }}"
                     data-course-status="{{ $cour->pivot->statut ?? 'progress' }}"
                     data-course-date="{{ $cour->pivot->created_at->timestamp }}"
                     data-course-progress="{{ $cour->pivot->progression ?? 0 }}">
                    <div class="card h-100 shadow-sm border-0 course-card-inner">
                        @if($cour->image)
                            <div class="course-image-container">
                                <img src="{{ asset('assets/img/logo.jpg') }}" class="card-img-top course-image" alt="{{ $cour->titre }}">
                            </div>
                        @else
                            <div class="course-image-container bg-light">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <i class="fas fa-book-open text-muted" style="font-size: 3rem;"></i>
                                </div>
                            </div>
                        @endif
                        
                        <div class="card-img-overlay d-flex justify-content-between align-items-start p-3">
                            <div>
                                @if($cour->est_public)
                                    <span class="badge bg-success me-1"><i class="fas fa-globe me-1"></i>Public</span>
                                @else
                                    <span class="badge bg-warning text-dark"><i class="fas fa-lock me-1"></i>Privé</span>
                                @endif
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v text-white"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('cours.show', $cour->id_cours) }}"><i class="fas fa-door-open me-2"></i>Accéder au cours</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Télécharger ressources</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Se désinscrire</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold custom-purple mb-0">{{ $cour->titre }}</h5>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-star text-warning me-1"></i>{{ $cour->difficulte }}/5
                                </span>
                            </div>
                            
                            <p class="card-text text-muted small mb-3">{{ Str::limit($cour->description, 100) }}</p>
                            
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar-sm me-2">
                                    <span class="avatar-title bg-purple rounded-circle">
                                        {{ substr($cour->id_enseignant->prenom, 0, 1) }}{{ substr($cour->id_enseignant->nom, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <small class="d-block text-muted">Enseignant</small>
                                    <small class="fw-bold">{{ $cour->id_enseignant->nom }} {{ $cour->id_enseignant->prenom }}</small>
                                </div>
                            </div>
                            
                            <hr class="my-3">
                            
                            <div class="row g-2 text-center">
                                <div class="col-4">
                                    <small class="d-block text-muted">Statut</small>
                                    <small class="fw-bold">
                                        @if($cour->pivot->statut == 'progress')
                                            Terminé
                                        @else
                                            En cours
                                        @endif
                                    </small>
                                </div>
                                <div class="col-4">
                                    <small class="d-block text-muted">Inscrit le</small>
                                    <small class="fw-bold">{{ $cour->pivot->created_at->format('d/m/Y') }}</small>
                                </div>
                                <div class="col-4">
                                    <small class="d-block text-muted">Progression</small>
                                    <small class="fw-bold">{{ $cour->pivot->progression ?? 0}}%</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-0 pt-0 pb-3">
                            <div class="d-grid gap-2">
                                <a href="{{ route('cours.show', $cour->id_cours) }}" class="btn btn-purple btn-sm">
                                    <i class="fas fa-play-circle me-1"></i> Continuer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-book-open fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">Aucun cours trouvé</h4>
                            <p class="text-muted">Vous n'êtes inscrit à aucun cours pour le moment.</p>
                            <a href="{{ route('etudiant.cours') }}" class="btn btn-purple">
                                <i class="fas fa-plus me-1"></i> Explorer les cours
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        
        @if($cours->hasPages())
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        @if($cours->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $cours->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                            </li>
                        @endif
                        
                        @foreach(range(1, $cours->lastPage()) as $i)
                            <li class="page-item {{ $cours->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $cours->url($i) }}">{{ $i }}</a>
                            </li>
                        @endforeach
                        
                        @if($cours->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $cours->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </div>

    <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-purple text-white">
                    <h5 class="modal-title" id="helpModalLabel"><i class="fas fa-question-circle me-2"></i>Aide - Mes Cours</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6><i class="fas fa-search me-2 text-purple"></i>Recherche et filtres</h6>
                    <p class="small text-muted mb-3">Utilisez la barre de recherche pour trouver un cours spécifique. Les filtres vous permettent d'afficher seulement les cours en cours, terminés ou récemment ajoutés.</p>
                    
                    <h6><i class="fas fa-chart-line me-2 text-purple"></i>Progression</h6>
                    <p class="small text-muted mb-3">La barre de progression en haut de chaque carte de cours montre votre avancement dans le cours. Cliquez sur "Continuer" pour reprendre là où vous vous étiez arrêté.</p>
                    
                    <h6><i class="fas fa-cog me-2 text-purple"></i>Options</h6>
                    <p class="small text-muted">Cliquez sur les trois points en haut à droite d'une carte de cours pour accéder à des options supplémentaires comme le téléchargement des ressources ou la désinscription.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-purple" data-bs-dismiss="modal">J'ai compris</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Menu toggle for mobile
            $('#menuToggle').click(function() {
                $('#sidebar').toggleClass('active');
            });

            // Search functionality
            $('#search-courses').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                $('.course-card').each(function() {
                    const courseName = $(this).data('course-name');
                    if (courseName.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
            
            // Filter functionality
            $('#filter-courses').change(function() {
                const filterValue = $(this).val();
                $('.course-card').each(function() {
                    const courseStatus = $(this).data('course-status');
                    if (filterValue === 'all' || 
                        (filterValue === 'recent' && isRecent($(this).data('course-date'))) || 
                        (filterValue === 'progress' && courseStatus === 'progress') || 
                        (filterValue === 'completed' && courseStatus === 'completed')) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
            
            // Sort functionality
            $('#sort-courses').change(function() {
                const sortValue = $(this).val();
                const container = $('#courses-container');
                const items = container.find('.course-card').get();
                
                items.sort(function(a, b) {
                    const aData = $(a).data();
                    const bData = $(b).data();
                    
                    switch(sortValue) {
                        case 'recent':
                            return bData.courseDate - aData.courseDate;
                        case 'oldest':
                            return aData.courseDate - bData.courseDate;
                        case 'name-asc':
                            return aData.courseName.localeCompare(bData.courseName);
                        case 'name-desc':
                            return bData.courseName.localeCompare(aData.courseName);
                        case 'progress':
                            return bData.courseProgress - aData.courseProgress;
                        default:
                            return 0;
                    }
                });
                
                $.each(items, function(idx, item) {
                    container.append(item);
                });
            });
            
            function isRecent(timestamp) {
                const weekAgo = Date.now() - (7 * 24 * 60 * 60 * 1000);
                return timestamp * 1000 > weekAgo;
            }
            
            // Animate progress bars on scroll
            $(window).scroll(function() {
                $('.course-progress-indicator').each(function() {
                    const position = $(this).offset().top;
                    const scroll = $(window).scrollTop();
                    const windowHeight = $(window).height();
                    
                    if (scroll + windowHeight > position) {
                        $(this).css('width', $(this).data('width'));
                    }
                });
            }).scroll();
        });
    </script>
</body>
</html>