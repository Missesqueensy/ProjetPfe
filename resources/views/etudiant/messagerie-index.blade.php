
<!--<!DOCTYPE html>
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
        <a href="{{ route('etudiant.notes') }}">
            <i class="fas fa-clipboard-list"></i> Notes
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

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Messagerie</h2>
        <a href="{{ route('etudiant.messagerie.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvelle conversation
        </a>
    </div>

    @if($conversations->isEmpty())
        <div class="alert alert-info">Vous n'avez aucune conversation.</div>
    @else
        <div class="list-group">
            @foreach($conversations as $conversation)
                @php
                    $otherParticipants = $conversation->participants
                        ->where('id_etudiant', '!=', Auth::guard('etudiant')->user()->id_etudiant)
                        ->pluck('etudiant');
                    $lastMessage = $conversation->messages->first();
                @endphp

                <a href="{{ route('etudiant.messagerie.show', $conversation) }}" 
                   class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-3">
                                @if($otherParticipants->count() === 1)
                                    <span class="avatar-initials bg-primary text-white">
                                        {{ substr($otherParticipants->first()->nom, 0, 1) }}
                                    </span>
                                @else
                                    <span class="avatar-initials bg-secondary text-white">
                                        <i class="fas fa-users"></i>
                                    </span>
                                @endif
                            </div>
                            <div>
                                <h5 class="mb-1">
                                    @if($otherParticipants->count() === 1)
                                        {{ $otherParticipants->first()->nom }} {{ $otherParticipants->first()->prénom }}
                                    @else
                                        Groupe ({{ $otherParticipants->count() }} participants)
                                    @endif
                                </h5>
                                <p class="mb-1 text-muted small">
                                    @if($lastMessage)
                                        @if($lastMessage->id_etudiant === Auth::guard('etudiant')->user()->id_etudiant)
                                            Vous: 
                                        @else
                                            {{ $lastMessage->etudiant->nom }}: 
                                        @endif
                                        {{ Str::limit($lastMessage->content, 50) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="text-end">
                            @if($lastMessage)
                                <small class="text-muted">
                                    {{ $lastMessage->created_at->diffForHumans() }}
                                </small>
                                @if($lastMessage->id_etudiant !== Auth::guard('etudiant')->user()->id_etudiant && !$lastMessage->read_at)
                                    <span class="badge bg-primary ms-2">Nouveau</span>
                                @endif
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>

<style>
    .avatar {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .avatar-initials {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    .list-group-item {
        transition: all 0.2s;
    }
    .list-group-item:hover {
        transform: translateX(5px);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
</style>
</body>
</html>-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie - {{ Auth::guard('etudiant')->user()->prénom }} {{ Auth::guard('etudiant')->user()->nom }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }
        
        .messagerie-container {
            margin-left: 280px;
            padding: 2rem;
            background: #f5f7fa;
            min-height: 100vh;
        }
        
        .conversation-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }
        
        .conversation-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .avatar-group {
            background: var(--accent-color);
        }
        
        .message-preview {
            color: #6c757d;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 300px;
        }
        
        .time-badge {
            font-size: 0.8rem;
            color: #adb5bd;
        }
        
        .new-message-badge {
            background: var(--accent-color);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }
        
        .btn-new-conversation {
            background: var(--primary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .btn-new-conversation:hover {
            background: var(--secondary-color);
        }
        
        @media (max-width: 992px) {
            .messagerie-container {
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
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>
    <!-- Contenu principal de la messagerie -->
    <div class="messagerie-container">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0"><i class="fas fa-comments me-2"></i>Messagerie</h2>
                <a href="{{ route('etudiant.messagerie.create') }}" class="btn btn-new-conversation text-white">
                    <i class="fas fa-plus me-2"></i>Nouvelle conversation
                </a>
            </div>

            @if($conversations->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-comment-slash fa-3x mb-3 text-muted"></i>
                    <h4 class="text-muted">Aucune conversation</h4>
                    <p class="text-muted">Commencez par créer une nouvelle conversation</p>
                    <a href="{{ route('etudiant.messagerie.create') }}" class="btn btn-new-conversation text-white mt-3">
                        <i class="fas fa-plus me-2"></i>Nouvelle conversation
                    </a>
                </div>
            @else
                <div class="row">
                    @foreach($conversations as $conversation)
                        @php
                            $otherParticipants = $conversation->participants
                                ->where('id_etudiant', '!=', Auth::guard('etudiant')->user()->id_etudiant)
                                ->pluck('etudiant');
                            $lastMessage = $conversation->messages->sortByDesc('created_at')->first();
                            $unread = $lastMessage && 
                                      $lastMessage->id_etudiant != Auth::guard('etudiant')->user()->id_etudiant && 
                                      !$lastMessage->read_at;
                        @endphp

                        <div class="col-md-12 mb-3">
                            <a href="{{ route('etudiant.messagerie.show', $conversation) }}" class="text-decoration-none">
                                <div class="card conversation-card p-3 {{ $unread ? 'border-start border-3 border-primary' : '' }}">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar {{ $otherParticipants->count() > 1 ? 'avatar-group' : '' }}">
                                            @if($otherParticipants->count() === 1)
                                                {{ substr($otherParticipants->first()->nom, 0, 1) }}{{ substr($otherParticipants->first()->prénom, 0, 1) }}
                                            @else
                                                <i class="fas fa-users"></i>
                                            @endif
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <h5 class="mb-1">
                                                @if($otherParticipants->count() === 1)
                                                    {{ $otherParticipants->first()->prénom }} {{ $otherParticipants->first()->nom }}
                                                @else
                                                    Groupe ({{ $otherParticipants->count() }})
                                                @endif
                                            </h5>
                                            <p class="mb-0 message-preview">
                                                @if($lastMessage)
                                                    <span class="{{ $unread ? 'fw-bold' : '' }}">
                                                        @if($lastMessage->id_etudiant === Auth::guard('etudiant')->user()->id_etudiant)
                                                            Vous: 
                                                        @else
                                                            {{ $otherParticipants->count() === 1 ? '' : $lastMessage->etudiant->prénom.':' }}
                                                        @endif
                                                        {{ Str::limit($lastMessage->content, 60) }}
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            @if($lastMessage)
                                                <span class="time-badge d-block">
                                                    {{ $lastMessage->created_at->diffForHumans() }}
                                                </span>
                                                @if($unread)
                                                    <span class="new-message-badge mt-1 d-block"></span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script pour le toggle du menu mobile
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>