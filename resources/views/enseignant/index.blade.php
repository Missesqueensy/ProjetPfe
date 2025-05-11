<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant - Mes Cours</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta name="description" content="Gestion des cours pour enseignants">
    <meta property="og:title" content="Dashboard Enseignant">
    <meta property="og:description" content="Plateforme de gestion des cours pour enseignants">
<style>
    .badge bg-primary float-end{
        margin: 5px;
        margin-right: 2px;
    }
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
            <img src="{{ Auth::guard('enseignant')->user()->image ? asset('assets/img/user.jpeg'.Auth::guard('enseignant')->user()->image) : asset('assets/img/user.jpeg') }}" 
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
                    <a href="#">
                        <span class="las la-clipboard-list"></span>
                        Évaluations
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-check-circle"></span>
                     Résultats étudiants
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-chalkboard-teacher"></span>
                        Réclamations
                       </a>
                </li>
                <li>
                    <a href="">
                    <span class="las la-envelope"></span>
                      boîte e-mails
                    </a>
                </li>
                <li>
                <a href="{{ route('enseignant.logout') }}">
                <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
            <span class="las la-sign-out-alt"></span>
            Déconnexion
        </button>
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

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="las la-book"></i> Mes Cours</h1>
        <a href="{{ route('enseignant.courses.create') }}" class="btn btn-primary">
            <i class="las la-plus"></i> Créer un nouveau cours
        </a>
    </div>

    @if($courses->isEmpty())
        <div class="alert alert-info">
            Vous n'avez pas encore créé de cours. <a href="{{ route('enseignant.courses.create') }}">Commencez ici</a>.
        </div>
    @else
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                    <img src="{{ asset('assets/img/logo.jpg') }}" > 
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->titre }}</h5>
                            <p class="card-text text-muted small">
                                {{ Str::limit($course->description, 100) }}
                            </p>
                        </div>

                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between">
                                <a href="{{route('enseignant.courses.show', ['id_cours' => $course->id_cours]) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="las la-eye"></i> Voir
                                </a>
                                <a href="{{ route('enseignant.courses.edit', $course->id_cours) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="las la-edit"></i> Modifier
                                </a>
                                <form action="{{ route('enseignant.courses.destroy', $course->id_cours) }}" method="POST" class="ms-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours?')">
                                            <i class="las la-trash"></i> Supprimer
                                        </button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $courses->links() }}
        </div>
    @endif
</div>
    </div>
</div>

<script>
// Menu toggle
document.querySelector('.menu-toggle button').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('collapsed');
    document.querySelector('.main-content').classList.toggle('expanded');
});

// Confirmation suppression
document.querySelectorAll('.confirm-delete').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const form = this.closest('form');
        
        Swal.fire({
            title: 'Confirmer la suppression',
            text: "Êtes-vous sûr de vouloir supprimer ce cours ? Cette action est irréversible.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

// Filtre cours
document.getElementById('search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    document.querySelectorAll('.course-card').forEach(card => {
        const title = card.querySelector('.card-title').textContent.toLowerCase();
        const description = card.querySelector('.card-text').textContent.toLowerCase();
        card.style.display = (title.includes(searchTerm) || description.includes(searchTerm)) ? '' : 'none';
    });
});
</script>
</body>
</html>--> 
<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant - Mes Cours</title>
    
    <!-- CSS --
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    
    <!-- Meta pour le référencement et les réseaux sociaux --
    <meta name="description" content="Gestion des cours pour enseignants">
    <meta property="og:title" content="Dashboard Enseignant">
    <meta property="og:description" content="Plateforme de gestion des cours pour enseignants">

</head>

<body>

