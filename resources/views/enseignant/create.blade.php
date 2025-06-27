<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouveau cours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <meta name="description" content="Gestion des évaluations pour enseignants">
    <meta property="og:title" content="Dashboard Enseignant - Évaluations">
    <meta property="og:description" content="Plateforme de gestion des évaluations pour enseignants">
    <!-- Meta pour le référencement et les réseaux sociaux -->
    <meta name="description" content="Formulaire de création de réclamation pour enseignants">
    <style>
        .file-upload-box {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .file-upload-box:hover {
            border-color: #0d6efd;
            background-color: #f8f9fa;
        }
        .preview-image {
            max-width: 100%;
            max-height: 150px;
            margin-bottom: 1rem;
        }
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
    </style>
</head>
<body>
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
                  @isset($evaluations)
    @foreach($evaluations as $eval)
        <li>
            <a href="{{ route('enseignant.notes.index', ['evaluation' => $eval->id_evaluation]) }}">
                <span class="la la-check-circle"></span>
                Résultats {{ $eval->titre }}
            </a>
        </li>
    @endforeach
@endisset
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
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-book me-2"></i>Créer un nouveau cours
                    </h3>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('enseignant.courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Section 1 : Informations de base -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">
                                <i class="fas fa-info-circle text-primary me-2"></i>Informations de base
                            </h5>
                            
                            <div class="mb-3">
                                <label for="titre" class="form-label required-field">Titre du cours</label>
                                <input type="text" class="form-control" id="titre" name="titre" 
                                       value="{{ old('titre') }}" required maxlength="255"
                                       placeholder="Ex: Algèbre linéaire pour débutants">
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" 
                                          rows="4" placeholder="Décrivez le contenu du cours...">{{ old('description') }}</textarea>
                            </div>
                            
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="est_public" name="est_public" 
                                       value="1" {{ old('est_public') ? 'checked' : '' }}>
                                <label class="form-check-label" for="est_public">Rendre ce cours public</label>
                                <small class="text-muted d-block">Les cours publics sont visibles par tous les étudiants</small>
                            </div>
                        </div>

                        <!-- Section 2 : Fichiers multimédias -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">
                                <i class="fas fa-file-upload text-primary me-2"></i>Fichiers multimédias
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">Image de couverture</label>
                                    <div class="file-upload-box" id="image-upload-box">
                                        <input type="file" class="d-none" id="image" name="image" accept="image/*">
                                        <label for="image" class="w-100">
                                            <div id="image-preview-container">
                                                <i class="fas fa-image fa-3x mb-2 text-muted"></i>
                                                <p class="mb-1">Cliquez pour téléverser une image</p>
                                                <small class="text-muted">Format: JPG, PNG, GIF (max 2MB)</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="video" class="form-label">Vidéo d'introduction</label>
                                    <div class="file-upload-box">
                                        <input type="file" class="d-none" id="video" name="video" accept="video/*">
                                        <label for="video" class="w-100">
                                            <i class="fas fa-video fa-3x mb-2 text-muted"></i>
                                            <p class="mb-1">Cliquez pour téléverser une vidéo</p>
                                            <small class="text-muted">Format: MP4, WebM (max 50MB)</small>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-12 mb-3">
                                    <label for="file" class="form-label">Document support (PDF)</label>
                                    <div class="file-upload-box">
                                        <input type="file" class="d-none" id="file" name="file" accept=".pdf">
                                        <label for="file" class="w-100">
                                            <i class="fas fa-file-pdf fa-3x mb-2 text-muted"></i>
                                            <p class="mb-1">Cliquez pour téléverser un document</p>
                                            <small class="text-muted">Format: PDF uniquement (max 10MB)</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3 : Classes associées -->
                        @if(isset($classes) && $classes->isNotEmpty())
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">
                                <i class="fas fa-users text-primary me-2"></i>Classes concernées
                            </h5>
                            
                            <div class="row">
                                @foreach($classes as $classe)
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               id="classe-{{ $classe->id_classe }}" 
                                               name="classes[]" value="{{ $classe->id_classe }}"
                                               {{ is_array(old('classes')) && in_array($classe->id_classe, old('classes')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="classe-{{ $classe->id_classe }}">
                                            {{ $classe->nom }} - {{ $classe->niveau }} {{ $classe->filiere }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('enseignant.courses.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Créer le cours
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Prévisualisation de l'image
        $('#image').change(function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#image-preview-container').html(`
                        <img src="${event.target.result}" class="preview-image mb-2" alt="Prévisualisation">
                        <p class="mb-1">${file.name}</p>
                        <small class="text-muted">${(file.size/1024/1024).toFixed(2)} MB</small>
                    `);
                };
                reader.readAsDataURL(file);
            }
        });

        // Validation des fichiers
        $('form').submit(function() {
            const image = $('#image')[0].files[0];
            if (image && image.size > 2 * 1024 * 1024) {
                alert('L\'image ne doit pas dépasser 2MB');
                return false;
            }
            
            const video = $('#video')[0].files[0];
            if (video && video.size > 50 * 1024 * 1024) {
                alert('La vidéo ne doit pas dépasser 50MB');
                return false;
            }
            
            const file = $('#file')[0].files[0];
            if (file && !file.name.endsWith('.pdf')) {
                alert('Seuls les fichiers PDF sont acceptés');
                return false;
            }
            
            return true;
        });
    });
</script>
</body>
</html>