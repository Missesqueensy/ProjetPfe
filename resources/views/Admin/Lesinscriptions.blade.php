<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Tableau de bord - Gestion des inscriptions</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/logosvg.svg') }}" type="image/svg+xml">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
  <style>
    select.form-select{
        margin: 10px;
        padding: auto;
        font-size: small;
    }
    label.form-label{
        margin: 15px;
    margin-right: 10px;
    white-space: nowrap; 
}

    
    option.option{
        margin: 2px;
    }
    </style>
</head>
<body> 
<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{asset('assets/img/logosvg.svg')}}" width="50px" alt="Logo">
               <div class="brand-icons">
                <span class="las la-bell"></span>
                <span class="las la-user-circle"></span>
               </div>
            </div>
        </div>
        
        <div class="sidebar-user">
            <img src="{{asset('assets/img/carousel-1.jpg')}}" height=50 width=50 alt="Photo de profil">
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
                    <a href="{{url('AdminCours')}}" class="{{ request()->is('AdminCours') ? 'active' : '' }}">
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
                    <a href="{{url('/AdminForums')}}" class="{{ request()->is('AdminForums') ? 'active' : '' }}">
                    <span class="la la-wpforms"></span>
                      Forums
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminInscription')}}" class="{{ request()->is('AdminInscription') ? 'active' : '' }}">
                        <span class="la la-check-circle"></span>
                        Les inscriptions
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminProfesseurs')}}" class="{{ request()->is('AdminProfesseurs') ? 'active' : '' }}">
                        <span class="la la-chalkboard-teacher"></span>
                        Les professeurs
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminFormations')}}" class="{{ request()->is('AdminFormations') ? 'active' : '' }}">
                    <span class="la la-chalkboard"></span>
                      Les Formations 
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminMails')}}" class="{{ request()->is('AdminMails') ? 'active' : '' }}">
                    <span class="las la-envelope"></span>
                      Boîte e-mails
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
            <label>
                <span class="las la-bars"></span>
            </label>
        </div>
    </header>
        <main>
            <div class="page-header">
               <div>
                    <h1>Gestion des inscriptions</h1>
                    <small class="text-primary">Nouveaux inscrits</small>
               </div>
               <div class="header-actions">
                   <button class="btn btn-primary">
                       <i class="las la-file-export"></i> Exporter
                   </button>
               </div>
            </div>
            
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-black text-capitalize ps-3">
                                        <i class="las la-users me-2"></i> Liste des étudiants
                                    </h6>
                                </div>
                            </div>
                            
                            <div class="card-body px-0 pb-2">
                                <!-- Barre de recherche et filtres -->
                                <div class="row mx-3 mb-3 align-items-center">
                                    <div class="col-md-6 mb-2 mb-md-0">
                                        <form method="GET" action="{{ route('Admin.Lesinscriptions') }}" class="search-form">
                                            <div class="input-group input-group-outline">
                                                <span class="input-group-text">
                                                    <i class="las la-search"></i>
                                                </span>
                                                <input type="text" 
                                                       name="search" 
                                                       class="form-control" 
                                                       placeholder="Rechercher un étudiant..."
                                                       value="{{ request('search') }}">
                                                <button type="submit" class="btn btn-primary">
                                                    Rechercher
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <div class="col-md-4 mb-2 mb-md-0">
                                        <form method="GET" action="{{ route('Admin.Lesinscriptions') }}">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Filtrer</label>
                                                <select name="status" class="form-select" onchange="this.form.submit()">
                                                    <option class="option"value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Tous les étudiants</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <div class="col-md-2 text-md-end">
                                        <a href="#" class="btn btn-outline-primary btn-refresh">
                                            <i class="las la-sync-alt"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Tableau des étudiants -->
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">CNI</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date d'inscription</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end pe-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($etudiants as $etudiant)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                            <p class="text-xs text-secondary mb-0"> {{ $etudiant->CNI }}</p>
                                                        </div>
                                                        <!--<div class="d-flex flex-column justify-content-center">
                                                            <p class="text-xs text-secondary mb-0"> {{ $etudiant->nom }}</p>
                                                            <p class="text-xs text-secondary mb-0"> {{ $etudiant->prénom}}</p>

                                                        </div>-->
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        <a href="mailto:{{ $etudiant->email }}" class="text-dark">
                                                            {{ $etudiant->email }}
                                                        </a>
                                                    </p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold mb-0" data-bs-toggle="tooltip" title="{{ $etudiant->created_at->format('d/m/Y H:i') }}">
                                                        {{ $etudiant->created_at->format('d/m/Y') }}
                                                    </span>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $etudiant->created_at->diffForHumans() }}
                                                    </p>
                                                </td>
                                                
                                                <td class="align-middle text-end pe-3">
                                                    <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.etudiant.show', ['id_etudiant' => $etudiant->id_etudiant]) }}">
                                                        <i class="btn btn-info btn-sm me-1"
                                                           data-bs-toggle="tooltip" 
                                                           title="Voir le profil">
                                                            <i class="fas fa-eye"></i>
                                                        </i>
</a>
                                                        
                                                        
                                                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $etudiant->email }}" 
                                                           class="btn btn-warning btn-sm ms-1"
                                                          target="_blank"
                                                           data-bs-toggle="tooltip" 
                                                       title="Envoyer un email à {{ $etudiant->nom }} {{ $etudiant->prénom }}">
                                                      <i class="fas fa-envelope"></i>
                                                             </a>

                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <i class="las la-user-slash fs-1 text-muted mb-2"></i>
                                                        <span class="text-muted">Aucun étudiant trouvé</span>
                                                        <a href="{{ route('Admin.Lesinscriptions') }}" class="btn btn-sm btn-outline-primary mt-2">
                                                            Réinitialiser les filtres
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="px-4 pt-3 d-flex justify-content-between align-items-center">
                                    <div class="text-muted">
                                        Affichage de <b>{{ $etudiants->firstItem() }}</b> à <b>{{ $etudiants->lastItem() }}</b> sur <b>{{ $etudiants->total() }}</b> étudiants
                                    </div>
                                    <div>
                                        {{ $etudiants->links(('pagination::bootstrap-5')) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation des tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Toggle sidebar
        document.querySelector('.menu-toggle label').addEventListener('click', function() {
            document.querySelector('.dashboard-container').classList.toggle('sidebar-collapsed');
        });
        
        // Rafraîchissement de la page
        document.querySelector('.btn-refresh').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.reload();
        });
        
        // Gestion des erreurs d'image
        document.querySelectorAll('img').forEach(img => {
            img.onerror = function() {
                this.src = '{{ asset("assets/img/default-avatar.png") }}';
            };
        });
    });
</script>
</body>
</html>
    