<div class="dashboard-container">
    <!-- Sidebar amélioré --
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
            <img src="{{ Auth::guard('enseignant')->user()->image ? asset('assets/img/user.jpeg'.Auth::guard('enseignant')->user()->image) : asset('assets/img/user.jpeg') }}" 
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
                        <span class="badge bg-primary float-end">{{ Auth::guard('enseignant')->user()->courses->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="las la-clipboard-list"></span>
                        Évaluations
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-check-circle"></span>
                     Résultats étudiants
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-chalkboard-teacher"></span>
                        Réclamations
                       </a>
                </li>
                <li>
                    <a href="">
                    <span class="las la-envelope"></span>
                      boîte e-mails
                    </a>
                </li>
                <li>
                <a href="{{ route('enseignant.logout') }}">
                <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
            <span class="las la-sign-out-alt"></span>
            Déconnexion
        </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Contenu principal --
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

        <main class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <span class="las la-book text-primary"></span> Mes Cours
                </h1>
                <div>
                    <a href="{{ route('enseignant.courses.create') }}" class="btn btn-primary">
                        <span class="las la-plus"></span> Nouveau cours
                    </a>
                </div>
            </div>

           

            <!-- Filtres et recherche --
            <div class="card mb-4">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="search" class="form-label">Rechercher</label>
                            <input type="text" class="form-control" id="search" placeholder="Titre, description...">
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-select" id="status">
                                <option value="">Tous</option>
                                <option value="public">Public</option>
                                <option value="private">Privé</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <span class="las la-filter"></span> Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Liste des cours --
            @if($courses->isEmpty())
                <div class="card">
                    <div class="card-body text-center py-5">
                        <span class="las la-book-open display-4 text-muted"></span>
                        <h3 class="h5 mt-3">Vous n'avez pas encore créé de cours</h3>
                        <p class="text-muted">Commencez par créer votre premier cours</p>
                        <a href="{{ route('enseignant.courses.create') }}" class="btn btn-primary">
                            <span class="las la-plus"></span> Créer un cours
                        </a>
                    </div>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($courses as $course)
                    <div class="col">
                        <div class="card h-100 shadow-sm course-card">
                            <!-- Image du cours --
                            <div class="course-image-container">
    @if($course->image)
        <img src="{{ asset('storage/'.$course->image) }}" class="card-img-top" alt="{{ $course->titre }}" loading="lazy">
    @else
        <img src="{{ asset('assets/img/logo.jpg') }}" class="card-img-top" alt="Image par défaut" loading="lazy">
    @endif
</div>
                        
                                
                                <!-- Badge statut --
                                <div class="course-badge">
                                    <span class="badge {{ $course->est_public ? 'bg-success' : 'bg-warning' }}">
                                        {{ $course->est_public ? 'Public' : 'Privé' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->titre }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($course->description, 120) }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <span class="las la-calendar"></span> 
                                        {{ $course->created_at ? $course->created_at->format('d/m/Y') : 'Date non disponible' }}
                                    </small>
                                    <small class="text-muted">
                                        <span class="las la-eye"></span> 
                                        {{ $course->views }} vues
                                    </small>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between">
                                    
                                    <a href="/enseignant/cours/{{ $course->id_cours }}">
                                    <div class="btn-group">
                                        <a href="{{ route('enseignant.courses.edit', $course->id_cours) }}" 
                                           class="btn btn-sm btn-outline-secondary">
                                            <span class="las la-edit"></span>
                                        </a>
                                        
                                        <form action="{{ route('enseignant.courses.destroy', $course->id_cours) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger confirm-delete">
                                                <span class="las la-trash"></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                
            @endif
        </main>
    </div>
</div>

<!-- JavaScript --
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Menu toggle
document.querySelector('.menu-toggle button').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('collapsed');
    document.querySelector('.main-content').classList.toggle('expanded');
});

