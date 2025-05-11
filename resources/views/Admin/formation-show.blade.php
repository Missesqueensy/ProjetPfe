<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">

    <title>Admin Dashboard Panel</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Détails de la Formation</h2>
        </div>
        
        <div class="card-body">
            @if($formation->image)
                <div class="text-center mb-4">
                    <img src="{{ asset($formation->image) }}" alt="Image formation" class="img-fluid rounded" style="max-height: 300px;">
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <h4 class="text-primary">Titre</h4>
                        <p>{{ $formation->titre ?? 'Non spécifié' }}</p>
                    </div>

                    <div class="mb-3">
                        <h4 class="text-primary">Description</h4>
                        <p>{{ $formation->description ?? 'Non spécifié' }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <h4 class="text-primary">
                            <i class="las la-calendar"></i> Date de début
                        </h4>
                        <p>
                            @isset($formation->date_debut)
                                {{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}
                            @else
                                Non spécifiée
                            @endisset
                        </p>
                    </div>

                    <div class="mb-3">
                        <h4 class="text-primary">
                            <i class="las la-clock"></i> Durée
                        </h4>
                        <p>{{ $formation->duree ?? 'Non spécifiée' }}</p>
                    </div>

                    <div class="mb-3">
                        <h4 class="text-primary">
                            <i class="las la-money-bill-wave"></i> Prix
                        </h4>
                        <p>
                            @isset($formation->prix)
                                {{ number_format($formation->prix, 2) }} €
                            @else
                                Gratuit
                            @endisset
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('admin.formations.index') }}" class="btn btn-outline-secondary">
                    <i class="las la-arrow-left"></i> Retour
                </a>
                
                @can('edit-formation')
                    <a href="{{ route('admin.formations.edit', $formation->id) }}" class="btn btn-warning">
                        <i class="las la-edit"></i> Modifier
                    </a>
                @endcan
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    .card {
        border-radius: 10px;
    }
    .img-fluid {
        border: 1px solid #dee2e6;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
</style>
@endsection
</div>
</body>
</html>-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Formation | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <style>
        .detail-card {
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .detail-card:hover {
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15);
        }
        .info-icon {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #0d6efd;
        }
        .detail-item {
            border-left: 3px solid #0d6efd;
            padding-left: 15px;
            margin-bottom: 20px;
        }
        .formation-img {
            max-height: 350px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
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

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card detail-card border-0">
                        <div class="card-header bg-primary text-white rounded-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="mb-0">
                                    <i class="las la-info-circle"></i> Détails de la Formation
                                </h2>
                                <a href="{{ route('admin.formations.index') }}" class="btn btn-light btn-sm">
                                    <i class="las la-arrow-left"></i> Retour
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <!-- Section Image + Titre -->
                            <div class="row mb-4">
                                <div class="col-md-5">
                                    @if($formation->image)
                                        <img src="{{ asset('assets/img/logo.jpg') }}" 
                                             alt="Image formation" 
                                             class="img-fluid formation-img w-100">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" 
                                             style="height: 100%; min-height: 200px; border-radius: 8px;">
                                            <i class="las la-image" style="font-size: 3rem; color: #adb5bd;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-7">
                                    <h3 class="text-primary mb-3">{{ $formation->titre ?? 'Titre non spécifié' }}</h3>
                                    <div class="bg-light p-3 rounded">
                                        <h5 class="mb-2"><i class="las la-align-left info-icon"></i>Description</h5>
                                        <p class="mb-0">{{ $formation->description ?? 'Description non disponible' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Section Détails en grille -->
                            <div class="row">
                                <!-- Colonne 1 -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <h5><i class="las la-calendar info-icon"></i>Date de début</h5>
                                        <p class="fs-5">
                                            {{ $formation->date_debut ? \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') : 'Non spécifiée' }}
                                        </p>
                                    </div>

                                    <div class="detail-item">
                                        <h5><i class="las la-calendar-times info-icon"></i>Date de fin</h5>
                                        <p class="fs-5">
                                            {{ $formation->date_fin ? \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') : 'Non spécifiée' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Colonne 2 -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <h5><i class="las la-clock info-icon"></i>Durée</h5>
                                        <p class="fs-5">
                                            {{ $formation->duree ? $formation->duree.' heures' : 'Non spécifiée' }}
                                        </p>
                                    </div>

                                    <div class="detail-item">
                                        <h5><i class="las la-tag info-icon"></i>Prix</h5>
                                        <p class="fs-5">
                                            @isset($formation->prix)
                                                {{ number_format($formation->prix, 2) }} €
                                            @else
                                                <span class="badge bg-success">Gratuit</span>
                                            @endisset
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Section Contenu Vidéo -->
                            @if($formation->contenu_video)
                            <div class="mt-3">
                                <h4 class="text-primary mb-2">
                                    <i class="las la-video info-icon"></i>Contenu Vidéo
                                </h4>
                                <!--<div class="ratio ratio-16x9 mt-2">--
                                    {!! $formation->contenu_video !!}
    </div>
                            </div>--
                            <div class="ratio ratio-16x9 mt-2">-->
    @if(preg_match('/youtube\.com|youtu\.be/', $formation->contenu_video))
        <a href="{{ $formation->contenu_video }}" 
           target="_blank" 
           class="video-link d-block position-relative"
           title="Ouvrir dans YouTube">
            <!-- Aperçu de la vidéo -->
            <div class="embed-responsive-item bg-dark position-relative">
                <!-- Icône play centrée -->
                <div class="position-absolute top-50 start-50 translate-middle">
                    <i class="las la-play-circle text-white" style="font-size: 4rem; opacity: 0.8;"></i>
                </div>
                <!-- Overlay hover -->
                <div class="video-overlay position-absolute w-100 h-100 top-0 start-0 bg-dark opacity-25"></div>
            </div>
            <!-- Conserver le contenu original comme fallback -->
            {!! $formation->contenu_video !!}
        </a>
    @else
        {!! $formation->contenu_video !!}
    @endif
</div>
                            @endif
                        </div>

                        <!-- Boutons d'action -->
                        <div class="card-footer bg-light d-flex justify-content-between border-0 rounded-bottom">
                            <a href="{{ route('admin.formations.index') }}" class="btn btn-outline-secondary">
                                <i class="las la-arrow-left"></i> Retour à la liste
                            </a>
                            
                            <div>
                                @can('edit-formation')
                                <a href="{{ route('admin.formations.edit', $formation->id) }}" class="btn btn-warning me-2">
                                    <i class="las la-edit"></i> Modifier
                                </a>
                                @endcan
                                
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="las la-trash"></i> Supprimer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cette formation "{{ $formation->titre }}" ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('admin.formations.destroy', $formation->id_formation) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>