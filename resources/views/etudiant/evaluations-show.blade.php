
 
<<!--!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Étudiant - 
    @auth('etudiant')
        {{ Auth::guard('etudiant')->user()->prénom }} {{ Auth::guard('etudiant')->user()->nom }}
    @else
        Profil
    @endauth
    </title>
            <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            <button type="submit" class="btn btn-link text-white text-start w-100 ps-3 py-2 d-flex align-items-center">
                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
            </button>
        </form>
    </div>
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">{{ $evaluation->titre }}</h3>
                <span class="badge bg-light text-dark">{{ ucfirst($evaluation->type) }}</span>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Cours :</strong> {{ $evaluation->cours->nom }}</p>
                    <p><strong>Classe :</strong> {{ $evaluation->classe->nom }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Enseignant :</strong> {{ $evaluation->enseignant->nom }}</p>
                <p><strong>Date limite :</strong> {{ \Carbon\Carbon::parse($evaluation->date_limite)->format('d/m/Y H:i') }}</p>

                </div>
            </div>

            <div class="mb-4">
                <h5 class="text-primary">Description :</h5>
                <p>{{ $evaluation->description ?? 'Aucune description fournie' }}</p>
            </div>

            <div class="mb-4">
                <h5 class="text-primary">Fichiers :</h5>
                @if($evaluation->fichier_consigne)
                    <a href="{{ Storage::url($evaluation->fichier_consigne) }}" 
                       class="btn btn-sm btn-outline-primary me-2"
                       target="_blank">
                        <i class="fas fa-file-download"></i> Télécharger le sujet
                    </a>
                @else
                    <p>Aucun fichier sujet disponible</p>
                @endif

                @if($evaluation->fichier_correction)
                    <a href="{{ Storage::url($evaluation->fichier_correction) }}" 
                       class="btn btn-sm btn-outline-success"
                       target="_blank">
                        <i class="fas fa-file-download"></i> Télécharger la correction
                    </a>
                @endif
            </div>

            @php
                $note = $evaluation->notes->where('id_etudiant', auth()->guard('etudiant')->id())->first();
            @endphp

            <div class="mt-4 border-top pt-3">
                <h5 class="text-primary">Mon résultat :</h5>
                
                @if($note && $note->statut === 'publie')
                    <div class="alert alert-{{ $note->valeur >= 10 ? 'success' : 'danger' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">
                                    Note : <strong>{{ $note->valeur }}/{{ $evaluation->bareme_total }}</strong>
                                </h5>
                                @if($note->commentaire)
                                    <p class="mb-0 mt-2"><strong>Commentaire :</strong> {{ $note->commentaire }}</p>
                                @endif
                            </div>
                            <span class="badge bg-{{ $note->valeur >= 10 ? 'success' : 'danger' }} fs-6">
                                {{ $note->valeur >= 10 ? 'Validé' : 'Non validé' }}
                            </span>
                        </div>
                    </div>
                    
                    <p class="text-muted small">
                        Résultat publié le : {{ $note->date_notation->format('d/m/Y à H:i') }}
                    </p>
                @elseif($evaluation->statut === 'corrige')
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle me-2"></i>
                        Votre copie a été corrigée mais les résultats ne sont pas encore publiés.
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Aucun résultat disponible pour le moment.
                    </div>
                @endif
            </div>
        </div>

        <div class="card-footer bg-light">
            <a href="{{ route('etudiant.evaluations.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> Retour à la liste
            </a>
        </div>
    </div>
</div>

@section('styles')
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: none;
    }
    .badge {
        font-size: 0.9em;
        padding: 0.5em 0.75em;
    }
