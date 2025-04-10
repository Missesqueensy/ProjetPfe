<!-- resources/views/Admin/courses/index.blade.php -->

<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
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

</div>
<div class="main-content">
    <header>
        <div class="menu-toggle">
            <label for="">
                <span class="las la-bars"></span>
            </label>
        </div>
</header>

    <!-- Contenu principal -
    <div class="main-content">
        <header>
            <h1>Détails du cours:</h1>
        </header>
        <div class="container">
            <h1>{{ $cours->titre }}</h1> <!-- Affiche le titre du cours -->
            <p>{{ $cours->description }}</p> <!-- Affiche la description du cours --

            <a href="{{ route('Admin.courses.index') }}">Retour aux cours</a>
        </div>
    </div>

</body>
</html>-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Détails du Cours</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        .course-details {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .course-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: 1px solid #eee;
        }
        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body> 
<div class="dashboard-container">

    <!-- Sidebar (identique à votre version originale) -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{asset('assets/img/logosvg.svg')}}" width="50px" alt="">
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
                <!-- Autres éléments du menu... -->
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
            <div class="course-details">
                <h1 class="mb-4"><i class="las la-book-open"></i> Détails du cours</h1>
                
                <!-- Affichage de l'image -->
                @if($cours->image)
                    <img src="{{ asset('storage/' . $cours->image) }}" alt="Image du cours {{ $cours->titre }}" class="course-image">
                @else
                    <div class="alert alert-info">Aucune image disponible pour ce cours</div>
                @endif

                <h2 class="mb-3">{{ $cours->titre }}</h2>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><i class="las la-align-left"></i> Description</h5>
                        <p class="card-text">{{ $cours->description }}</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('Admin.courses.index') }}" class="btn btn-outline-primary">
                        <i class="las la-arrow-left"></i> Retour à la liste
                    </a>
                    <div>
                        <a href="{{ route('Admin.courses.edit', $cours->id_cours) }}" class="btn btn-outline-secondary">
                            <i class="las la-edit"></i> Modifier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>