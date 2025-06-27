
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $cour->titre }} - Détails du cours</title>
    <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
</style>
</head>
<body>
  <button class="menu-toggle btn btn-primary rounded-circle position-fixed d-lg-none" style="width:50px;height:50px;top:20px;left:20px;z-index:1050;">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner p-3">
            <h4 class="mb-4 text-white">Menu Étudiant</h4>
            <nav class="nav flex-column">
                        <a href="{{route('etudiant.dashboardetd')}}" class="active">

                    <i class="fas fa-home me-2"></i> Accueil
                </a>
                
                <a class="nav-link text-white mb-2" href="{{ route('cours.index') }}">
                    <i class="fas fa-book-open me-2"></i> Cours publiés
                </a>
                <a class="nav-link text-white mb-2" href="{{ route('etudiant.cours') }}">
                    <i class="fas fa-book me-2"></i> Mes cours
                </a>
                <a href="{{ route('etudiant.evaluations.index') }}">

                    <i class="fas fa-clipboard-check"></i> Évaluations
                    </a>
                <a class="nav-link text-white mb-2" href="{{ route('etudiant.notes') }}">
                    <i class="fas fa-clipboard-list me-2"></i> Notes
                </a>
                <a href="{{ route('etudiant.formulaires.index') }}">
            <i class="fas fa-file-alt me-2"></i>Formulaires
        </a>
                <a class="nav-link text-white mb-2" href="{{ route('etudiant.reclamations') }}">
                    <i class="fas fa-envelope me-2"></i> Réclamations
                </a>
                <a class="nav-link text-white mb-2" href="{{ route('etudiant.messagerie.index') }}">
                    <i class="fas fa-comments me-2"></i> Messagerie
                </a>
                <a class="nav-link text-white mb-2" href="{{ route('etudiant.parametres') }}">
                    <i class="fas fa-cog me-2"></i> Paramètres
                </a>
            </nav>
            
            <form class="mt-4" action="{{ route('etudiant.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>
    <div class="main-content">
        <div class="container-fluid">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('cours.index') }}" class="btn btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left me-2"></i> Retour
                </a>
                <h1 class="h3 mb-0">Détails du cours</h1>
            </div>
            
           
            <div class="row">
                <div class="col-lg-8">
                    <div class="card course-header-card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h2 class="course-title mb-3">{{ $cour->titre }}</h2>
                                    <div class="d-flex align-items-center">
                                        @if($cour->enseignant->image ?? false)
                                            <img src="{{ asset('assets/img/user.jpeg' . $cour->enseignant->image) }}" class="teacher-avatar me-3" alt="{{ $cour->enseignant->nom }}">
                                        @else
                                            <div class="teacher-avatar bg-secondary me-3 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-muted small">Enseignant</div>
                                            <div class="fw-bold">{{ $cour->id_enseignant->nom ?? 'Non spécifié' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="text-muted small">Publié le</div>
                                    <div class="fw-bold">
                                        @if($cour->date_publication)
                                            {{ $cour->date_publication->format('d/m/Y') }}
                                        @else
                                            Date non disponible
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            @if($cour->image)
                                <div class="mb-4 text-center">
                                    <img src="{{ asset('assets/img/logo.jpg' . $cour->image) }}" alt="{{ $cour->titre }}" class="img-fluid course-image">
                                </div>
                            @endif
                            
                            <div class="mb-4">
                                <h4 class="section-title">
                                    <i class="fas fa-align-left me-2"></i>Description
                                </h4>
                                <div class="description-box">
                                    {!! nl2br(e($cour->description)) !!}
                                </div>
                            </div>
                            
                            @if($cour->video_path)
                                <div class="mb-4">
                                    <h4 class="section-title">
                                        <i class="fas fa-video me-2"></i>Contenu vidéo
                                    </h4>
                                    <div class="ratio ratio-16x9 video-container">
                                        <video controls class="w-100">
                                            <source src="{{ asset('storage/' . $cour->video_path) }}" type="video/{{ $cour->format_video ?? 'mp4' }}">
                                            Votre navigateur ne supporte pas la lecture de vidéos.
                                        </video>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="section-title">
                                <i class="fas fa-comments me-2"></i>Questions et discussions
                            </h4>
                            
                            <form class="mb-4">
                                <div class="mb-3">
                                    <textarea class="form-control" rows="3" placeholder="Posez votre question..."></textarea>
                                </div>
                                <button class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i> Publier
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 20px;">
                        <div class="card mb-4">
                            <div class="card-body">
                                @if(in_array($cour->id_cours, $coursSuivis ?? []))
                                    <div class="alert alert-success mb-3">
                                        <i class="fas fa-check-circle me-2"></i> Vous suivez déjà ce cours
                                    </div>
                                    <a href="#" class="btn btn-primary w-100 mb-3">
                                        <i class="fas fa-book-open me-2"></i> Accéder au contenu
                                    </a>
                                @else
                                    <form action="{{ route('etudiant.follow', $cour->id_cours) }}" method="POST" class="mb-3">
                                        @csrf
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="fas fa-plus-circle me-2"></i> S'inscrire au cours
                                        </button>
                                    </form>
                                @endif
                                
                                <div class="stats-box mb-4 p-3 bg-light rounded">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <div class="fw-bold">12h</div>
                                            <div class="text-muted small">Durée</div>
                                        </div>
                                        <div class="col-4">
                                            <div class="fw-bold">24</div>
                                            <div class="text-muted small">Leçons</div>
                                        </div>
                                        <div class="col-4">
                                            <div class="fw-bold">85</div>
                                            <div class="text-muted small">Étudiants</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <h5 class="section-title">
                                        <i class="fas fa-paperclip me-2"></i>Ressources
                                    </h5>
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action resource-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                                    <span>Syllabus.pdf</span>
                                                </div>
                                                <span class="badge bg-light text-dark">2.4 MB</span>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action resource-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-file-excel text-success me-2"></i>
                                                    <span>Exercices.xlsx</span>
                                                </div>
                                                <span class="badge bg-light text-dark">1.8 MB</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h5 class="section-title">
                                    <i class="fas fa-chart-line me-2"></i>Votre progression
                                </h5>
                                <div class="progress mb-2" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-center small text-muted">25% complété</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
<!--<style>
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
</style>-->