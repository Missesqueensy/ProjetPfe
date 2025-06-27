<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaires - Plateforme Étudiante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">
       <style>
        .form-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .badge-question {
            background-color: #0d6efd;
        }
        .badge-explication {
            background-color: #198754;
        }
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
    <div class="sidebar">
        <h4>Menu Étudiant</h4>
        <a href="{{ route('etudiant.dashboardetd') }}">
            <i class="fas fa-home me-2"></i>Accueil
        </a>
        <a href="{{ route('cours.index') }}">
            <i class="fas fa-book me-2"></i>Cours publiés
        </a>
        <a href="{{ route('etudiant.cours') }}">
            <i class="fas fa-book-open me-2"></i>Mes cours
        </a>
        <a href="{{ route('etudiant.evaluations.index') }}">

                    <i class="fas fa-clipboard-check"></i> Évaluations
                    </a>
        <a href="{{ route('etudiant.notes') }}">
            <i class="fas fa-clipboard-list me-2"></i>Notes
        </a>
        <a href="{{ route('etudiant.formulaires.index') }}" class="active">
            <i class="fas fa-file-alt me-2"></i>Formulaires
        </a>
        <a href="{{ route('etudiant.reclamations') }}">
            <i class="fas fa-exclamation-circle me-2"></i>Réclamations
        </a>
        <a href="{{ route('etudiant.messagerie.index') }}">
            <i class="fas fa-comments me-2"></i>Messagerie
        </a>
        <a href="{{ route('etudiant.parametres') }}">
            <i class="fas fa-cog me-2"></i>Paramètres
        </a>
        <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
            </button>
        </form>
    </div>

    <div class="main-content">
        <div class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1"><i class="fas fa-file-alt me-2"></i>Formulaires disponibles</h2>
                    <p class="text-muted mb-0">Gérez vos formulaires et ceux partagés avec vous</p>
                </div>
                <a href="{{ route('etudiant.formulaires.shared') }}" class="btn btn-info me-2">
            <i class="fas fa-share-alt me-2"></i>Formulaires partagés
        </a>
                <a href="{{ route('etudiant.formulaires.create') }}" class="btn btn-primary btn-create">
                    <i class="fas fa-plus me-2"></i>Créer un formulaire
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
          <div class="row">
                @if(isset($formulaires) && count($formulaires) > 0)
                    @foreach($formulaires as $formulaire)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card form-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">{{ $formulaire->titre }}</h5>
                                    <span class="badge badge-type {{ $formulaire->type == 'question' ? 'bg-primary' : 'bg-success' }}">
                                        {{ ucfirst($formulaire->type) }}
                                    </span>
                                </div>
                                
                                <p class="card-text text-muted mb-3">
                                    {{ Str::limit(strip_tags($formulaire->contenu), 120) }}
                                </p>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">
                                            <i class="far fa-user me-1"></i>{{ $formulaire->etudiant->nom ?? 'Auteur inconnu' }}
                                        </small>
                                        <small class="text-muted d-block">
                                            <i class="far fa-calendar me-1"></i>{{ $formulaire->created_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                    
                                    <div class="btn-group">
                                        <a href="{{ route('etudiant.formulaires.show', $formulaire->id_formulaire) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        @if($formulaire->id_etudiant == Auth::id())
                                            <a href="{{ route('etudiant.formulaires.edit', $formulaire->id_formulaire) }}" 
                                               class="btn btn-sm btn-outline-secondary">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info text-center py-4">
                            <i class="fas fa-info-circle fa-2x mb-3"></i>
                            <h4>Aucun formulaire disponible pour le moment</h4>
                            <p class="mb-0">Commencez par créer votre premier formulaire</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>