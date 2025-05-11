
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Formation</title>
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
        .preview-media {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 10px;
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
        <div class="header-icons">
                <span class="las la-search"></span>
                <span class="las la-bookmark"></span>
                <span class="las la-sms"></span>
            </div>
        </header>

        <div class="container py-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0"><i class="las la-plus-circle"></i> Créer une nouvelle formation</h2>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.formations.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Section Informations de base -->
                        <div class="form-section">
                            <h4 class="text-primary mb-4"><i class="las la-info-circle"></i> Informations de base</h4>
                            
                            <div class="mb-3">
                                <label for="titre" class="form-label">Titre de la formation</label>
                                <input type="text" class="form-control" id="titre" name="titre" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                        </div>

                        <!-- Section Médias -->
                        <div class="form-section">
                            <h4 class="text-primary mb-4"><i class="las la-photo-video"></i> Médias</h4>
                            
                            <!-- Image -->
                            <div class="mb-4">
                                <label class="form-label">Image de couverture</label>
                                <div class="media-upload-container" onclick="document.getElementById('image').click()">
                                    <i class="las la-image" style="font-size: 2rem;"></i>
                                    <p class="mt-2">Cliquez pour télécharger une image</p>
                                    <input type="file" id="image" name="image" accept="image/*" style="display: none;" onchange="previewImage(this)">
                                </div>
                                <img src="{{asset('assets/img/logo.jpg')}}" id="image-preview" class="preview-media d-none">
                            </div>
                            <!-- Image par défaut qui sera remplacée -->
    <img src="{{ asset('assets/img/logo.jpg') }}" id="image-preview" class="preview-media mt-2" style="max-height: 200px;">
</div>
                            <!-- Vidéo -->
                            <div class="mb-3">
                                <label class="form-label">Vidéo de présentation (URL)</label>
                                <textarea class="form-control" id="contenu_video" name="contenu_video" required></textarea>
                                <small class="text-muted">Collez ici le code d'intégration iframe (YouTube, Vimeo...)</small>
                            </div>
                            
                            <!-- Alternative: Upload de fichier vidéo -->
                            <div class="mb-3">
                                <label class="form-label">Ou télécharger une vidéo</label>
                                <div class="media-upload-container" onclick="document.getElementById('video_file').click()">
                                    <i class="las la-video" style="font-size: 2rem;"></i>
                                    <p class="mt-2">Cliquez pour télécharger une vidéo</p>
                                    <input type="file" id="video_file" name="video_file" accept="video/*" style="display: none;">
                                </div>
                            </div>
                        </div>

                        <!-- Section Détails -->
                        <div class="form-section">
                            <h4 class="text-primary mb-4"><i class="las la-cog"></i> Détails</h4>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_debut" class="form-label">Date de début</label>
                                        <input type="date" class="form-control" id="date_debut" name="date_debut">
                                    </div>
                                </div>
                                <div class="col-md-6">
                <div class="mb-3">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                </div>
            </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="duree" class="form-label">Durée (heures)</label>
                                        <input type="number" class="form-control" id="duree" name="duree" min="1">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="prix" class="form-label">Prix (€)</label>
                                <input type="number" class="form-control" id="prix" name="prix" min="0" step="0.01">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="gratuit" name="gratuit">
                                    <label class="form-check-label" for="gratuit">Formation gratuite</label>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('admin.formations.index') }}" class="btn btn-outline-secondary">
                                <i class="las la-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="las la-save"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Prévisualisation de l'image
   
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "{{ asset('assets/img/logo.jpg') }}";
        }
    }

    // Gestion du champ gratuit
    document.getElementById('gratuit').addEventListener('change', function() {
        const prixField = document.getElementById('prix');
        prixField.disabled = this.checked;
        if (this.checked) {
            prixField.value = '0';
        }
    });
</script>
</body>
</html>