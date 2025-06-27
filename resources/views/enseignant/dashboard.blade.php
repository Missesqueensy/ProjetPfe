<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title style="color:#c433ff;">Profil Enseignant - {{ Auth::guard('enseignant')->user()->prenom }} {{ Auth::guard('enseignant')->user()->nom }}</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta name="description" content="Page de profil de l'enseignant">
    <meta property="og:title" content="Profil Enseignant">
    <meta property="og:description" content="Page de gestion du profil pour enseignants">
</head>
    

<body>

<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{ asset('assets/img/logosvg.svg') }}" width="50" alt="Logo de l'établissement" loading="lazy">
                <div class="brand-icons">
                    <span class="las la-user-circle"></span>
                </div>
            </div>
        </div>
        
        <div class="sidebar-user">
            <img src="{{ Auth::guard('enseignant')->user()->image ? asset('storage/images/' . Auth::guard('enseignant')->user()->image) : asset('assets/img/user1.jpeg') }}" 
                 width="50" height="50" alt="Photo de profil" class="rounded-circle" loading="lazy">
            <div>
                <span>{{ Auth::guard('enseignant')->user()->prenom }} {{ Auth::guard('enseignant')->user()->nom }}</span>
                <small class="text-muted d-block">{{ Auth::guard('enseignant')->user()->email }}</small>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <ul>
                <li class="active">
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
                <li>
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
                    <a href="{{route('Enseignant.emails')}}">
                    <span class="las la-envelope"></span>
                      boîte e-mails
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
            <div class="container-fluid py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="menu-toggle">
                        <button class="btn btn-outline-secondary">
                            <span class="las la-bars"></span>
                        </button>
                    </div>
                                <div class="header-content">
                    <!--<span class="me-1 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span> -->
                                    <span class="username-display">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span> 
                                </div>
                </div>
            </div>
        </header>
            <!--<div class="row justify-content-center">-->
                    <div class="container-fluid px-4 py-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3>Profil de {{ Auth::guard('enseignant')->user()->prenom }} {{ Auth::guard('enseignant')->user()->nom }}</h3>
                        </div>

                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <img src="{{ Auth::guard('enseignant')->user()->image ? asset('storage/images/' . Auth::guard('enseignant')->user()->image) : asset('assets/img/user.jpeg') }}" 
                                             alt="Photo de Profil" class="rounded-circle" width="150">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h4>{{ Auth::guard('enseignant')->user()->prenom }} {{ Auth::guard('enseignant')->user()->nom }}</h4>
                                    <p class="text-muted">{{ Auth::guard('enseignant')->user()->specialite }}</p>
                                    <p><i class="las la-building"></i> Département : {{ Auth::guard('enseignant')->user()->departement }}</p>
                                    <p><i class="las la-envelope"></i> Email : {{ Auth::guard('enseignant')->user()->email }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6>Cours Assignés</h6>
                                            <h4 class="text-primary">{{ Auth::guard('enseignant')->user()->courses->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6>Réclamations envoyées</h6>
                                            <h4 class="text-warning">{{ Auth::guard('enseignant')->user()->reclamationsEnvoyees->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5>Modifier Profil</h5>
                                <form action="{{ route('enseignant.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="nom" name="nom" value="{{ Auth::guard('enseignant')->user()->nom }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="prenom" class="form-label">Prénom</label>
                                                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ Auth::guard('enseignant')->user()->prenom }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::guard('enseignant')->user()->email }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="specialite" class="form-label">Spécialité</label>
                                                <input type="text" class="form-control" id="specialite" name="specialite" value="{{ Auth::guard('enseignant')->user()->specialite }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="departement" class="form-label">Département</label>
                                                <input type="text" class="form-control" id="departement" name="departement" value="{{ Auth::guard('enseignant')->user()->departement }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Photo de profil</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Laissez vide pour ne pas changer">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script pour le toggle du sidebar
    document.querySelector('.menu-toggle button').addEventListener('click', function() {
        document.querySelector('.dashboard-container').classList.toggle('sidebar-collapsed');
    });
</script>

</body>
</html>