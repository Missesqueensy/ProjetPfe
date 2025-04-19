<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <!--<link rel="stylesheet" href="Admindash.css">-->
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
            <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="bi bi-collection-play"></i> Gestion des Formations
            </h1>
            
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Durée</th>
                                <th>Période</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($formations as $formation)
                            <tr>
                                <td>
                                @if ($formation->image)
    <img src="{{ asset('storage/' . $formation->image) }}" ... >
@else
    <img src="{{ asset('assets/img/default-formation.jpg') }}" ... >
@endif

                                </td>
                                <td>
                                    <strong>{{ $formation->titre }}</strong>
                                    <p class="text-muted small mb-0">{{ Str::limit($formation->description, 60) }}</p>
                                </td>
                                <td>
                                    <span class="badge badge-duree bg-primary">
                                        {{ $formation->duree }} heures
                                    </span>
                                </td>
                                <td>
                                    @if($formation->date_debut && $formation->date_fin)
                                    <div class="date-range">
                                        <i class="bi bi-calendar-event"></i> {{ $formation->date_debut->format('d/m/Y') }}
                                        <br>
                                        <i class="bi bi-calendar-check"></i> {{ $formation->date_fin->format('d/m/Y') }}
                                    </div>
                                    @else
                                        <span class="text-muted">Non spécifié</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons d-flex">
                                        <a href="{{ route('admin.formations.show', $formation->id) }}" 
                                           class="btn btn-sm btn-outline-primary"
                                           title="Voir détails">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.formations.edit', $formation->id) }}" 
                                           class="btn btn-sm btn-outline-secondary mx-2"
                                           title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.formations.destroy', $formation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Supprimer"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="bi bi-exclamation-circle fs-1 text-muted"></i>
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

    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
</body>
</html>