

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



<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5>Détails de la Réclamation #{{ $reclamation->id }}</h5>
        </div>
        
        <div class="card-body">
            <!-- Statut et Type -->
            <div class="mb-4">
                <span class="badge badge-{{ $reclamation->statut == 'en_attente' ? 'warning' : ($reclamation->statut == 'traité' ? 'success' : 'danger') }}">
                    {{ ucfirst(str_replace('_', ' ', $reclamation->statut)) }}
                </span>
                <span class="badge badge-info ml-2">
                    {{ $reclamation->typeToString() }}
                </span>
            </div>

            <!-- Expéditeur et Destinataire -->
            <div class="row mb-4">
                <!-- Expéditeur -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6>Expéditeur</h6>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Destinataire -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6>Destinataire</h6>
                        </div>
                        <div class="card-body">
                            @if($reclamation->destinataire)
                                @include('Admin.partials.user_info', ['user' => $reclamation->destinataire])
                            @else
                                <p class="text-muted">Aucun destinataire spécifié</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h6>Contenu</h6>
                </div>
                <div class="card-body">
                    <div class="p-3 bg-light rounded">
                        {!! nl2br(e($reclamation->contenu)) !!}
                    </div>
                    <small class="text-muted">Créée le {{ $reclamation->created_at->format('d/m/Y H:i') }}</small>
                </div>
            </div>

            <!-- Réponse -->
            @if($reclamation->reponse)
                <div class="card mb-4 border-success">
                    <div class="card-header bg-success text-white">
                        <h6>Réponse</h6>
                    </div>
                    <div class="card-body">
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($reclamation->reponse)) !!}
                        </div>
                        <small class="text-muted">
                            Répondu le {{ $reclamation->date_reponse->format('d/m/Y H:i') }}
                            @if($reclamation->admin)
                                par {{ $reclamation->admin->name }}
                            @endif
                        </small>
                    </div>
                </div>
            @endif

            <!-- Formulaire de réponse -->
            @if($reclamation->statut == 'en_attente')
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h6>Traiter la Réclamation</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.reclamations.response.form', $reclamation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label>Statut</label>
                                <select name="statut" class="form-control" required>
                                    <option value="traité">Traité</option>
                                    <option value="rejeté">Rejeté</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Réponse</label>
                                <textarea name="reponse" rows="5" class="form-control" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i> Enregistrer
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="card-footer">
            <a href="{{ route('admin.reclamations.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
</div>

    </div>
</div>
</body>
</html>