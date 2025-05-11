<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le cours - Dashboard Enseignant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            margin-top: 10px;
        }
        .file-upload {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }
        .file-upload:hover {
            border-color: #0d6efd;
            background-color: #f8f9fa;
        }
        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 25px;
            margin-top: 20px;
        }
        .form-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        textarea {
            min-height: 150px;
        }
    </style>
</head>
<body> 
<div class="dashboard-container">
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{ asset('assets/img/logosvg.svg') }}" width="50" alt="Logo" loading="lazy">
                <div class="brand-icons">
                    <span class="las la-bell"></span>
                    <span class="las la-user-circle"></span>
                </div>
            </div>
        </div>
        
        <div class="sidebar-user">
            <img src="{{ Auth::guard('enseignant')->user()->image ? asset('storage/'.Auth::guard('enseignant')->user()->image) : asset('assets/img/user1.jpeg') }}" 
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
                    <a href="{{ route('enseignant.courses.show', $course->id_cours) }}">
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
                        Boite e-mails
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
                    <button class="btn btn-outline-secondary menu-toggle">
                        <span class="las la-bars"></span>
                    </button>
                    <span class="me-3 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span> 
                </div>
            </div>
        </header>

        <div class="container py-4">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.courses.index') }}">Mes Cours</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier le cours</li>
                </ol>
            </nav>

            <div class="form-container">
                <div class="form-header d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0"><i class="las la-edit text-primary"></i> Modifier le cours</h1>
                    <span class="badge bg-light text-dark">
                        Créé le: {{ $course->created_at->format('d/m/Y') }}
                    </span>
                </div>

                <form action="{{ route('enseignant.courses.update', $course->id_cours) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="titre" class="form-label fw-bold">Titre du Cours</label>
                        <input type="text" name="titre" id="titre" class="form-control form-control-lg" value="{{ old('titre', $course->titre) }}" required>
                        @error('titre')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $course->description) }}</textarea>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Image du Cours</label>
                        <div class="file-upload">
                            <div class="mb-2">
                                <i class="las la-image text-primary" style="font-size: 2rem;"></i>
                                <p class="mt-2">Glissez-déposez votre fichier ici ou cliquez pour parcourir</p>
                            </div>
                            <input type="file" name="image" id="image" class="d-none" onchange="previewFile()" accept="image/*">
                            <label for="image" class="btn btn-outline-primary">
                                <i class="las la-folder-open"></i> Sélectionner une image
                            </label>
                            <p class="small text-muted mt-2" id="file-name">
                                @if($course->image)
                                    Fichier actuel: {{ basename($course->image) }}
                                @else
                                    Aucun fichier sélectionné
                                @endif
                            </p>
                            
                            @if($course->image)
                                <div class="mt-3">
                                    <p class="mb-1">Image actuelle :</p>
                                    <img src="{{ asset('storage/' . $course->image) }}" alt="Image du cours" class="preview-image img-thumbnail">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                                        <label class="form-check-label text-danger" for="remove_image">
                                            Supprimer cette image
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @error('image')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                    <div class="mb-4">
    <label class="form-label fw-bold">Vidéo du cours</label>
    <div class="file-upload" id="video-upload-area">
        <div class="mb-2">
            <i class="las la-video text-primary" style="font-size: 2rem;"></i>
            <p class="mt-2">Glissez-déposez votre fichier vidéo ici ou cliquez pour parcourir</p>
        </div>
        <input type="file" name="video" id="video" class="d-none" accept="video/*">
        <label for="video" class="btn btn-outline-primary">
            <i class="las la-folder-open"></i> Sélectionner une vidéo
        </label>
        <p class="small text-muted mt-2" id="video-file-name">
            @if($course->video_path)
                Fichier actuel: {{ basename($course->video_path) }}
            @else
                Aucun fichier sélectionné
            @endif
        </p>
        
        @if($course->video_path)
            <div class="mt-3" id="video-preview">
                <video controls class="preview-image img-thumbnail">
                    <source src="{{ asset('storage/' . $course->video_path) }}" type="video/{{ $course->format_video }}">
                </video>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="remove_video" id="remove_video">
                    <label class="form-check-label text-danger" for="remove_video">
                        Supprimer cette vidéo
                    </label>
                </div>
            </div>
        @endif
    </div>
    @error('video')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>
                </div>
    </div>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-3 mt-4">
                            <a href="{{ route('enseignant.courses.index') }}" class="btn btn-outline-secondary">
                                <i class="las la-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="las la-save"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Gestion de la vidéo
