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

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-reply me-2"></i>Réponse à la Réclamation #{{ $reclamation->id }}
                    </h4>
                </div>

                <div class="card-body">
                    <!-- Détails de la réclamation -->
                    <div class="mb-4 p-3 border rounded bg-light">
                        <h5 class="mb-3">Détails de la réclamation :</h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Expéditeur :</strong><br>
                                {{ $reclamation->expediteur->nom }} {{ $reclamation->expediteur->prenom }}<br>
                                <small class="text-muted">{{ class_basename($reclamation->expediteur) }}</small>
                                </p>
                            </div>
                            
                            @if($reclamation->destinataire)
                            <div class="col-md-6">
                                <p><strong>Destinataire :</strong><br>
                                {{ $reclamation->destinataire->nom }} {{ $reclamation->destinataire->prenom }}<br>
                                <small class="text-muted">{{ class_basename($reclamation->destinataire) }}</small>
                                </p>
                            </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <strong>Contenu :</strong>
                            <div class="p-2 mt-1 bg-white border rounded">
                                {!! nl2br(e($reclamation->contenu)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire de réponse -->
                    <form action="{{ route('admin.reclamations.response', $reclamation) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select class="form-select" id="statut" name="statut" required>
                                <option value="traité" {{ old('statut') == 'traité' ? 'selected' : '' }}>Traité</option>
                                <option value="rejeté" {{ old('statut') == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                                <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours de traitement</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="reponse" class="form-label">Réponse détaillée</label>
                            <textarea class="form-control" id="reponse" name="reponse" rows="8" 
                                      placeholder="Rédigez votre réponse ici..." required>{{ old('reponse') }}</textarea>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="notify" name="notify" checked>
                            <label class="form-check-label" for="notify">Notifier l'expéditeur par email</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.reclamations.show', $reclamation) }}" 
                               class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Retour
                            </a>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-1"></i> Envoyer la réponse
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Initialisation d'un éditeur de texte riche (optionnel)
    $(document).ready(function() {
        $('#reponse').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']],
                ['insert', ['link']],
                ['view', ['codeview']]
            ]
        });
    });
</script>
@endsection
    </div>
</body>
</html>