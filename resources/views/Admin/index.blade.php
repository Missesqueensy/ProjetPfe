<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Admin Dashboard Panel</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body> 
<div class="dashboard-container">

    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{asset('assets/img/logosvg.svg')}}" width="50px"alt="">
               <div class="brand-icons">
                <span class="las la-beli"> </span>
                <span class="las la-user-circle"></span>
               </div>
            </div>
        </div>
        <div class="sidebar-user">
            <img src="{{asset('assets/img/carousel-1.jpg')}}" height=50 width=50 alt="">
            <div>
                <h3>AHLAME LAD</h3>
                <span>Ladahlame@admin.com</span>
            </div>
        </div>
        <div class="sidebar-menu">
             <div class="menu-head">
                <span>Dashboard</span>
             </div>
             <ul>
                <li>
                    <a href="{{url('AdminCours')}}">
                        <span class="la la-book"></span>
                        Les Cours
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminAnalyses')}}">
                    <span class="las la-chart-pie"></span>
                      Analyses
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminCalendrier')}}">
                        <span class="las la-calendar"></span>
                        calendrier
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminForums')}}">
                    <span class="la la-wpforms"></span>
                      Forums
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminInscription')}}">
                        <span class="la la-check-circle"></span>
                        Les inscriptions
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminProfesseurs')}}">
                        <span class="la la-chalkboard-teacher"></span>
                        Les professeurs
                       </a>
                </li>
                <li>
                    <a href="{{url('/AdminFormations')}}">
                    <span class="la la-chalkboard"></span>
                      les Formations 
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminMails')}}">
                    <span class="las la-envelope"></span>
                      boîte e-mails
                    </a>
                </li>
             </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
             <div class="menu-toggle">
                <label for="">
                    <span class="las la-bars"></span>
                </label>
             </div>
        </header>

        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Tous les Cours</h1>
                <a href="{{ route('Admin.courses.create') }}" class="btn btn-primary">
                    <i class="las la-plus"></i> Créer un Cours
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($courses as $cours)
                            <div class="col-md-6 mb-4">
                                <div class="course-card p-3 border rounded">

    <div class="course-image mb-3">
        <img src="{{ $cours->image ? asset('storage/'.$cours->image) : asset('img/logo.jpg') }}" 
             alt="{{ $cours->titre }}"
             class="img-fluid rounded"
             style="max-height: 200px; width: auto;">
    </div>

                                    <h4 class="course-title">{{ $cours->titre }}</h4>
                                    <p class="course-description text-muted">{{ $cours->description }}</p>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <a href="{{ route('Admin.courses.show', $cours->id_cours) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="las la-eye"></i> Voir les détails
                                        </a>
                                        
                                        <div class="action-buttons">
                                            <a href="{{ route('Admin.courses.edit', $cours->id_cours) }}" class="btn btn-sm btn-outline-secondary">
                                                <i class="las la-edit"></i> Modifier
                                            </a>
                                            
                                            <form action="{{ route('admin.courses.destroy', $cours->id_cours) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours?')">
                                                    <i class="las la-trash"></i> Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Cours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        .course-img {
            height: 200px;
            object-fit: cover;
            width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .course-card {
            transition: all 0.3s ease;
            height: 100%;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .action-buttons .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{asset('assets/img/logosvg.svg')}}" width="50px"alt="">
               <div class="brand-icons">
                <span class="las la-beli"> </span>
                <span class="las la-user-circle"></span>
               </div>
            </div>
        </div>
        <div class="sidebar-user">
            <img src="{{asset('assets/img/carousel-1.jpg')}}" height=50 width=50 alt="">
            <div>
                <h3>AHLAME LAD</h3>
                <span>Ladahlame@admin.com</span>
            </div>
        </div>
        <div class="sidebar-menu">
             <div class="menu-head">
                <span>Dashboard</span>
             </div>
             <ul>
                <li>
                    <a href="{{url('AdminCours')}}">
                        <span class="la la-book"></span>
                        Les Cours
                    </a>
                </li>
                <li>
                <a href="{{url('adminAnalyses')}}">

                    <span class="las la-chart-pie"></span>
                      Réclamations
                    </a>
                </li>
               
                <li>
                    <a href="{{url('/AdminForums')}}">
                    <span class="la la-wpforms"></span>
                      Forums
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminInscription')}}">
                        <span class="la la-check-circle"></span>
                        Les inscriptions
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminProfesseurs')}}">
                        <span class="la la-chalkboard-teacher"></span>
                        Les professeurs
                       </a>
                </li>
                <li>
                    <a href="{{url('/AdminFormations')}}">
                    <span class="la la-chalkboard"></span>
                      les Formations 
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminMails')}}">
                    <span class="las la-envelope"></span>
                      boîte e-mails
                    </a>
                </li>
                <li>
    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST">
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
        <header>
             <div class="menu-toggle">
                <label for="">
                    <span class="las la-bars"></span>
                </label>
             </div>
        </header>

        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Tous les Cours</h1>
                <!--<a href="{{ route('Admin.courses.create') }}" class="btn btn-primary">
                    <i class="las la-plus"></i> Créer un Cours
                </a>-->
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                @foreach($courses as $course)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="course-card card h-100">
                        <div class="card-body">
                            
                           
                            @php
    $fallback = asset('assets/img/logo.jpg');
@endphp

<!--<img src="{{ asset('storage/' . $cours->image) }}"-->
<img src="{{ asset('assets/img/' . $cours->image) }}"
alt="{{ $cours->titre }}"
     class="course-img"
     onerror="this.onerror=null; this.src='{{ $fallback }}';">


                            <h4 class="card-title">{{ $course->titre }}</h4>
                            <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>

                            <!-- Section Enseignant -->
                <div class="enseignant-info mb-3">
                    <div class="d-flex align-items-center">
                        <!-- Photo de profil de l'enseignant -->
                        <div class="me-2">
                            <img src="{{ asset($course->enseignant->photo ?? 'assets/img/user.jpeg') }}" 
                                 alt="{{ $course->enseignant->nom ?? 'Enseignant' }}"
                                 class="rounded-circle"
                                 width="40"
                                 height="40"
                                 style="object-fit: cover;">
                        </div>
                        <!-- Nom de l'enseignant -->
                        <div>
                            <small class="text-muted">Publié par :</small>
                            <p class="mb-0 fw-bold">
                                {{ $course->enseignant->nom ?? 'Auteur inconnu' }} 
                                {{ $course->enseignant->prenom ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('Admin.courses.show', $course->id_cours) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="las la-eye"></i> Détails
                                </a>
                                
                                <div class="action-buttons d-flex">
                                    <a href="{{ route('Admin.courses.edit', $course->id_cours) }}" 
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="las la-edit"></i> Modifier
                                    </a>
                                    
                                    <form action="{{ route('admin.courses.destroy', $course->id_cours) }}" method="POST" class="ms-2">
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
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
