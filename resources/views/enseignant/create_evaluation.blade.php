
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une évaluation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
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
        .datetime-picker {
            position: relative;
        }
        .datetime-picker i {
            position: absolute;
            left: 12px;
            top: 10px;
            color: #6c757d;
        }
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
        .select2-container--default .select2-selection--single {
            height: 38px;
            padding-top: 4px;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
<div class="dashboard-container">
<div class="dashboard-container">
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
                <li class="active">
                    <a href="{{ route('enseignant.courses.index') }}">
                        <span class="las la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li>
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
                <a href="{{route('Enseignanat.emails')}}">

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
    <div class="main-content">
        <header class="sticky-top bg-white shadow-sm">
            <div class="container-fluid py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="menu-toggle">
                        <button class="btn btn-outline-secondary sidebar-toggle">
                            <i class="las la-bars"></i>
                        </button>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="me-3 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="las la-user-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('enseignant.dashboard') }}">Mon profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="{{ route('enseignant.logout') }}">Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
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
                                <input type="text" class="form-control" id="titre" name="titre" required maxlength="100">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="type" class="form-label required-field">Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Sélectionner...</option>
                                    <option value="examen">Examen</option>
                                    <option value="devoir">Devoir</option>
                                    <option value="quiz">Quiz</option>
                                    <option value="projet">Projet</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="id_cours" class="form-label required-field">Cours</label>
                                <select class="form-select select2-courses" id="id_cours" name="id_cours" required>
                                    <option value="">Sélectionner un cours...</option>
                                    @foreach($cours as $c)
                                        <option value="{{ $c->id_cours }}">{{ $c->titre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6">
    <label for="id_classe" class="form-label required-field">Classe</label>
    <select class="form-select select2-classes" id="id_classe" name="id_classe" required>
        <option value="">Sélectionner une classe...</option>
        @forelse($classes as $classe)
            <option value="{{ $classe->id_classe }}" 
                    data-niveau="{{ $classe->niveau }}" 
                    data-filiere="{{ $classe->filiere }}" 
                    data-annee="{{ $classe->annee_scolaire }}">
                {{ $classe->nom }} - {{ $classe->niveau }} {{ $classe->filiere }} ({{ $classe->annee_scolaire }})
            </option>
        @empty
            <option value="" disabled>Aucune classe disponible</option>
        @endforelse
    </select>
</div>

                            
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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
                                <div class="datetime-picker">
                                    <i class="fas fa-calendar"></i>
                                    <input type="datetime-local" class="form-control ps-4" id="date_publication" name="date_publication" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="date_debut" class="form-label required-field">Date de début</label>
                                <div class="datetime-picker">
                                    <i class="fas fa-calendar"></i>
                                    <input type="datetime-local" class="form-control ps-4" id="date_debut" name="date_debut" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="date_limite" class="form-label required-field">Date limite</label>
                                <div class="datetime-picker">
                                    <i class="fas fa-calendar"></i>
                                    <input type="datetime-local" class="form-control ps-4" id="date_limite" name="date_limite" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="duree_minutes" class="form-label required-field">Durée (minutes)</label>
                                <input type="number" class="form-control" id="duree_minutes" name="duree_minutes" min="1" max="600" required>
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
                                <label for="bareme_total" class="form-label">Barème total</label>
                                <input type="number" class="form-control" id="bareme_total" name="bareme_total" step="0.01" min="0" max="100" value="20.00">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Visibilité</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="est_visible" name="est_visible" value="1">
                                    <label class="form-check-label" for="est_visible">Rendre visible aux étudiants</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="statut" class="form-label required-field">Statut</label>
                                <select class="form-select" id="statut" name="statut" required>
                                    <option value="brouillon">Brouillon</option>
                                    <option value="programme">Programmé</option>
                                    <option value="en_cours">En cours</option>
                                    <option value="corrige">Corrigé</option>
                                    <option value="archive">Archivé</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4 : Fichiers -->
                <div class="card creation-card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-paperclip text-primary me-2"></i>
                            Fichiers
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fichier_consigne" class="form-label">Fichier de consigne</label>
                                <div class="file-upload-box" onclick="document.getElementById('fichier_consigne').click()">
                                    <i class="fas fa-cloud-upload-alt fa-2x mb-2 text-muted"></i>
                                    <p class="mb-1">Glissez-déposez ou cliquez pour uploader</p>
                                    <small class="text-muted">Formats acceptés: PDF, DOC, DOCX</small>
                                    <input type="file" class="d-none" id="fichier_consigne" name="fichier_consigne" accept=".pdf,.doc,.docx">
                                    <div id="consigne-filename" class="mt-2 text-primary"></div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="fichier_correction" class="form-label">Fichier de correction</label>
                                <div class="file-upload-box" onclick="document.getElementById('fichier_correction').click()">
                                    <i class="fas fa-cloud-upload-alt fa-2x mb-2 text-muted"></i>
                                    <p class="mb-1">Glissez-déposez ou cliquez pour uploader</p>
                                    <small class="text-muted">Formats acceptés: PDF, DOC, DOCX</small>
                                    <input type="file" class="d-none" id="fichier_correction" name="fichier_correction" accept=".pdf,.doc,.docx">
                                    <div id="correction-filename" class="mt-2 text-primary"></div>
                                </div>
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
            
            var $option = $(
                '<div><strong>' + niveau + ' ' + filiere + '</strong> - ' + 
                classe.text + ' (' + annee + ')</div>'
            );
            return $option;
        }
        
        function formatClassSelection(classe) {
            if (!classe.id) return classe.text;
            return $(classe.element).text();
        }

        // Gestion des fichiers uploadés
        document.getElementById('fichier_consigne')?.addEventListener('change', function(e) {
            document.getElementById('consigne-filename').textContent = 
                e.target.files[0]?.name || 'Aucun fichier sélectionné';
        });
        
        document.getElementById('fichier_correction')?.addEventListener('change', function(e) {
            document.getElementById('correction-filename').textContent = 
                e.target.files[0]?.name || 'Aucun fichier sélectionné';
        });
        
        // Validation des dates
        const datePub = document.getElementById('date_publication');
        const dateDebut = document.getElementById('date_debut');
        const dateFin = document.getElementById('date_limite');
        
        [datePub, dateDebut, dateFin].forEach(el => {
            el?.addEventListener('change', function() {
                if (dateDebut && new Date(dateDebut.value) < new Date(datePub.value)) {
                    alert('La date de début doit être après la date de publication');
                    dateDebut.value = '';
                }
                if (dateFin && new Date(dateFin.value) < new Date(dateDebut.value)) {
                    alert('La date limite doit être après la date de début');
                    dateFin.value = '';
                }
            });
        });
    });
</script>
</body>
</html>