<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Formation | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <style>
        .detail-card {
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .detail-card:hover {
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15);
        }
        .info-icon {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #0d6efd;
        }
        .detail-item {
            border-left: 3px solid #0d6efd;
            padding-left: 15px;
            margin-bottom: 20px;
        }
        .formation-img {
            max-height: 350px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        }
    </style>
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

<form action="{{ route('admin.formations.update', $formation->id_formation) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" class="form-control" id="titre" name="titre" 
               value="{{ old('titre', $formation->titre) }}" required>
    </div>

    <div class="mb-3">
        <label for="date_debut" class="form-label">Date de début</label>
        <input type="date" class="form-control" id="date_debut" name="date_debut"
               value="{{ old('date_debut', $formation->date_debut) }}" required>
    </div>

    <!-- Ajoutez les autres champs ici --
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Formation | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <style>
        .form-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .media-upload-container {
            border: 2px dashed #dee2e6;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .media-upload-container:hover {
            border-color: #0d6efd;
            background-color: #f0f7ff;
        }
        .preview-media {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 10px;
        }
    </style>
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


        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow border-0">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="mb-0">
                                    <i class="las la-edit"></i> Modifier la Formation
                                </h2>
                                <a href="{{ route('admin.formations.index') }}" class="btn btn-light btn-sm">
                                    <i class="las la-arrow-left"></i> Retour
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <form action="{{ route('admin.formations.update', $formation->id_formation) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Section Informations de base -->
                                <div class="form-section mb-4">
                                    <h4 class="text-primary mb-4"><i class="las la-info-circle"></i> Informations de base</h4>
                                    
                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Titre de la formation</label>
                                        <input type="text" class="form-control" id="titre" name="titre" 
                                               value="{{ old('titre', $formation->titre) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $formation->description) }}</textarea>
                                    </div>
                                </div>

                                <!-- Section Médias -->
                                <div class="form-section mb-4">
                                    <h4 class="text-primary mb-4"><i class="las la-photo-video"></i> Médias</h4>
                                    
                                    <!-- Image -->
                                    <div class="mb-4">
                                        <label class="form-label">Image de couverture</label>
                                        @if($formation->image)
                                            <div class="mb-2">
                                                <img src="{{ asset($formation->image) }}" class="preview-media" style="max-height: 200px;">
                                            </div>
                                        @endif
                                        <div class="media-upload-container" onclick="document.getElementById('image').click()">
                                            <i class="las la-image" style="font-size: 2rem;"></i>
                                            <p class="mt-2">Cliquez pour changer l'image</p>
                                            <input type="file" id="image" name="image" accept="image/*" style="display: none;" onchange="previewImage(this)">
                                        </div>
                                    </div>

                                    <!-- Vidéo -->
                                    <div class="mb-3">
                                        <label for="contenu_video" class="form-label">Contenu Vidéo (iframe)</label>
                                        <textarea class="form-control" id="contenu_video" name="contenu_video" rows="3">{{ old('contenu_video', $formation->contenu_video) }}</textarea>
                                        <small class="text-muted">Collez ici le code d'intégration iframe (YouTube, Vimeo...)</small>
                                    </div>
                                </div>

                                <!-- Section Dates -->
                                <div class="form-section mb-4">
                                    <h4 class="text-primary mb-4"><i class="las la-calendar"></i> Dates et Durée</h4>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="date_debut" class="form-label">Date de début</label>
                                                <input type="date" class="form-control" id="date_debut" name="date_debut"
                                                       value="{{ old('date_debut', $formation->date_debut ? \Carbon\Carbon::parse($formation->date_debut)->format('Y-m-d') : '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="date_fin" class="form-label">Date de fin</label>
                                                <input type="date" class="form-control" id="date_fin" name="date_fin"
                                                       value="{{ old('date_fin', $formation->date_fin ? \Carbon\Carbon::parse($formation->date_fin)->format('Y-m-d') : '') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="duree" class="form-label">Durée (heures)</label>
                                        <input type="number" class="form-control" id="duree" name="duree" 
                                               value="{{ old('duree', $formation->duree) }}" min="1">
                                    </div>
                                </div>

                                <!-- Boutons d'action -->
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('admin.formations.index') }}" class="btn btn-outline-secondary">
                                        <i class="las la-times"></i> Annuler
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="las la-save"></i> Enregistrer les modifications
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Prévisualisation de l'image
    function previewImage(input) {
        const preview = document.createElement('img');
        preview.className = 'preview-media mt-2';
        preview.style.maxHeight = '200px';
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                input.parentNode.appendChild(preview);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Initialiser les datepickers si nécessaire
    document.addEventListener('DOMContentLoaded', function() {
        // Vous pourriez ajouter un datepicker plus avancé ici
    });
</script>
</body>
</html>