<!--<!DOCTYPE html>
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
    @foreach($evaluations as $eval)
        <li>
            <a href="{{ route('enseignant.notes.index', ['evaluation' => $eval->id_evaluation]) }}">
                <span class="la la-check-circle"></span>
                Résultats étudiants {{ $eval->titre }}
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

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="gmail-container">
                    <div class="gmail-header d-flex justify-content-between align-items-center">
                        <a href="https://mail.google.com" target="_blank" class="gmail-btn">
                            <i class="fab fa-google me-2"></i> Ouvrir Gmail
                        </a>
                    </div>

                    <div class="info-box">
                        <h5><i class="fas fa-info-circle text-primary me-2"></i> Comment accéder à vos emails</h5>
                        <p class="mb-0">Cliquez sur le bouton "Ouvrir Gmail" ci-dessus pour accéder directement à votre boîte Gmail dans un nouvel onglet.</p>
                    </div>

                    <div class="text-center py-4">
                        <div class="alert alert-info d-inline-block">
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=contact@votresite.com" 
                           target="_blank"
                           class="btn btn-outline-danger">
                           <i class="fas fa-paper-plane me-2"></i> Envoyer un email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Option: Ouvrir Gmail automatiquement dans un nouvel onglet au chargement
        // window.open('https://mail.google.com', '_blank');
    </script>
</body>
</html>--> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boîte Email - Dashboard Enseignant</title>
    
    <!-- CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <style>
        .email-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #4285F4 0%, #34A853 100%);
            color: white;
            padding: 1.5rem;
        }
        .email-sidebar {
            border-right: 1px solid #eee;
            padding: 1rem;
        }
        .email-list {
            max-height: 70vh;
            overflow-y: auto;
        }
        .email-item {
            border-bottom: 1px solid #eee;
            transition: all 0.3s;
        }
        .email-item:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }
        .email-item.unread {
            background-color: #f0f7ff;
            font-weight: 500;
        }
        .email-content {
            padding: 2rem;
            min-height: 60vh;
        }
        .compose-btn {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            font-weight: 500;
        }
        .badge-important {
            background-color: #EA4335;
        }
    </style>
</head>

<body>
<div class="dashboard-container">
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
    @foreach($evaluations as $eval)
        <li>
            <a href="{{ route('enseignant.notes.index', ['evaluation' => $eval->id_evaluation]) }}">
                <span class="la la-check-circle"></span>
                Résultats étudiants {{ $eval->titre }}
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

    

    <!-- Contenu principal amélioré -->
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

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="email-container">
                        <!-- En-tête -->
                        <div class="email-header d-flex justify-content-between align-items-center">
                            <h2 class="mb-0">
                                <i class="fas fa-envelope me-2"></i> Messagerie
                            </h2>
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=contact@votresite.com" 
                               target="_blank"
                               class="btn btn-light compose-btn">
                               <i class="fas fa-plus me-2"></i> Nouveau message
                            </a>
                        </div>

                        <!-- Corps principal -->
                        <div class="row g-0">
                            <!-- Sidebar des dossiers -->
                            <div class="col-md-3 email-sidebar">
                                <div class="d-grid gap-2 mb-4">
                                    <a href="https://mail.google.com" target="_blank" class="btn btn-outline-primary">
                                        <i class="fab fa-google me-2"></i> Ouvrir Gmail
                                    </a>
                                </div>

                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">
                                            <i class="fas fa-inbox me-2"></i> Boîte de réception
                                            <span class="badge bg-primary float-end">3</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="fas fa-paper-plane me-2"></i> Envoyés
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="fas fa-exclamation-circle me-2"></i> Importants
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="fas fa-trash-alt me-2"></i> Corbeille
                                        </a>
                                    </li>
                                </ul>

                                <div class="mt-4">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <small>Cliquez sur "Ouvrir Gmail" pour accéder à votre messagerie complète</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Liste des emails -->
                            <div class="col-md-9">
                                <div class="email-list">
                                    <!-- Email 1 -->
                                    <div class="email-item p-3 unread">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Expéditeur">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="mb-0">Administration</h6>
                                                    <small class="text-muted">Aujourd'hui, 10:30</small>
                                                </div>
                                                <p class="mb-0 text-truncate">Nouvelle circulaire académique - Juin 2023</p>
                                                <span class="badge badge-important text-white">Important</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email 2 -->
                                    <div class="email-item p-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Expéditeur">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="mb-0">Direction des études</h6>
                                                    <small class="text-muted">Hier, 15:45</small>
                                                </div>
                                                <p class="mb-0 text-truncate">Réunion pédagogique - Convocation</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email 3 -->
                                    <div class="email-item p-3">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Expéditeur">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="mb-0">Service Informatique</h6>
                                                    <small class="text-muted">Lundi, 09:20</small>
                                                </div>
                                                <p class="mb-0 text-truncate">Mise à jour des systèmes prévue ce weekend</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contenu de l'email sélectionné -->
                                <div class="email-content">
                                    <div class="alert alert-primary">
                                        Sélectionnez un email pour en voir le contenu, ou cliquez sur "Ouvrir Gmail" pour accéder à votre messagerie complète.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Simulation de sélection d'email
    document.querySelectorAll('.email-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.email-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            
            // Ici vous pourriez charger le contenu de l'email via AJAX
            document.querySelector('.email-content').innerHTML = `
                <h4>${this.querySelector('h6').textContent}</h4>
                <p class="text-muted">${this.querySelector('small').textContent}</p>
                <hr>
                <p>Ceci est un exemple de contenu d'email. En production, vous pourriez :</p>
                <ul>
                    <li>Intégrer directement Gmail avec l'API Google</li>
                    <li>Ou développer votre propre système de messagerie</li>
                    <li>Ou simplement rediriger vers Gmail comme vous le faites actuellement</li>
                </ul>
                <div class="mt-4">
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-reply me-2"></i> Répondre
                    </button>
                </div>
            `;
        });
    });
</script>
</body>
</html>