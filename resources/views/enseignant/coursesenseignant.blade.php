<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">

    <title>dashboard enseignant</title>
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
            <img src="{{asset('assets/img/user.jpeg')}}" height=50 width=50 alt="">
            <div>
                <h3>amal assim</h3>
                <span>aalassim@gmail.com.com</span>
            </div>
        </div>
        <div class="sidebar-menu">
             <div class="menu-head">
                <a href="{{url('/enseignant/dashboard')}}">Mon Profil</a>
             </div>
             <ul>
                <li>
                    <a href="{{url('/enseignant/cours')}}">
                        <span class="la la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li>
                    <a href="">
                    <span class="la la-wpforms"></span>
                      Evaluations
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
                
             </ul>
            </div>
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
                <a href="{{ route('Enseignant.courses.create') }}" class="btn btn-primary">
                    <i class="las la-plus"></i> Créer un Cours
                </a>
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

                            <h4 class="card-title">{{ $course->titre }}</h4>
                            <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('Enseignant.courses.show', $course->id_cours) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="las la-eye"></i> Détails
                                </a>
                                
                                <div class="action-buttons d-flex">
                                    <a href="{{ route('Enseignant.courses.edit', $course->id_cours) }}" 
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="las la-edit"></i> Modifier
                                    </a>
                                    
                                    <form action="{{ route('Enseignant.courses.destroy', $course->id_cours) }}" method="POST" class="ms-2">
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
</html>-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <title>Dashboard Enseignant - Mes Cours</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body> 
<div class="dashboard-container">
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{ asset('assets/img/logosvg.svg') }}" width="50px" alt="Logo">
                <div class="brand-icons">
                    <span class="las la-bell"></span>
                    <span class="las la-user-circle"></span>
                </div>
            </div>
        </div>
        <div class="sidebar-user">
            <img src="{{ asset('assets/img/user.jpeg') }}" height="50" width="50" alt="Photo de profil">
            <div>
                <span>{{ Auth::enseignant()->email }}</span>
            </div>
        </div>
        <div class="sidebar-menu">
            <div class="menu-head">
                <a href="{{ url('/enseignant/dashboard') }}">Mon Profil</a>
            </div>
            <ul>
                <li class="active">
                    <a href="{{ url('/enseignant/cours') }}">
                        <span class="la la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-wpforms"></span>
                        Evaluations
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-check-circle"></span>
                        Résultats étudiants
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-chalkboard-teacher"></span>
                        Réclamations
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="las la-envelope"></span>
                        Boîte e-mails
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="menu-toggle">
                <label>
                    <span class="las la-bars"></span>
                </label>
            </div>
        </header>

        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><span class="las la-book"></span> Mes Cours</h1>
                <div>
                <a href="{{ route('Enseignant.courses.create') }}" class="btn btn-primary">
                    <i class="las la-plus"></i> Créer un Cours
                </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($courses->isEmpty())
                <div class="alert alert-info">
                    Vous n'avez pas encore publié de cours.
                </div>
            @else
                <div class="row">
                    @foreach($courses as $course)
                    @if($course->id_enseignant == Auth::id())
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="course-card card h-100">
                            @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="{{ $course->titre }}" style="height: 150px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 150px;">
                                    <i class="las la-book-open text-white" style="font-size: 3rem;"></i>
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $course->titre }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('Enseignant.courses.show', $course->id_cours) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i> Détails
                                    </a>
                                    
                                    <div class="btn-group">
                                        <a href="{{ route('Enseignant.courses.edit', $course->id_cours) }}" 
                                           class="btn btn-sm btn-outline-secondary">
                                            <i class="las la-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('Enseignant.courses.destroy', $course->id_cours) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger delete-course">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script pour confirmer la suppression
    document.querySelectorAll('.delete-course').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer ce cours?')) {
                e.preventDefault();
            }
        });
    });

    // Script pour le menu toggle
    document.querySelector('.menu-toggle label').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('collapsed');
        document.querySelector('.main-content').classList.toggle('expanded');
    });
</script>
</body>
</html>