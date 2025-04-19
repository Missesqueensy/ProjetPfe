<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">

    <title>Admin Dashboard Panel</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/fr.js"></script>

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
             <div class="menu-toggle">
                <label for="">
                    <span class="las la-bars"></span>
                        </label>
             </div>
        <div class="header-icons">
                <span class="las la-search"></span>
                <span class="las la-bookmark"></span>
                <span class="las la-sms"></span>
            </div>
        </header>
        <div class="formulaire-detail">
        <h1>{{ $formulaire->titre }}</h1>
        <p><strong>Contenu :</strong></p>
        <p>{{ $formulaire->contenu }}</p>
        <p><strong>Publié par :</strong> {{ $formulaire->etudiant->nom ?? 'Inconnu' }}</p>
        <p><strong>Date de publication :</strong> {{ $formulaire->date_publication }}</p>
        <p><strong>Statut :</strong> {{ $formulaire->statut }}</p>
        <p><strong>Type de sujet :</strong> {{ $formulaire->type_sujet ?? 'Non spécifié' }}</p>

        @if($formulaire->image)
            <img src="{{ asset('storage/' . $formulaire->image) }}" alt="Image" width="100%">
        @endif
    </div>

    <!-- Afficher les autres formulaires publiés --
    <h2>Autres formulaires publiés</h2>
    <ul class="autres-formulaires">
        @foreach($formulaires as $f)
            <li>
                <a href="{{ route('formulaires.show', $f->id) }}">
                    {{ $f->titre }} - <strong>{{ $f->etudiant->nom ?? 'Inconnu' }}</strong>
                </a>
            </li>
        @endforeach
    </ul>
</div>

</body>
</html>--> 
<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaires étudiants | Admin Dashboard</title>
    
    <!-- Bootstrap CSS --
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Line Awesome --
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Votre CSS personnalisé --
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
</head>
<body>
<div class="dashboard-container">
    <!-- Sidebar (identique à votre version) --
    <div class="sidebar">
        <!-- ... Votre code sidebar existant ... --
    </div>

    <!-- Main Content Area --
    <div class="main-content">
        <header>
            <!-- ... Votre header existant ... --
        </header>

        <main class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Tous les formulaires</h1>
                <div class="d-flex gap-2">
                    <div class="input-group" style="width: 250px;">
                        <span class="input-group-text bg-white"><i class="las la-search"></i></span>
                        <input type="text" class="form-control" placeholder="Rechercher...">
                    </div>
                    <button class="btn btn-outline-secondary">
                        <i class="las la-filter"></i> Filtrer
                    </button>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <!-- Grille Bootstrap pour les formulaires --
                    <div class="row g-4">
                        @foreach($formulaires as $formulaire)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <small class="text-muted">
                                            <i class="las la-user-circle"></i> {{ $formulaire->etudiant->nom ?? 'Inconnu' }}
                                        </small>
                                        <small class="text-muted">
                                            {{ $formulaire->date_publication->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-{{ $formulaire->statut == 'publiée' ? 'success' : ($formulaire->statut == 'en attente' ? 'warning' : 'danger') }}-subtle text-{{ $formulaire->statut == 'publiée' ? 'success' : ($formulaire->statut == 'en attente' ? 'warning' : 'danger') }}">
                                            {{ $formulaire->statut }}
                                        </span>
                                        <small class="text-muted">{{ $formulaire->type_sujet ?? 'Non spécifié' }}</small>
                                    </div>
                                    
                                    <h5 class="card-title">{{ $formulaire->titre }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($formulaire->contenu, 120) }}</p>
                                </div>
                                
                                <div class="card-footer bg-transparent border-top d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted me-3"><i class="las la-eye"></i> {{ $formulaire->nombre_vues ?? 0 }}</small>
                                        @if($formulaire->reponses_count)
                                        <small class="text-muted"><i class="las la-comment"></i> {{ $formulaire->reponses_count }}</small>
                                        @endif
                                    </div>
                                    <a href="{{ route('formulaires.show', $formulaire->id) }}" class="btn btn-sm btn-outline-primary">
                                        Voir plus <i class="las la-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination Bootstrap --
                    <div class="d-flex justify-content-center mt-4">
                        <nav>
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Suivant</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper --
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Style personnalisé pour intégrer avec votre sidebar --
<style>
    .dashboard-container {
        display: flex;
        min-height: 100vh;
    }
    
    .sidebar {
        width: 250px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        /* ... Vos styles sidebar existants ... */
    }
    
    .main-content {
        flex: 1;
        background-color: #f8f9fa;
        padding: 20px;
    }
    
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .transition-all {
        transition: all 0.2s ease;
    }
    
    /* Adaptation pour mobile */
    @media (max-width: 768px) {
        .dashboard-container {
            flex-direction: column;
        }
        
        .sidebar {
            width: 100%;
        }
        
        .main-content {
            padding: 15px;
        }
        
        .d-flex.justify-content-between.align-items-center.mb-4 {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .input-group {
            width: 100% !important;
        }
    }
</style>
</body>
</html>--> 
<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du formulaire | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
</head>
<body>
<div class="dashboard-container">
    
    <div class="main-content">
        <header class="bg-white py-3 shadow-sm mb-4">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0">Détails du formulaire</h1>
                <a href="{{ url('/AdminForums') }}" class="btn btn-sm btn-secondary">
                    <i class="las la-arrow-left"></i> Retour
                </a>
            </div>
        </header>

        <main class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">{{ $formulaire->titre }}</h3>
                    <div class="d-flex justify-content-between text-muted mb-3">
                        <small><i class="las la-user"></i> Publié par : <strong>{{ $formulaire->etudiant->nom ?? 'Inconnu' }}</strong></small>
                        <small><i class="las la-calendar"></i> {{ $formulaire->date_publication->format('d/m/Y H:i') }}</small>
                    </div>

                    <div class="mb-3">
                        <span class="badge bg-{{ $formulaire->statut == 'publiée' ? 'success' : ($formulaire->statut == 'en attente' ? 'warning' : 'danger') }}">
                            {{ ucfirst($formulaire->statut) }}
                        </span>
                        <span class="ms-2 badge bg-info text-dark">{{ $formulaire->type_sujet ?? 'Type non spécifié' }}</span>
                    </div>

                    <div class="mb-3">
                        <p><strong>Nombre de vues :</strong> {{ $formulaire->vue ?? 0 }}</p>
                        <p><strong>Commentaires :</strong> {{ $formulaire->nombre_commentaires ?? 0 }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Contenu :</h5>
                        <p class="text-justify">{{ $formulaire->contenu }}</p>
                    </div>

                    @if($formulaire->image)
                    <div class="mb-4">
                        <h6>Image jointe :</h6>
                        <img src="{{ asset('storage/' . $formulaire->image) }}" class="img-fluid rounded border" alt="Image du formulaire">
                    </div>
                    @endif
                    @if($formulaire->moderation_commentaire)
                    <div class="alert alert-warning">
                        <strong>Modération :</strong> {{ $formulaire->moderation_commentaire }}
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>

<!-- JS --
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