const videoUploadArea = document.getElementById('video-upload-area');
const videoInput = document.getElementById('video');
const videoFileName = document.getElementById('video-file-name');

videoUploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    videoUploadArea.style.borderColor = '#0d6efd';
    videoUploadArea.style.backgroundColor = '#f0f7ff';
});

videoUploadArea.addEventListener('dragleave', () => {
    videoUploadArea.style.borderColor = '#dee2e6';
    videoUploadArea.style.backgroundColor = '';
});

videoUploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    videoUploadArea.style.borderColor = '#dee2e6';
    videoUploadArea.style.backgroundColor = '';
    
    if(e.dataTransfer.files.length) {
        videoInput.files = e.dataTransfer.files;
        previewVideo(videoInput.files[0]);
    }
});

videoInput.addEventListener('change', function() {
    if(this.files && this.files[0]) {
        previewVideo(this.files[0]);
    }
});

function previewVideo(file) {
    const reader = new FileReader();
    videoFileName.textContent = `Fichier sélectionné: ${file.name}`;
    
    const videoPreview = document.getElementById('video-preview');
    if (!videoPreview) {
        const newPreview = document.createElement('div');
        newPreview.id = 'video-preview';
        videoUploadArea.appendChild(newPreview);
    }
    
    const videoURL = URL.createObjectURL(file);
    document.getElementById('video-preview').innerHTML = `
        <video controls class="preview-image img-thumbnail mt-3">
            <source src="${videoURL}" type="${file.type}">
        </video>
    `;
}
    // Configuration du datepicker
    flatpickr("#date_publication", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        locale: "fr"
    });

    // Gestion du drag and drop pour l'image
    const imageUploadArea = document.getElementById('image-upload-area');
    const imageInput = document.getElementById('image');
    
    imageUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageUploadArea.style.borderColor = '#0d6efd';
        imageUploadArea.style.backgroundColor = '#f0f7ff';
    });

    imageUploadArea.addEventListener('dragleave', () => {
        imageUploadArea.style.borderColor = '#dee2e6';
        imageUploadArea.style.backgroundColor = '';
    });

    imageUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        imageUploadArea.style.borderColor = '#dee2e6';
        imageUploadArea.style.backgroundColor = '';
        
        if(e.dataTransfer.files.length) {
            imageInput.files = e.dataTransfer.files;
            previewImage(imageInput.files[0]);
        }
    });

    imageInput.addEventListener('change', function() {
        if(this.files && this.files[0]) {
            previewImage(this.files[0]);
        }
    });

    function previewImage(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = `
                <div class="media-thumbnail">
                    <img src="${e.target.result}" alt="Prévisualisation" class="media-preview">
                    <div class="remove-media" onclick="preview.innerHTML=''">
                        <i class="las la-times"></i>
                    </div>
                </div>
            `;
        }
        reader.readAsDataURL(file);
    }

    // Gestion similaire pour la vidéo (à implémenter)

