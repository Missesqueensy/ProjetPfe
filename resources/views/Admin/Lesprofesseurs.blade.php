<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Professeurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>

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
            <label>
                <span class="las la-bars"></span>
            </label>
        </div>
        <div class="header-title">
            <h1>Gestion des Professeurs</h1>
        </div>
        <div class="header-actions">
            <a href="{{ route('Admin.professeurs.createprofesseur') }}" class="btn btn-primary">
                <i class="las la-plus"></i> Ajouter un professeur
            </a>
        </div>
    </header>

    <main>
        <div class="page-content">
            <div class="card">
                <div class="card-header">
                    <h3>Liste des Professeurs</h3>
                    <form method="GET" action="{{ route('Admin.professeurs.indexprofesseur') }}" class="search-box">
                        <input type="text" name="search" placeholder="Rechercher un professeur..." 
                               class="form-control" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="las la-search"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
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
                                            <img src="{{ asset('storage/' . $enseignant->photo) }}" class="rounded-circle" width="40" height="40" alt="">
                                        @else
                                            <div class="avatar-placeholder rounded-circle">
                                                <i class="las la-user"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $enseignant->nom}}</td>
                                    <td> {{ $enseignant->prenom }}</td>
                                    <td>{{ $enseignant-> email }}</td>
                                    <td>{{ $enseignant->specialite }}</td>
                                    
                                    <td>
                                        <a href="{{ route('Admin.professeurs.showprofesseur', $enseignant->id_enseignant) }}" class="btn btn-sm btn-info">
                                            <i class="las la-eye"></i>
                                        </a>
                                       <!-- <a href="{{ route('Admin.professeurs.editprofesseur', $enseignant->id_enseignant) }}" class="btn btn-sm btn-warning">-->
                                            <!--<i class="las la-edit"></i>-->
                                        
                                        <form action="{{ route('Admin.professeurs.destroyprofesseur', $enseignant->id_enseignant) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur ?')">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Aucun professeur trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Modal pour confirmation de suppression -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce professeur ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script pour gérer la suppression avec confirmation
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        const deleteForm = document.getElementById('deleteForm');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const enseignantId = this.getAttribute('data-id');
                deleteForm.action = `/admin/professeurs/${enseignantId}`;
            });
        });
    });
</script>
</body>
</html>