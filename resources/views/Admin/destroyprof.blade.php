<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de suppression</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        .confirmation-card {
            max-width: 600px;
            margin: 2rem auto;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border: none;
        }
        .profile-header {
            background-color: #f8f9fa;
            border-radius: 10px 10px 0 0;
            padding: 1.5rem;
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
        <div class="container">
            <div class="card confirmation-card">
                <div class="profile-header text-center bg-light py-4">
                    <i class="las la-user-slash" style="font-size: 3rem; color: #dc3545;"></i>
                    <h2 class="h4 mt-3">Confirmation de suppression</h2>
                </div>
                
                <div class="card-body">
                    <div class="alert alert-danger">
                        <i class="las la-exclamation-triangle"></i> Cette action est irréversible
                    </div>

                    <div class="teacher-info mb-4">
                        <h3 class="h5">{{ $enseignant->prenom }} {{ $enseignant->nom }}</h3>
                        <ul class="list-unstyled">
                            <li><strong>Email :</strong> {{ $enseignant->email }}</li>
                            <li><strong>Spécialité :</strong> {{ $enseignant->specialite }}</li>
                            <li><strong>Département :</strong> {{ $enseignant->departement }}</li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('Admin.professeurs.indexprofesseur') }}" class="btn btn-outline-secondary">
                            <i class="las la-arrow-left"></i> Annuler
                        </a>
                        
                        <form action="{{ route('Admin.professeurs.destroyprofesseur', $enseignant->id_enseignant) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="las la-trash"></i> Confirmer la suppression
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script pour confirmation supplémentaire
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!confirm('Êtes-vous absolument sûr de vouloir supprimer définitivement ce professeur ?')) {
            e.preventDefault();
        }
    });
</script>
</body>
</html>