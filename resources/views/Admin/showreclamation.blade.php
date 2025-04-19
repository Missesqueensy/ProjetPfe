
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
    <title>Détails de la Réclamation</title>
    <style>
        .card-header {
            border-radius: 0.375rem 0.375rem 0 0 !important;
        }
        .list-group-item {
            padding: 1rem 1.25rem;
        }
        .expediteur-info h6 {
            margin-bottom: 0.25rem;
        }
        .bg-light {
            background-color: #f8f9fa!important;
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
    
    

    <div class="main-content">
        <header>
            <div class="menu-toggle">
                <label for="">
                    <span class="las la-bars"></span>
                </label>
            </div>
        </header>

        <div class="container py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Détails de la Réclamation</h3>
                        <span class="badge bg-{{ $reclamation->statut === 'traité' ? 'success' : ($reclamation->statut === 'rejeté' ? 'danger' : 'warning') }}">
                            {{ strtoupper($reclamation->statut) }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">Informations Générales</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-bold">Type:</span>
                                    <span>
                                        @switch($reclamation->type)
                                            @case('prof_vers_etud') Professeur → Étudiant @break
                                            @case('etud_vers_prof') Étudiant → Professeur @break
                                            @default Étudiant → Étudiant
                                        @endswitch
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-bold">Date:</span>
                                    <span>{{ $reclamation->created_at?->format('d/m/Y H:i') ?? 'Date non disponible' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-bold">Admin assigné:</span>
                                    <span>{{ $reclamation->admin->name ?? 'Non assigné' }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <h5 class="text-primary">Parties impliquées</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span class="fw-bold">Expéditeur:</span>
                                    <div class="mt-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-circle fa-2x me-3 text-secondary"></i>
                                            <div>
                                                <h6 class="mb-0">{{ $reclamation->expediteur->nom ?? 'Expéditeur inconnu' }}</h6>
                                                <small class="text-muted">
                                                    @if($reclamation->expediteur)
                                                        {{ class_basename($reclamation->expediteur_type) }} • 
                                                        {{ $reclamation->expediteur->email ?? 'Email non disponible' }}
                                                    @else
                                                        Compte supprimé
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <span class="fw-bold">Destinataire:</span>
                                    <div class="mt-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-circle fa-2x me-3 text-secondary"></i>
                                            <div>
                                                <h6 class="mb-0">{{ $reclamation->destinataire->nom ?? 'N/A' }}</h6>
                                                @if($reclamation->destinataire)
                                                <small class="text-muted">
                                                    {{ class_basename($reclamation->destinataire_type) }} •
                                                    {{ $reclamation->destinataire->email ?? 'Email non disponible' }}
                                                </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-primary">Contenu de la réclamation</h5>
                        <div class="card">
                            <div class="card-body bg-light">
                                {!! nl2br(e($reclamation->contenu)) !!}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('admin.reclamations.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Retour à la liste
                        </a>

                        <div class="btn-group">
                            @if($reclamation->statut === 'en_attente')
                                <form action="{{ route('admin.reclamations.traiter', $reclamation) }}" method="POST" class="me-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check-circle me-2"></i> Marquer comme traité
                                    </button>
                                </form>

                                <form action="{{ route('admin.reclamations.rejeter', $reclamation) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-times-circle me-2"></i> Rejeter
                                    </button>
                                </form>
                            @endif

                            <button class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#responseModal">
                                <i class="fas fa-reply me-2"></i> Répondre
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal pour répondre -->
            <!-- Modal pour répondre -->
<div class="modal fade" id="responseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.reclamations.response', ['reclamation' => $reclamation->id]) }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Envoyer une réponse</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="reponse" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Envoyer la réponse</button>
                </div>
            </form>
        </div>
    </div>
</div>
                            @if($reclamation->reponse)
<div class="card mt-4 border-success">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">
            <i class="fas fa-reply me-2"></i> Réponse de l'administration
            <small class="float-end">{{ $reclamation->date_reponse->format('d/m/Y H:i') }}</small>
        </h5>
    </div>
    <div class="card-body">
        {!! nl2br(e($reclamation->reponse)) !!}
    </div>
    <div class="card-footer text-muted small">
        Répondu par : {{ $reclamation->admin->name }}
    </div>
</div>
@endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>