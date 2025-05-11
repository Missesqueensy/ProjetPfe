 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Formulaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/logosvg.svg') }}" type="image/svg+xml">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fa;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }
        
        .formulaire-card {
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-color);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .formulaire-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .formulaire-header {
            padding: 1rem 1.25rem;
            background-color: var(--secondary-color);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .badge-type {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .badge-status {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .content-preview {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #6c757d;
            line-height: 1.6;
        }
        
        .author-badge {
            background-color: var(--secondary-color);
            border-radius: 50px;
            padding: 0.4rem 1rem;
            display: inline-flex;
            align-items: center;
            font-size: 0.9rem;
        }
        
        .formulaire-body {
            padding: 1.25rem;
        }
        
        .formulaire-footer {
            padding: 0.75rem 1.25rem;
            background-color: var(--secondary-color);
            border-top: 1px solid rgba(0,0,0,0.05);
        }
        
        .empty-state {
            background-color: var(--secondary-color);
            border-radius: 8px;
            padding: 3rem;
            text-align: center;
        }
        
        .empty-state i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .filter-bar {
            background-color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .pagination-wrapper {
            margin-top: 2rem;
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
            <div class="menu-toggle">
                <label for="">
                    <span class="las la-bars"></span>
                </label>
            </div>
        </header>


        <div class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Tous les formulaires</h1>
                    <small class="text-muted">Gestion des questions et explications</small>
                </div>
                <div class="d-flex">
                    <div class="dropdown me-2">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-filter me-1"></i> Filtrer
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tous</a></li>
                            <li><a class="dropdown-item" href="#">Questions</a></li>
                            <li><a class="dropdown-item" href="#">Explications</a></li>
                        </ul>
                    </div>
                    <div class="input-group" style="width: 250px;">
                        <input type="text" class="form-control" placeholder="Rechercher...">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Barre de filtres -->
            <div class="filter-bar mb-4">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <small class="text-muted d-block">Statut</small>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-outline-secondary active">Tous</button>
                            <button type="button" class="btn btn-outline-secondary">Publiés</button>
                            <button type="button" class="btn btn-outline-secondary">En attente</button>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <small class="text-muted d-block">Type</small>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-outline-secondary active">Tous</button>
                            <button type="button" class="btn btn-outline-secondary">Questions</button>
                            <button type="button" class="btn btn-outline-secondary">Explications</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Tri</small>
                        <select class="form-select form-select-sm">
                            <option>Plus récents</option>
                            <option>Plus anciens</option>
                            <option>Plus de vues</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($formulaires as $formulaire)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card formulaire-card h-100">
                        <div class="formulaire-header">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="badge badge-type mb-2">
                                        {{ ucfirst($formulaire->type) }}
                                    </span>
                                    <h5 class="mb-0">{{ Str::limit($formulaire->titre, 50) }}</h5>
                                </div>
                                <span class="badge bg-{{ 
                                    $formulaire->statut === 'publié' ? 'success' : 
                                    ($formulaire->statut === 'en attente' ? 'warning' : 'secondary') 
                                }} badge-status">
                                    {{ ucfirst($formulaire->statut) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="formulaire-body">
                            <div class="author-badge mb-3">
                                <i class="fas fa-user-circle"></i>
                                <span>{{ $formulaire->etudiant->nom_complet ?? 'Anonyme' }}</span>
                                <small class="text-muted ms-2">{{ $formulaire->created_at->diffForHumans() }}</small>
                            </div>

                            <div class="content-preview mb-3">
                                {!! Str::markdown(Str::limit($formulaire->contenu, 150)) !!}
                            </div>
                        </div>
                        
                        <div class="formulaire-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <span class="badge bg-light text-dark me-2">
                                        <i class="fas fa-eye me-1"></i> {{ $formulaire->vues ?? 0 }}
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-comment me-1"></i> {{ $formulaire->commentaires_count ?? 0 }}
                                    </span>
                                </div>
                                <a href="{{ route('admin.Unformulaire.show', $formulaire->id_formulaire) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Voir plus <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h4>Aucun formulaire trouvé</h4>
                        <p class="text-muted">Aucun formulaire n'a été publié pour le moment.</p>
                        <button class="btn btn-primary mt-2">
                            <i class="fas fa-sync-alt me-1"></i> Rafraîchir
                        </button>
                    </div>
                </div>
                @endforelse
            </div>

            @if($formulaires->hasPages())
            <div class="pagination-wrapper">
                <nav aria-label="Page navigation">
                    {{ $formulaires->links() }}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Activer les tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Gestion des filtres
        document.querySelectorAll('.filter-bar .btn-group .btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.parentElement.querySelector('.active').classList.remove('active');
                this.classList.add('active');
            });
        });
    });
</script>
</body>
</html>
<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Gestion des Formulaires</title>
    <style>
        .formulaire-card {
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            border-left: 4px solid #4e73df;
        }
        .formulaire-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .formulaire-header {
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding-bottom: 0.75rem;
            margin-bottom: 1rem;
        }
        .badge-type {
            background-color: #4e73df;
            color: white;
        }
        .badge-status {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
        .content-preview {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #6c757d;
        }
        .author-badge {
            background-color: #f8f9fa;
            border-radius: 50px;
            padding: 0.25rem 0.75rem;
            display: inline-flex;
            align-items: center;
        }
        .author-badge i {
            margin-right: 0.5rem;
            color: #4e73df;
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

    <div class="main-content">
        <header>
            <div class="menu-toggle">
                <label for="">
                    <span class="las la-bars"></span>
                </label>
            </div>
        </header>

        <div class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Tous les formulaires</h1>
                    <small class="text-muted">Nouveaux formulaires</small>
                </div>
                <div>
                    
                </div>
            </div>

            <div class="row">
                @forelse($formulaires as $formulaire)
                <div class="col-md-6 col-lg-4">
                    <div class="card formulaire-card">
                        <div class="card-body">
                            <div class="formulaire-header d-flex justify-content-between">
                                <div>
                                    <span class="badge badge-type mb-2">
                                        {{ $formulaire->type_sujet ?? 'Question' }}
                                    </span>
                                    <h5 class="mb-0">{{ $formulaire->titre }}</h5>
                                </div>
                                <span class="badge bg-{{ 
                                    $formulaire->statut === 'publiée' ? 'success' : 
                                    ($formulaire->statut === 'en attente' ? 'warning' : 'secondary') 
                                }} badge-status">
                                    {{ ucfirst($formulaire->statut) }}
                                </span>
                            </div>

                            <div class="author-badge mb-3">
                                <i class="fas fa-user-circle"></i>
                                <span>{{ $formulaire->etudiant->nom ?? 'Anonyme' }}</span>
                               
                            </div>

                            <div class="content-preview mb-3">
                                {{ $formulaire->contenu }}
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">
                                        <i class="fas fa-eye me-1"></i> {{ $formulaire->vue }} vues
                                    </small>
                                </div>
                                <a href="{{ url('/admin/formulaires/'.$formulaire->id) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-arrow-right me-1"></i> Voir plus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> Aucun formulaire n'a encore été publié.
                    </div>
                </div>
                @endforelse
            </div>

            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>-->