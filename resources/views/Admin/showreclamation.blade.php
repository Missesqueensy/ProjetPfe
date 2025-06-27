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
    <title>Détails de la Réclamation #{{ $reclamation->id }}</title>
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
        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }
        .user-details {
            flex: 1;
        }
        .badge {
            font-size: 0.9rem;
            padding: 0.5em 0.75em;
        }
        .content-box {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 1rem;
            border-radius: 0.25rem;
            margin-bottom: 1rem;
        }
        .timeline {
            position: relative;
            padding-left: 1.5rem;
        }
        .timeline:before {
            content: '';
            position: absolute;
            left: 7px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }
        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }
        .timeline-item:last-child {
            padding-bottom: 0;
        }
        .timeline-dot {
            position: absolute;
            left: 0;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #0d6efd;
        }
        .response-form textarea {
            min-height: 150px;
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
                <span>{{ Auth::guard('admin')->user()->prenom }} {{ Auth::guard('admin')->user()->nom }}</span>
                <small class="text-muted d-block">{{ Auth::guard('admin')->user()->email }}</small>
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
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Détails de la Réclamation #{{ $reclamation->id }}</h5>
                    <div>
                        <span class="badge bg-{{ $reclamation->statut == 'en_attente' ? 'warning' : ($reclamation->statut == 'traité' ? 'success' : 'danger') }} text-dark me-2">
                            {{ ucfirst($reclamation->statut) }}
                        </span>
                        <span class="badge bg-info">
                            {{ $reclamation->typeToString() }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Timeline de la réclamation -->
                    <div class="timeline mb-5">
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="ps-4">
                                <h6>Création de la réclamation</h6>
                                <small class="text-muted">{{ $reclamation->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
                        
                        @if($reclamation->date_reponse)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="ps-4">
                                <h6>Réponse administrateur</h6>
                                <small class="text-muted">{{ $reclamation->date_reponse->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Expéditeur et Destinataire -->
                    <div class="row mb-4">
                        <!-- Expéditeur -->
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Expéditeur</h6>
                                </div>
                                <div class="card-body d-flex align-items-center">
                                    @if($reclamation->expediteur)
                                        <img src="{{ asset('assets/img/user-avatar.png') }}" class="user-avatar" alt="Avatar">
                                        <div class="user-details">
                                            <h5>{{ $reclamation->expediteur->nom ?? 'Utilisateur supprimé' }}</h5>
                                            <p class="mb-1 text-muted">{{ $reclamation->expediteur->email ?? 'N/A' }}</p>
                                            <small class="badge bg-secondary">{{ class_basename($reclamation->expediteur_type) }}</small>
                                        </div>
                                    @else
                                        <div class="text-muted w-100 text-center py-3">
                                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                                            <p>Expéditeur supprimé</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Destinataire -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Destinataire</h6>
                                </div>
                                <div class="card-body d-flex align-items-center">
                                    @if($reclamation->destinataire)
                                        <img src="{{ asset('assets/img/user-avatar.png') }}" class="user-avatar" alt="Avatar">
                                        <div class="user-details">
                                            <h5>{{ $reclamation->destinataire->nom ?? 'Utilisateur supprimé' }}</h5>
                                            <p class="mb-1 text-muted">{{ $reclamation->destinataire->email ?? 'N/A' }}</p>
                                            <small class="badge bg-secondary">{{ class_basename($reclamation->destinataire_type) }}</small>
                                        </div>
                                    @else
                                        <div class="text-muted w-100 text-center py-3">
                                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                                            <p>Destinataire supprimé</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="card mb-4">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Contenu de la réclamation</h6>
                            <small class="text-muted">Créée le {{ $reclamation->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                        <div class="card-body">
                            <div class="content-box">
                                {!! nl2br(e($reclamation->contenu)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Réponse -->
                    @if($reclamation->reponse)
                        <div class="card mb-4 border-success">
                            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Réponse administrateur</h6>
                                <small>
                                    @if($reclamation->admin)
                                        Traitée par {{ $reclamation->admin->name }}
                                    @endif
                                </small>
                            </div>
                            <div class="card-body">
                                <div class="content-box">
                                    {!! nl2br(e($reclamation->reponse)) !!}
                                </div>
                                <small class="text-muted d-block mt-2">
                                    Répondu le {{ $reclamation->date_reponse->format('d/m/Y H:i') }}
                                </small>
                            </div>
                        </div>
                    @endif

                    <!-- Formulaire de réponse -->
                    @if($reclamation->statut == 'en_attente')
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0"><i class="fas fa-reply me-2"></i>Répondre à la réclamation</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.reclamations.response.form', $reclamation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Statut</label>
                                            <select name="statut" class="form-select" required>
                                                <option value="">Sélectionner...</option>
                                                <option value="traité">Traité</option>
                                                <option value="rejeté">Rejeté</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label">Notification</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="notify" id="notify" checked>
                                                <label class="form-check-label" for="notify">Envoyer une notification par email</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Réponse détaillée</label>
                                        <textarea name="reponse" class="form-control response-form" rows="5" placeholder="Rédigez votre réponse ici..." required></textarea>
                                    </div>
                                    
                                    <div class="d-flex justify-content-end">
                                       <form method="POST" class="btn btn-success me-2" action="{{ route('admin.reclamations.store') }}" style="display: inline;">
                                            @csrf
                                      <button type="submit">Enregistrer</button>
                                            </form>
                                        <a href="{{ route('admin.reclamations.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-1"></i> Annuler
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="card-footer bg-light d-flex justify-content-between">
                    <a href="{{ route('admin.reclamations.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-1"></i> Retour à la liste
                    </a>
                    
                    @if($reclamation->statut != 'en_attente')
                        <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#emailModal">
                            <i class="fas fa-paper-plane me-1"></i> Renvoyer la réponse
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour renvoyer la réponse -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Renvoyer la réponse</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--<form action="{{ route('admin.reclamations.response', $reclamation->id) }}" method="POST">--> 
                <form method="POST" action="{{ route('admin.reclamations.response', $reclamation) }}">
                @csrf
                <div class="modal-body">
                    <p>Confirmez-vous l'envoi de cette réponse par email à l'expéditeur ?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="includeAttachment" name="include_attachment" checked>
                        <label class="form-check-label" for="includeAttachment">
                            Inclure les pièces jointes (si disponibles)
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Confirmer l'envoi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script pour améliorer l'expérience utilisateur
    document.addEventListener('DOMContentLoaded', function() {
        // Focus sur le textarea du formulaire de réponse
        const textarea = document.querySelector('.response-form textarea');
        if (textarea) {
            textarea.focus();
        }
        
        // Gestion des notifications toast (si vous en ajoutez)
        const toastElList = [].slice.call(document.querySelectorAll('.toast'));
        toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl).show();
        });
    });
</script>
</body>
</html>