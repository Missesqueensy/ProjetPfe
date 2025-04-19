<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Détails de l'Enseignant</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        .teacher-details {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .teacher-image {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: 1px solid #eee;
        }
    </style>
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
</div>
<div class="main-content">
        <header>
            <h1>Admin Dashboard</h1>
        </header>


    <div class="container">
        <div class="teacher-details">
            <h1 class="mb-4"><i class="las la-chalkboard-teacher"></i> Détails de l'Enseignant</h1>
            
            <div class="mb-4">
                <h3>Informations personnelles</h3>
                <p><strong>Nom:</strong> {{ $enseignant->nom }}</p>
                <p><strong>Prénom:</strong> {{ $enseignant->prenom }}</p>
                <p><strong>Email:</strong> {{ $enseignant->email }}</p>
            </div>
            
            <div class="mb-4">
                <h3>Informations professionnelles</h3>
                <p><strong>Département:</strong> {{ $enseignant->departement }}</p>
                <p><strong>Spécialité:</strong> {{ $enseignant->specialite }}</p>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('Admin.professeurs.indexprofesseur') }}" class="btn btn-outline-primary">
                    <i class="las la-arrow-left"></i> Retour à la liste
                </a>
                <div>
                    <!--<a href="{{ route('Admin.professeurs.editprofesseur', $enseignant->id_enseignant) }}" class="btn btn-outline-warning me-2">
                        <i class="las la-edit"></i> Modifier
                    </a>-->
                    <form action="{{ route('Admin.professeurs.destroyprofesseur', $enseignant->id_enseignant) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant?')">
                            <i class="las la-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>