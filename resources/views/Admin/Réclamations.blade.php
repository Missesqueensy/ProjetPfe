<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Gestion des Réclamations</title>
    <style>
        .reclamation-card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            border-left: 4px solid transparent;
        }
        .reclamation-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .reclamation-card.etud_vers_etud {
            border-left-color: #4e73df;
        }
        .reclamation-card.etud_vers_prof {
            border-left-color: #1cc88a;
        }
        .reclamation-card.prof_vers_etud {
            border-left-color: #f6c23e;
        }
        .status-badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
        .user-badge {
            background-color: #f8f9fa;
            border-radius: 50px;
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
        }
        .user-badge i {
            margin-right: 0.5rem;
        }
        .content-preview {
            color: #6c757d;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Gestion des Réclamations</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des réclamations</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                                    aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="#">Exporter en PDF</a></li>
                                    <li><a class="dropdown-item" href="#">Filtrer</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach($reclamations as $reclamation)
                            <div class="card reclamation-card mb-3 {{ $reclamation->type }}">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <span class="badge status-badge bg-{{ 
                                                $reclamation->statut === 'traité' ? 'success' : 
                                                ($reclamation->statut === 'rejeté' ? 'danger' : 'warning') 
                                            }}">
                                                {{ ucfirst($reclamation->statut) }}
                                            </span>
                                            <small class="text-muted d-block mt-1">
                                                {{ $reclamation->created_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="user-badge">
                                                <i class="fas fa-user-circle"></i>
                                                <span>
                                                    {{ $reclamation->expediteur->nom ?? 'Utilisateur supprimé' }}
                                                    <small class="text-muted">
                                                        ({{ class_basename($reclamation->expediteur_type) }})
                                                    </small>
                                                </span>
                                            </div>
                                            <i class="fas fa-arrow-right mx-2 text-muted"></i>
                                            <div class="user-badge mt-2">
                                                <i class="fas fa-user-circle"></i>
                                                <span>
                                                    @if($reclamation->destinataire)
                                                        {{ $reclamation->destinataire->nom }}
                                                        <small class="text-muted">
                                                            ({{ class_basename($reclamation->destinataire_type) }})
                                                        </small>
                                                    @else
                                                        N/A
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="content-preview mb-0">
                                                {{ Str::limit($reclamation->contenu, 120) }}
                                            </p>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <a href="{{ route('admin.reclamations.show', $reclamation) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i> Détails
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            {{ $reclamations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Activer les tooltips Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
</body>
</html>