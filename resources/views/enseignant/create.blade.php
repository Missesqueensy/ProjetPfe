<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une évaluation</title>
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .creation-card {
            border-left: 4px solid #4b6cb7;
            transition: all 0.3s;
        }
        .creation-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .file-upload-box {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        .file-upload-box:hover {
            border-color: #4b6cb7;
            background-color: #f8f9fa;
        }
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
        .select2-container--default .select2-selection--single {
            height: 38px;
            padding-top: 4px;
        }
        .alert-empty-data {
            border-left: 4px solid #dc3545;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <!-- Sidebar amélioré -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{ asset('assets/img/logosvg.svg') }}" width="50" alt="Logo de l'établissement" loading="lazy">
                <div class="brand-icons">
                    <span class="las la-bell"></span>
                    <span class="las la-user-circle"></span>
                </div>
            </div>
        </div>
        
        <div class="sidebar-user">
            <img src="{{ Auth::guard('enseignant')->user()->image ? asset('assets/img/'.Auth::guard('enseignant')->user()->image) : asset('assets/img/user1.jpeg') }}" 
                 width="50" height="50" alt="Photo de profil" class="rounded-circle" loading="lazy">
            <div>
                <span>{{ Auth::guard('enseignant')->user()->prenom }} {{ Auth::guard('enseignant')->user()->nom }}</span>
                <small class="text-muted d-block">{{ Auth::guard('enseignant')->user()->email }}</small>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('enseignant.dashboard') }}">
                        <span class="las la-user"></span>
                        Mon Profil
                    </a>
                </li>
                <li>
                    <a href="{{ route('enseignant.courses.index') }}">
                        <span class="las la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li class="active">
                    <a href="{{route('enseignant.evaluations.index')}}">
                        <span class="las la-clipboard-list"></span>
                        Évaluations
                    </a>
                </li>
                <li>
                <a href="{{ route('enseignant.notes.index') }}">
                        <span class="la la-check-circle"></span>
                        Résultats étudiants
                    </a>
                </li>
                <li>
                <a href="{{route('enseignant.reclamations.index')}}">
                        <span class="la la-chalkboard-teacher"></span>
                        Réclamations
                    </a>
                </li>
                <li>
                    <a href="{{route('Enseignant.emails')}}">
                        <span class="las la-envelope"></span>
                        Boîte e-mails
                    </a>
                </li>
                <li>
    <form action="{{ route('enseignant.logout') }}" method="POST" style="display: inline;">
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

    <!-- Contenu principal -->
    <div class="main-content">
        <header class="sticky-top bg-white shadow-sm">
            <div class="container-fluid py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="menu-toggle">
                        <button class="btn btn-outline-secondary">
                            <span class="las la-bars"></span>
                        </button>
                    </div>
                    <span class="me-3 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span> 
                </div>
            </div>
        </header>
 

        <div class="container-fluid py-4">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.evaluations.index') }}">Évaluations</a></li>
                    <li class="breadcrumb-item active">Création</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="fas fa-plus-circle text-primary me-2"></i>
                    Créer une nouvelle évaluation
                </h1>
                <a href="{{ route('enseignant.evaluations.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Annuler
                </a>
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

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('enseignant.evaluations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Section 1 : Informations de base -->
                <div class="card creation-card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Informations de base
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="titre" class="form-label required-field">Titre</label>
                                <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                                       id="titre" name="titre" value="{{ old('titre') }}" required>
                                @error('titre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="type" class="form-label required-field">Type</label>
                                <select class="form-select @error('type') is-invalid @enderror" 
                                        id="type" name="type" required>
                                    <option value="">Sélectionner...</option>
                                    <option value="examen" {{ old('type') == 'examen' ? 'selected' : '' }}>Examen</option>
                                    <option value="devoir" {{ old('type') == 'devoir' ? 'selected' : '' }}>Devoir</option>
                                    <option value="quiz" {{ old('type') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                                    <option value="projet" {{ old('type') == 'projet' ? 'selected' : '' }}>Projet</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="id_cours" class="form-label required-field">Cours</label>
                                @if($cours->isEmpty())
                                    <div class="alert alert-warning alert-empty-data">
                                        Vous n'êtes associé à aucun cours. Contactez l'administration.
                                    </div>
                                @else
                                    <select class="form-select select2-courses @error('id_cours') is-invalid @enderror" 
                                            id="id_cours" name="id_cours" required>
                                        <option value="">Sélectionner un cours...</option>
                                        @foreach($cours as $c)
                                            <option value="{{ $c->id_cours }}" 
                                                    {{ old('id_cours') == $c->id_cours ? 'selected' : '' }}>
                                                {{ $c->titre ?? 'Cours sans titre' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_cours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            
<!--affichage classes -->
                            <div class="col-md-6">
                                <label for="id_classe" class="form-label required-field">Classe</label>
                                @if($classes->isEmpty())
                                    <div class="alert alert-warning alert-empty-data">
                                        Aucune classe disponible. Contactez l'administration.
                                    </div>
                                @else
                                    <select class="form-select select2-classes @error('id_classe') is-invalid @enderror" 
                                            id="id_classe" name="id_classe" required>
                                        <option value="">Sélectionner une classe...</option>
                                        @foreach($classes as $classe)
                                            <option value="{{ $classe->id_classe }}" 
                                                    data-niveau="{{ $classe->niveau }}" 
                                                    data-filiere="{{ $classe->filiere }}"
                                                    data-annee="{{ $classe->annee_scolaire }}"
                                                    {{ old('id_classe') == $classe->id_classe ? 'selected' : '' }}>
                                                {{ $classe->nom }} - {{ $classe->niveau }} {{ $classe->filiere }} ({{ $classe->annee_scolaire }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_classe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2 : Planning -->
                <div class="card creation-card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-calendar-alt text-primary me-2"></i>
                            Planning
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="date_publication" class="form-label required-field">Date de publication</label>
                                <div class="input-group datetime-picker">
                                    <i class="fas fa-calendar"></i>
                                    <input type="datetime-local" class="form-control @error('date_publication') is-invalid @enderror" 
                                           id="date_publication" name="date_publication" 
                                           value="{{ old('date_publication') }}" required>
                                </div>
                                @error('date_publication')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4">
                                <label for="date_debut" class="form-label required-field">Date de début</label>
                                <div class="input-group datetime-picker">
                                    <i class="fas fa-calendar"></i>
                                    <input type="datetime-local" class="form-control @error('date_debut') is-invalid @enderror" 
                                           id="date_debut" name="date_debut" 
                                           value="{{ old('date_debut') }}" required>
                                </div>
                                @error('date_debut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4">
                                <label for="date_limite" class="form-label required-field">Date limite</label>
                                <div class="input-group datetime-picker">
                                    <i class="fas fa-calendar"></i>
                                    <input type="datetime-local" class="form-control @error('date_limite') is-invalid @enderror" 
                                           id="date_limite" name="date_limite" 
                                           value="{{ old('date_limite') }}" required>
                                </div>
                                @error('date_limite')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4">
                                <label for="duree_minutes" class="form-label required-field">Durée (minutes)</label>
                                <input type="number" class="form-control @error('duree_minutes') is-invalid @enderror" 
                                       id="duree_minutes" name="duree_minutes" 
                                       value="{{ old('duree_minutes', 60) }}" min="1" required>
                                @error('duree_minutes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3 : Paramètres -->
                <div class="card creation-card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-cog text-primary me-2"></i>
                            Paramètres
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="bareme_total" class="form-label required-field">Barème total</label>
                                <input type="number" step="0.01" class="form-control @error('bareme_total') is-invalid @enderror" 
                                       id="bareme_total" name="bareme_total" 
                                       value="{{ old('bareme_total', 20.00) }}" min="0" required>
                                @error('bareme_total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-check form-switch pt-3">
                                    <input class="form-check-input @error('est_visible') is-invalid @enderror" 
                                           type="checkbox" id="est_visible" name="est_visible" 
                                           value="1" {{ old('est_visible') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="est_visible">Rendre visible aux étudiants</label>
                                    @error('est_visible')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4 : Fichiers -->
                <div class="card creation-card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-file-upload text-primary me-2"></i>
                            Fichiers
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fichier_consigne" class="form-label">Fichier de consigne</label>
                                <div class="file-upload-box">
                                    <input type="file" class="d-none" id="fichier_consigne" name="fichier_consigne">
                                    <label for="fichier_consigne" class="w-100">
                                        <i class="fas fa-upload fa-2x mb-2"></i>
                                        <p class="mb-1">Cliquez pour téléverser</p>
                                        <small class="text-muted d-block" id="consigne-filename">Aucun fichier sélectionné</small>
                                    </label>
                                </div>
                                @error('fichier_consigne')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="fichier_correction" class="form-label">Fichier de correction</label>
                                <div class="file-upload-box">
                                    <input type="file" class="d-none" id="fichier_correction" name="fichier_correction">
                                    <label for="fichier_correction" class="w-100">
                                        <i class="fas fa-upload fa-2x mb-2"></i>
                                        <p class="mb-1">Cliquez pour téléverser</p>
                                        <small class="text-muted d-block" id="correction-filename">Aucun fichier sélectionné</small>
                                    </label>
                                </div>
                                @error('fichier_correction')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons de soumission -->
                <div class="d-flex justify-content-between mb-5">
                    <button type="submit" name="save_as_draft" value="1" class="btn btn-lg btn-secondary">
                        <i class="fas fa-save me-1"></i> Enregistrer brouillon
                    </button>
                    <div>
                        <button type="submit" name="publish" value="1" class="btn btn-lg btn-primary me-2">
                            <i class="fas fa-check-circle me-1"></i> Publier
                        </button>
                        <button type="submit" name="schedule" value="1" class="btn btn-lg btn-info">
                            <i class="fas fa-calendar-check me-1"></i> Programmer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialisation de Select2 pour les cours
        $('.select2-courses').select2({
            placeholder: "Rechercher un cours...",
            width: '100%'
        });

        // Initialisation de Select2 pour les classes
        $('.select2-classes').select2({
            placeholder: "Rechercher une classe...",
            width: '100%',
            templateResult: formatClassOption,
            templateSelection: formatClassSelection
        });

        function formatClassOption(classe) {
            if (!classe.id) return classe.text;
            
            var niveau = $(classe.element).data('niveau');
            var filiere = $(classe.element).data('filiere');
            var annee = $(classe.element).data('annee');
            
            return $(
                '<div><strong>' + niveau + ' ' + filiere + '</strong> - ' + 
                classe.text + ' (' + annee + ')</div>'
            );
        }
        
        function formatClassSelection(classe) {
            if (!classe.id) return classe.text;
            return $(classe.element).text();
        }

        // Gestion des fichiers uploadés
        $('#fichier_consigne').on('change', function(e) {
            $('#consigne-filename').text(e.target.files[0]?.name || 'Aucun fichier sélectionné');
        });
        
        $('#fichier_correction').on('change', function(e) {
            $('#correction-filename').text(e.target.files[0]?.name || 'Aucun fichier sélectionné');
        });
        
        // Validation des dates
        const datePub = $('#date_publication');
        const dateDebut = $('#date_debut');
        const dateFin = $('#date_limite');
        
        [datePub, dateDebut, dateFin].forEach(el => {
            el.on('change', function() {
                if (dateDebut.val() && new Date(dateDebut.val()) < new Date(datePub.val())) {
                    alert('La date de début doit être après la date de publication');
                    dateDebut.val('');
                }
                if (dateFin.val() && new Date(dateFin.val()) < new Date(dateDebut.val())) {
                    alert('La date limite doit être après la date de début');
                    dateFin.val('');
                }
            });
        });
    });
</script>
</body>
</html>