</script>
</body>
</html>
<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le cours - {{ $course->titre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <style>
        .file-upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
        }
        .file-upload-area:hover {
            border-color: #0d6efd;
            background-color: #f8f9fa;
        }
        .media-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 4px;
        }
        .media-thumbnail {
            position: relative;
            display: inline-block;
            margin: 10px;
        }
        .remove-media {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="dashboard-container">

    <div class="main-content">

        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">
                        <i class="las la-edit"></i> Modifier le cours
                        <span class="badge bg-light text-dark float-end">
                            {{ $course->created_at ? $course->created_at->format('d/m/Y') : 'Date inconnue' }}
                        </span>
                    </h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('enseignant.courses.update', $course->id_cours) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Titre --
                                <div class="mb-4">
                                    <label for="titre" class="form-label fw-bold">Titre du cours *</label>
                                    <input type="text" class="form-control" id="titre" name="titre" 
                                           value="{{ old('titre', $course->titre) }}" required>
                                    @error('titre')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description --
                                <div class="mb-4">
                                    <label for="description" class="form-label fw-bold">Description</label>
                                    <textarea class="form-control" id="description" name="description" 
                                              rows="6">{{ old('description', $course->description) }}</textarea>
                                    @error('description')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Visibilité --
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Visibilité</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="est_public" 
                                               name="est_public" {{ old('est_public', $course->est_public) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="est_public">
                                            Rendre ce cours public
                                        </label>
                                    </div>
                                </div>

                                <!-- Date de publication --
                                <div class="mb-4">
                                    <label for="date_publication" class="form-label fw-bold">Date de publication</label>
                                    <input type="datetime-local" class="form-control" id="date_publication" 
                                           name="date_publication" value="{{ old('date_publication', $course->date_publication ? $course->date_publication->format('Y-m-d\TH:i') : '') }}">
                                    @error('date_publication')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image du cours --
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Image du cours</label>
                                    <div class="file-upload-area" id="image-upload-area">
                                        <i class="las la-image text-muted" style="font-size: 2rem;"></i>
                                        <p class="my-2">Glissez-déposez une image ou cliquez pour sélectionner</p>
                                        <input type="file" id="image" name="image" class="d-none" accept="image/*">
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="document.getElementById('image').click()">
                                            Choisir une image
                                        </button>
                                        <div id="image-preview" class="mt-3">
                                            @if($course->image)
                                                <div class="media-thumbnail">
                                                    <img src="{{ asset('storage/'.$course->image) }}" alt="Image du cours" class="media-preview">
                                                    <div class="remove-media" onclick="document.getElementById('remove_image').click()">
                                                        <i class="las la-times"></i>
                                                    </div>
                                                    <input type="checkbox" id="remove_image" name="remove_image" class="d-none">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Vidéo --
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Vidéo du cours</label>
                                    <div class="file-upload-area" id="video-upload-area">
                                        <i class="las la-video text-muted" style="font-size: 2rem;"></i>
                                        <p class="my-2">Télécharger une vidéo (MP4, WebM)</p>
                                        <input type="file" id="video" name="video" class="d-none" accept="video/*">
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="document.getElementById('video').click()">
                                            Choisir une vidéo
                                        </button>
                                        <div id="video-preview" class="mt-3">
                                            @if($course->video_path)
                                                <div class="media-thumbnail">
                                                    <video controls class="media-preview">
                                                        <source src="{{ asset('storage/'.$course->video_path) }}" type="video/{{ $course->format_video }}">
                                                    </video>
                                                    <div class="remove-media" onclick="document.getElementById('remove_video').click()">
                                                        <i class="las la-times"></i>
                                                    </div>
                                                    <input type="checkbox" id="remove_video" name="remove_video" class="d-none">
                                                </div>
                                                <small class="text-muted d-block mt-1">Format: {{ strtoupper($course->format_video) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    @error('video')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-3 mt-4">
                            <a href="{{ route('enseignant.courses.index') }}" class="btn btn-outline-secondary">
                                <i class="las la-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="las la-save"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Configuration du datepicker
    flatpickr("#date_publication", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        locale: "fr"
    });

    // Gestion du drag and drop pour l'image
    const imageUploadArea = document.getElementById('image-upload-area');
    const imageInput = document.getElementById('image');
    
    imageUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageUploadArea.style.borderColor = '#0d6efd';
        imageUploadArea.style.backgroundColor = '#f0f7ff';
    });

    imageUploadArea.addEventListener('dragleave', () => {
        imageUploadArea.style.borderColor = '#dee2e6';
        imageUploadArea.style.backgroundColor = '';
    });

    imageUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        imageUploadArea.style.borderColor = '#dee2e6';
        imageUploadArea.style.backgroundColor = '';
        
        if(e.dataTransfer.files.length) {
            imageInput.files = e.dataTransfer.files;
            previewImage(imageInput.files[0]);
        }
    });

    imageInput.addEventListener('change', function() {
        if(this.files && this.files[0]) {
            previewImage(this.files[0]);
        }
    });

    function previewImage(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = `
                <div class="media-thumbnail">
                    <img src="${e.target.result}" alt="Prévisualisation" class="media-preview">
                    <div class="remove-media" onclick="preview.innerHTML=''">
                        <i class="las la-times"></i>
                    </div>
                </div>
            `;
        }
        reader.readAsDataURL(file);
    }

    // Gestion similaire pour la vidéo (à implémenter)
</script>
</body>
</html>-->