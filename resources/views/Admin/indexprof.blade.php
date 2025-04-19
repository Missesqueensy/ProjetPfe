<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Enseignants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        .table-responsive {
            margin-top: 20px;
        }
        .avatar-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .action-btns .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
><div class="dashboard-container">

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
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div class="menu-toggle">
                <label>
                    <span class="las la-bars"></span>
                </label>
            </div>
            <h1 class="h4 mb-0">
                <i class="las la-chalkboard-teacher"></i> Gestion des Enseignants
            </h1>
            <a href="{{ route('Admin.professeurs.createprofesseur') }}" class="btn btn-primary">
                <i class="las la-plus"></i> Ajouter un enseignant
            </a>
        </header>

        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="h5 mb-0">Liste des enseignants</h3>
                    <form method="GET" class="d-flex" style="width: 300px;">
                        <input type="text" name="search" class="form-control me-2" placeholder="Rechercher..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="las la-search"></i>
                        </button>
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Photo</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Spécialité</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($enseignants as $enseignant)
                                <tr>
                                    <td>
                                        @if($enseignant->photo)
                                            <img src="{{ asset('storage/'.$enseignant->photo) }}" class="avatar-img" alt="Photo">
                                        @else
                                            <div class="avatar-img bg-light text-center">
                                                <i class="las la-user" style="line-height: 40px;"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $enseignant->nom }}</td>
                                    <td>{{ $enseignant->prenom }}</td>
                                    <td>{{ $enseignant->email }}</td>
                                    <td>{{ $enseignant->specialite }}</td>
                                    <td class="action-btns">
                                        <a href="{{ route('Admin.professeurs.showprofesseur', $enseignant->id_enseignant) }}" 
                                           class="btn btn-sm btn-info" title="Voir détails">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('Admin.professeurs.editprofesseur', $enseignant->id_enseignant) }}" 
                                           class="btn btn-sm btn-warning" title="Modifier">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <form action="{{ route('Admin.professeurs.destroyprofesseur', $enseignant->id_enseignant) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Êtes-vous sûr ?')" title="Supprimer">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Aucun enseignant trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($enseignants->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $enseignants->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>