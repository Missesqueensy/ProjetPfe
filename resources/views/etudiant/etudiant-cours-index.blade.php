
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours Disponibles - Tableau de Bord Étudiant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #c433ff;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }

        .sidebar {
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
            color: white;
            position: fixed;
            width: 280px;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        .course-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            border: none;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .course-img-container {
            height: 180px;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .course-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: cover;
        }

        .course-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--accent-color);
            color: white;
        }

        .teacher-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .teacher-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
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
            <i class="fas fa-envelope"></i> Réclamations
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
    </style>
</head>


    <div class="main-content">
        <div class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Cours Disponibles</h1>
                <div class="d-flex">
                    <div class="input-group me-3" style="width: 300px;">
                        <input type="text" class="form-control" placeholder="Rechercher un cours...">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <button class="btn btn-outline-secondary">
                        <i class="fas fa-filter"></i> Filtres
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                @forelse($cours as $cour)
                <div class="col-md-4 col-lg-3">
                    <div class="card course-card h-100">
                        <div class="course-img-container position-relative">
                            @if($cour->image)
                                <img src="{{ asset('assets/img/logo.jpg') }}" class="course-img" alt="{{ $cour->titre }}">
                            @else
                                <div class="text-center p-4">
                                    <i class="fas fa-book-open fa-3x text-muted"></i>
                                    <p class="mt-2 text-muted">Aucune image</p>
                                </div>
                            @endif
                            
                            @if(in_array($cour->id_cours, $coursSuivis ?? []))
                                <span class="badge course-badge">
                                    <i class="fas fa-check"></i> Suivi
                                </span>
                            @endif
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $cour->titre }}</h5>
                            <p class="card-text text-muted small mb-3">
                                {{ Str::limit($cour->description, 80) }}
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="teacher-info">
                                    @if($cour->id_enseignant->image)
                                        <img src="{{ asset('assets/img/user.jpeg') }}" class="teacher-avatar" alt="{{ $cour->enseignant->nom }}">
                                    @else
                                        <div class="teacher-avatar bg-secondary d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user text-white small"></i>
                                        </div>
                                    @endif
                                    <span class="small">{{ $cour->id_enseignant->nom ?? 'Non spécifié' }}</span>
                                </div>
                                
                               
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('cours.show', $cour->id_cours) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="far fa-eye me-1"></i> Détails
                                </a>
                                
                                @auth
                                    @if(in_array($cour->id_cours, $coursSuivis ?? []))
                                        <button class="btn btn-sm btn-success" disabled>
                                            <i class="fas fa-check"></i> Suivi
                                        </button>
                                    @else
                                        <form action="{{ route('etudiant.follow', $cour->id_cours) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fas fa-plus me-1"></i> Suivre
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Aucun cours disponible</h4>
                            <p class="text-muted">Revenez plus tard pour découvrir nos nouveaux cours</p>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
            
            @if($cours->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    {{ $cours->onEachSide(1)->links() }}
                </nav>
            </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>