</style>
</body>
</html>--> 
@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Évaluation - {{ Auth::guard('etudiant')->user()->prénom }} {{ Auth::guard('etudiant')->user()->nom }}</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">
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
        --sidebar-bg: linear-gradient(to bottom, #6a11cb, #2575fc);
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f7fa;
        color: #495057;
    }
    
    .sidebar {
        background: var(--sidebar-bg);
        min-height: 100vh;
        color: white;
        padding: 2rem 1.5rem;
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
    
    .sidebar .nav-link {
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
    
    .sidebar .nav-link i {
        margin-right: 10px;
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }
    
    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        transform: translateX(5px);
    }
    
    .sidebar .nav-link.active {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        font-weight: 600;
    }
    
    .main-content {
        margin-left: 280px;
        padding: 2rem;
    }
    
    .course-header-card {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .course-header-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .course-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 1rem;
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
    .teacher-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .course-image {
        max-height: 400px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .resource-item {
        transition: all 0.3s ease;
        border-left: 3px solid var(--accent-color);
    }
    
    .resource-item:hover {
        transform: translateX(5px);
        background-color: rgba(106, 17, 203, 0.05);
    }
    
    .video-container {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .description-box {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
        border-left: 4px solid var(--primary-color);
    }
    
    .section-title {
        color: var(--primary-color);
        font-weight: 600;
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }
    
    .stats-box {
        background: linear-gradient(135deg, rgba(106, 17, 203, 0.1) 0%, rgba(37, 117, 252, 0.1) 100%);
        border-radius: 10px;
        padding: 1rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
    }
    
    .btn-outline-secondary {
        border: 1px solid #6c757d;
        color: #6c757d;
        transition: all 0.3s ease;
    }
    
    .btn-outline-secondary:hover {
        background: #6c757d;
        color: white;
    }
    
    .progress-bar {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
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
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #c433ff;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --sidebar-bg: linear-gradient(to bottom, #6a11cb, #2575fc);
        }

        /* Structure de base */
        body {
            background: #f5f7fa;
            font-family: 'Poppins', sans-serif;
            color: #495057;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        /* Carte d'évaluation */
        .evaluation-card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .evaluation-header {
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1.25rem;
        }

        .evaluation-badge {
            font-size: 0.85rem;
            padding: 0.5rem 0.75rem;
        }

        /* Sections de contenu */
        .info-section {
            padding: 1.5rem;
        }

        .info-row {
            margin-bottom: 1rem;
        }

        .file-section {
            margin: 1.5rem 0;
            padding: 1rem;
            background-color: var(--light-color);
            border-radius: 8px;
        }

        .result-section {
            border-top: 1px solid #eee;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
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
        <a href="{{ route('etudiant.formulaires.index') }}" >
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
    <!-- Contenu principal -->
    <div class="main-content">
        <div class="container py-4">
            <!-- Carte d'évaluation -->
            <div class="card evaluation-card">
                <!-- En-tête -->
                <div class="card-header evaluation-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">{{ $evaluation->titre }}</h3>
                        <span class="badge bg-light text-dark evaluation-badge">
                            {{ ucfirst($evaluation->type) }}
                        </span>
                    </div>
                </div>

                <!-- Corps de la carte -->
                <div class="card-body">
                    <!-- Informations générales -->
                    <div class="info-section">
                        <div class="row info-row">
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-book text-primary me-2"></i>Cours :</strong> 
                                {{ $evaluation->cours->nom }}</p>
                                <p><strong><i class="fas fa-users text-primary me-2"></i>Classe :</strong> 
                                {{ $evaluation->classe->nom }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-chalkboard-teacher text-primary me-2"></i>Enseignant :</strong> 
                                {{ $evaluation->enseignant->nom }}</p>
                                <p><strong><i class="fas fa-clock text-primary me-2"></i>Date limite :</strong> 
                                {{ Carbon::parse($evaluation->date_limite)->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="info-row">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-align-left me-2"></i>Description :
                            </h5>
                            <div class="px-3">
                                {{ $evaluation->description ?? 'Aucune description fournie' }}
                            </div>
                        </div>
                    </div>

                    <!-- Fichiers -->
                    <div class="file-section">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-paperclip me-2"></i>Fichiers :
                        </h5>
                        <div class="d-flex flex-wrap gap-2">
                            @if($evaluation->fichier_consigne)
                                <a href="{{ Storage::url($evaluation->fichier_consigne) }}" 
                                   class="btn btn-sm btn-outline-primary"
                                   target="_blank">
                                    <i class="fas fa-file-download me-2"></i> Télécharger le sujet
                                </a>
                            @else
                                <span class="text-muted">Aucun fichier sujet disponible</span>
                            @endif

                            @if($evaluation->fichier_correction)
                                <a href="{{ Storage::url($evaluation->fichier_correction) }}" 
                                   class="btn btn-sm btn-outline-success"
                                   target="_blank">
                                    <i class="fas fa-file-download me-2"></i> Télécharger la correction
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Résultats -->
                    <div class="result-section">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-chart-line me-2"></i>Mon résultat :
                        </h5>
                        
                        @php
                            $note = $evaluation->notes->where('id_etudiant', auth()->guard('etudiant')->id())->first();
                        @endphp

                        @if($note && $note->statut === 'publie')
                            <div class="alert alert-{{ $note->valeur >= 10 ? 'success' : 'danger' }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1">
                                            <i class="fas fa-star me-2"></i>Note : 
                                            <strong>{{ $note->valeur }}/{{ $evaluation->bareme_total }}</strong>
                                        </h5>
                                        @if($note->commentaire)
                                            <div class="mt-2">
                                                <p class="mb-1"><strong>Commentaire :</strong></p>
                                                <p class="mb-0 ps-3">{{ $note->commentaire }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="badge bg-{{ $note->valeur >= 10 ? 'success' : 'danger' }} fs-6">
                                        {{ $note->valeur >= 10 ? 'Validé' : 'Non validé' }}
                                    </span>
                                </div>
                            </div>
                            
                            <p class="text-muted small">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Publié le : {{ $note->date_notation->format('d/m/Y à H:i') }}
                            </p>
                        @elseif($evaluation->statut === 'corrige')
                            <div class="alert alert-warning">
                                <i class="fas fa-info-circle me-2"></i>
                                Votre copie a été corrigée mais les résultats ne sont pas encore publiés.
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Aucun résultat disponible pour le moment.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Pied de carte -->
                <div class="card-footer bg-light">
                    <a href="{{ route('etudiant.evaluations.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>