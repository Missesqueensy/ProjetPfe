<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Enseignant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .form-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{asset('assets/img/logosvg.svg')}}" width="50px" alt="">
                <div class="brand-icons">
                    <span class="las la-bell"></span>
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
                    <a href="{{url('/AdminProfesseurs')}}" class="active">
                        <span class="la la-chalkboard-teacher"></span>
                        Les professeurs
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminFormations')}}">
                        <span class="la la-chalkboard"></span>
                        Les Formations 
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminMails')}}">
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
                <label>
                    <span class="las la-bars"></span>
                </label>
            </div>
        </header>

        <div class="container">
            <div class="form-container">
                <div class="form-header">
                    <h1 class="h3 mb-0"><i class="las la-user-plus"></i> Ajouter un Nouvel Enseignant</h1>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('Admin.professeurs.storeprofesseur') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="specialite" class="form-label">Spécialité</label>
                            <input type="text" class="form-control" id="specialite" name="specialite" value="{{ old('specialite') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="departement" class="form-label">Département</label>
                            <select class="form-select" id="departement" name="departement" required>
                                <option value="">Sélectionner...</option>
                                <option value="Informatique" {{ old('departement') == 'Informatique' ? 'selected' : '' }}>Informatique</option>
                                <option value="Mathématiques" {{ old('departement') == 'Mathématiques' ? 'selected' : '' }}>Mathématiques</option>
                                <option value="Physique" {{ old('departement') == 'Physique' ? 'selected' : '' }}>Physique</option>
                                <option value="Chimie" {{ old('departement') == 'Chimie' ? 'selected' : '' }}>Chimie</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('Admin.professeurs.indexprofesseur') }}" class="btn btn-outline-secondary">
                            <i class="las la-arrow-left"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="las la-save"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