// Confirmation suppression
document.querySelectorAll('.confirm-delete').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const form = this.closest('form');
        
        Swal.fire({
            title: 'Confirmer la suppression',
            text: "Êtes-vous sûr de vouloir supprimer ce cours ? Cette action est irréversible.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

// Filtre cours
document.getElementById('search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    document.querySelectorAll('.course-card').forEach(card => {
        const title = card.querySelector('.card-title').textContent.toLowerCase();
        const description = card.querySelector('.card-text').textContent.toLowerCase();
        card.style.display = (title.includes(searchTerm) || description.includes(searchTerm)) ? '' : 'none';
    });
});
</script>
</body>
</html>--> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant - Mes Cours</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    
    <!-- Meta pour le référencement et les réseaux sociaux -->
    <meta name="description" content="Gestion des cours pour enseignants">
    <meta property="og:title" content="Dashboard Enseignant">
    <meta property="og:description" content="Plateforme de gestion des cours pour enseignants">
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
                <li class="active">
                    <a href="{{ route('enseignant.courses.index') }}">
                        <span class="las la-book"></span>
                        Mes Cours
                       <!-- <span class="badge bg-primary float-end">{{ Auth::guard('enseignant')->user()->courses->count() }}</span>-->
                    </a>
                </li>
                <li>
                <a href="{{url('/enseignant/evaluations')}}">

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
                    <a href="{{ route ('Enseignant.emails') }}">
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

        <main class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <span class="las la-book text-primary"></span> Mes Cours
                </h1>
                <div>
                    <a href="{{ route('enseignant.courses.create') }}" class="btn btn-primary">
                        <span class="las la-plus"></span> Nouveau cours
                    </a>
                </div>
            </div>

            <!-- Filtres et recherche -->
            <div class="card mb-4">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="search" class="form-label">Rechercher</label>
                            <input type="text" class="form-control" id="search" placeholder="Titre, description...">
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-select" id="status">
                                <option value="">Tous</option>
                                <option value="public">Public</option>
                                <option value="private">Privé</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <span class="las la-filter"></span> Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Liste des cours -->
            @if($courses->isEmpty())
                <div class="card">
                    <div class="card-body text-center py-5">
                        <span class="las la-book-open display-4 text-muted"></span>
                        <h3 class="h5 mt-3">Vous n'avez pas encore créé de cours</h3>
                        <p class="text-muted">Commencez par créer votre premier cours</p>
                        <a href="{{ route('enseignant.courses.create') }}" class="btn btn-primary">
                            <span class="las la-plus"></span> Créer un cours
                        </a>
                    </div>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($courses as $course)
                        <div class="col">
                            <div class="card h-100 shadow-sm course-card">
                                <!-- Image du cours -->
                                
                                    <div class="course-image-container">
                                    <img src="{{   asset('assets/img/logo.jpg')}}"  
                                    class="card-img-top" 
                                         alt="{{ $course->image ? $course->titre : 'Image par défaut du cours' }}" 
                                         loading="lazy">
                            
                            
                                    <!-- Badge statut -->
                                    <div class="course-badge">
                                        <span class="badge {{ $course->est_public ? 'bg-success' : 'bg-warning' }}">
                                            {{ $course->est_public ? 'Privé' : 'Public' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    <h5 class="card-title">{{ $course->titre }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($course->description, 120) }}</p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <span class="las la-calendar"></span> 
                                            {{ $course->created_at ? $course->created_at->format('d/m/Y') : 'Date non disponible' }}
                                        </small>
                                        <small class="text-muted">
                                            <span class="las la-eye"></span> 
                                            {{ $course->views }} vues
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="card-footer bg-transparent border-top-0">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('enseignant.courses.show', $course->id_cours) }}" >
 
                                        Voir le cours
                                        </a>
                                        <div class="btn-group">
                                            <a href="{{ route('enseignant.courses.edit', $course->id_cours) }}" 
                                               class="btn btn-sm btn-outline-secondary">
                                                <span class="las la-edit"></span>
                                            </a>
                                            
                                            <form action="{{ route('enseignant.courses.destroy', $course->id_cours) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger confirm-delete">
                                                    <span class="las la-trash"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </main>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Menu toggle
    document.querySelector('.menu-toggle button').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('collapsed');
        document.querySelector('.main-content').classList.toggle('expanded');
    });

    // Confirmation suppression
    document.querySelectorAll('.confirm-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            
            Swal.fire({
                title: 'Confirmer la suppression',
                text: "Êtes-vous sûr de vouloir supprimer ce cours ? Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Filtre cours
    document.getElementById('search').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.course-card').forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const description = card.querySelector('.card-text').textContent.toLowerCase();
            card.style.display = (title.includes(searchTerm) || description.includes(searchTerm)) ? '' : 'none';
        });
    });
</script>
</body>
</html>
