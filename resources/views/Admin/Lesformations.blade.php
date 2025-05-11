
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Admin Dashboard - Formations</title>
    <style>
        .formation-card {
            transition: transform 0.3s ease;
        }
        .formation-card:hover {
            transform: translateY(-5px);
        }
        .formation-image {
            height: 180px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }
        .badge-duree {
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .action-buttons .btn {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .empty-state {
            padding: 3rem;
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .empty-state i {
            font-size: 3rem;
            color: #6c757d;
        }
        .video-preview {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
            overflow: hidden;
            background: #000;
            border-radius: 8px;
        }
        .video-preview iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
</head>
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
                <h1 class="h3 mb-0">
                    <i class="bi bi-collection-play"></i> Gestion des Formations
                </h1>
                <a href="{{ route('admin.formations.create') }}" class="btn btn-primary">
                    <i class="las la-plus"></i> Ajouter une formation
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Nouvelle vue en mode grille -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="btn-group" role="group">
                        <button id="grid-view" class="btn btn-outline-secondary active">
                            <i class="las la-th-large"></i> Grille
                        </button>
                        <button id="list-view" class="btn btn-outline-secondary">
                            <i class="las la-list"></i> Liste
                        </button>
                    </div>
                </div>
            </div>

            <!-- Vue Grille -->
            <div id="grid-view-container" class="row">
                @forelse($formations as $formation)
                <div class="col-md-4 mb-4">
                    <div class="card formation-card h-100 shadow-sm">
                        @if($formation->image)
                        <img src="{{ asset('assets/img/logo.jpg') }}" class="card-img-top formation-image" alt="Formation par défaut">

                        @else
                            <img src="{{ asset('assets/img/logo.jpg') }}" class="card-img-top formation-image" alt="Formation par défaut">
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $formation->titre }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($formation->description, 100) }}</p>
                            
                            @if($formation->contenu_video)
                            <div class="mb-3">
                                <!--<div class="video-preview mb-2">
                                    {!! $formation->contenu_video !!}
                                </div>-->
                                <small class="text-muted">Vidéo de formation</small>
                            </div>
                            @endif
                        </div>
                        
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary rounded-pill">
                                    {{ $formation->duree ?? 'N/A' }} heures
                                </span>
                                
                                <div class="action-buttons">
                                    <a href="{{ route('admin.formations.show', $formation->id_formation) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Voir détails">
                                        <i class="las la-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.formations.edit', $formation->id_formation) }}" 
                                       class="btn btn-sm btn-outline-secondary mx-1"
                                       title="Modifier">
                                        <i class="las la-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.formations.destroy', $formation->id_formation) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger"
                                                title="Supprimer"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation?')">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="las la-book-open"></i>
                        <h4 class="mt-3">Aucune formation disponible</h4>
                        <p class="text-muted">Commencez par ajouter une nouvelle formation</p>
                        <a href="{{ route('admin.formations.create') }}" class="btn btn-primary mt-2">
                            <i class="las la-plus"></i> Créer une formation
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Vue Liste (cachée par défaut) -->
            <div id="list-view-container" class="d-none">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Durée</th>
                                        <th>Période</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($formations as $formation)
                                    <tr>
                                        <td>
                                            @if($formation->image)
                                                <img src="{{ asset('storage/' . $formation->image) }}" width="80" height="45" style="object-fit: cover;" alt="{{ $formation->titre }}">
                                            @else
                                                <img src="{{ asset('assets/img/default-formation.jpg') }}" width="80" height="45" style="object-fit: cover;" alt="Formation par défaut">
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $formation->titre }}</strong>
                                        </td>
                                        <td>
                                            <p class="text-muted small mb-0">{{ Str::limit($formation->description, 60) }}</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-duree bg-primary">
                                                {{ $formation->duree ?? 'N/A' }} heures
                                            </span>
                                        </td>
                                        <td>
                                            @if($formation->date_debut && $formation->date_fin)
                                            <div class="date-range">
                                                <!--<i class="las la-calendar"></i> {{ $formation->date_debut->format('d/m/Y') }}--> 
                                                <i class="las la-calendar"></i> {{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}
                                                <br>
                                                <i class="las la-calendar-check"></i> {{ \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') }}
                                            </div>
                                            @else
                                                <span class="text-muted">Non spécifié</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-buttons d-flex">
                                                <a href="{{ route('admin.formations.show', $formation->id_formation) }}" 
                                                   class="btn btn-sm btn-outline-primary"
                                                   title="Voir détails">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.formations.edit', $formation->id_formation) }}" 
                                                   class="btn btn-sm btn-outline-secondary mx-2"
                                                   title="Modifier">
                                                    <i class="las la-pen"></i>
                                                </a>
                                                <form action="{{ route('admin.formations.destroy', $formation->id_formation) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="Supprimer"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation?')">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="las la-book-open fs-1 text-muted"></i>
                                            <p class="mt-2">Aucune formation disponible</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle entre les vues grille et liste
    document.getElementById('grid-view').addEventListener('click', function() {
        document.getElementById('grid-view-container').classList.remove('d-none');
        document.getElementById('list-view-container').classList.add('d-none');
        this.classList.add('active');
        document.getElementById('list-view').classList.remove('active');
    });
    
    document.getElementById('list-view').addEventListener('click', function() {
        document.getElementById('grid-view-container').classList.add('d-none');
        document.getElementById('list-view-container').classList.remove('d-none');
        this.classList.add('active');
        document.getElementById('grid-view').classList.remove('active');
    });
</script>
@endsection
</body>
</html>