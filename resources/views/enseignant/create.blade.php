<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un cours - Dashboard Enseignant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
</head>
<body>
<div class="dashboard-container">
    <!-- Sidebar --
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{ asset('assets/img/logosvg.svg') }}" width="50px" alt="Logo">
                <div class="brand-icons">
                    <span class="las la-bell"></span>
                    <span class="las la-user-circle"></span>
                </div>
            </div>
        </div>
        
        <div class="sidebar-user">
            <img src="{{ asset('assets/img/user.jpeg') }}" alt="Photo de profil" width="50" height="50">
            <div>
                <h3>Amal Assim</h3>
                <span>Amalassim@gmail.com</span>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-head">
                <a href="{{ url('/enseignant/dashboard') }}">Mon Profil</a>
            </div>
            <ul>
                <li class="active">
                    <a href="{{ url('/enseignant/cours') }}">
                        <span class="la la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-wpforms"></span>
                        Evaluations
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-check-circle"></span>
                        Résultats étudiants
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-chalkboard-teacher"></span>
                        Réclamations
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="las la-envelope"></span>
                        Boîte e-mails
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content --
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
                <div class="form-header mb-4">
                    <h1><i class="las la-book"></i> Créer un nouveau cours</h1>
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

                <form action="{{ route('Enseignant.courses.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

                    @csrf

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="titre" class="form-label">Titre du cours *</label>
                            <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre') }}" required>
                            <div class="invalid-feedback">
                                Veuillez saisir le titre du cours.
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="matiere" class="form-label">Matière *</label>
                            <input type="text" class="form-control" id="matiere" name="matiere" value="{{ old('matiere') }}" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="niveau" class="form-label">Département</label>
                            <select class="form-select" id="niveau" name="niveau" required>
                                <option value="">Sélectionner...</option>
                                <option value="Licence 1">Informatique</option>
                                <option value="Licence 2">Biologie</option>
                                <option value="Licence 3">Physique</option>
                                <option value="Master 1">Chimie</option>
                                <option value="Master 2">Maathématiques</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="fichier" class="form-label">Fichier du cours (PDF)</label>
                            <input type="file" class="form-control" id="fichier" name="fichier" accept=".pdf">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ url('/enseignant/cours') }}" class="btn btn-outline-secondary">
                            <i class="las la-arrow-left"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="las la-save"></i> Enregistrer le cours
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Validation Bootstrap
(function () {
    'use strict'
    
    const forms = document.querySelectorAll('.needs-validation')
    
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>
</body>
</html>-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un cours - Dashboard Enseignant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
</head>
<body>
<div class="dashboard-container">
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{ asset('assets/img/logosvg.svg') }}" width="50px" alt="Logo">
                <div class="brand-icons">
                    <span class="las la-bell"></span>
                    <span class="las la-user-circle"></span>
                </div>
            </div>
        </div>
        
        <div class="sidebar-user">
            <img src="{{ asset('assets/img/user.jpeg') }}" alt="Photo de profil" width="50" height="50">
            <div>
                <h3>Amal Assim</h3>
                <span>Amalassim@gmail.com</span>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-head">
                <a href="{{ url('/enseignant/dashboard') }}">Mon Profil</a>
            </div>
            <ul>
                <li class="active">
                    <a href="{{ url('/enseignant/cours') }}">
                        <span class="la la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-wpforms"></span>
                        Evaluations
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-check-circle"></span>
                        Résultats étudiants
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-chalkboard-teacher"></span>
                        Réclamations
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="las la-envelope"></span>
                        Boîte e-mails
                    </a>
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
                <div class="form-header mb-4">
                    <h1><i class="las la-book"></i> Créer un nouveau cours</h1>
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

                <form action="{{ route('Enseignant.courses.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf

                    <div class="row g-3">
                        <!-- Titre du cours (obligatoire) -->
                        <div class="col-md-12">
                            <label for="titre" class="form-label">Titre du cours *</label>
                            <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre') }}" required>
                            <div class="invalid-feedback">
                                Veuillez saisir le titre du cours.
                            </div>
                        </div>
                        
                        <!-- Description (facultative) -->
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        </div>
                        
                        <!-- Image (obligatoire) -->
                        <div class="col-md-6">
                            <label for="image" class="form-label">Image du cours *</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                            <small class="text-muted">Formats acceptés: jpeg, png, jpg, gif (max 2MB)</small>
                            <div class="invalid-feedback">
                                Veuillez sélectionner une image pour le cours.
                            </div>
                        </div>
                        
                        <!-- Fichier PDF (facultatif) -->
                        <div class="col-md-6">
                            <label for="file" class="form-label">Fichier du cours (PDF)</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".pdf">
                            <small class="text-muted">Format accepté: PDF (max 10MB)</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ url('/enseignant/cours') }}" class="btn btn-outline-secondary">
                            <i class="las la-arrow-left"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="las la-save"></i> Enregistrer le cours
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Validation Bootstrap
(function () {
    'use strict'
    
    const forms = document.querySelectorAll('.needs-validation')
    
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>
</body>
</html>