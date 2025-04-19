<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Professeur</title>
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
        .avatar-preview {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #eee;
        }
        .file-upload {
            border: 2px dashed #ddd;
            padding: 1.5rem;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .file-upload:hover {
            border-color: #0d6efd;
            background: #f8f9fa;
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
            <h1 class="h4 mb-0">
                <i class="las la-user-edit"></i> Modifier Professeur
            </h1>
        </header>

        <div class="container py-4">
            <div class="form-container">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('Admin.professeurs.updateprofesseur', $enseignant->id_enseignant) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                                @if($enseignant->photo)
                                    <img id="avatarPreview" src="{{ asset('storage/'.$enseignant->photo) }}" class="avatar-preview" alt="Photo actuelle">
                                @else
                                    <img id="avatarPreview" src="{{ asset('assets/img/user.jpeg') }}" class="avatar-preview" alt="Photo par défaut">
                                @endif
                            </div>
                            
                            <!--<div class="file-upload mb-3" onclick="document.getElementById('photo').click()">
                                <!--<div class="mb-2">
                                    <i class="las la-camera" style="font-size: 1.5rem;"></i>
                                </div>-->
                                <!--<p class="small mb-0">Changer la photo</p>--
                                <!--<input type="file" name="photo" id="photo" class="d-none" accept="image/*" onchange="previewImage(this)">--
                            </div>-->
                        </div>
                        
                        <div class="col-md-8">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $enseignant->nom) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $enseignant->prenom) }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $enseignant->email) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="departement" class="form-label">Département</label>
                                    <select class="form-select" id="departement" name="departement" required>
                                        <option value="">Sélectionner...</option>
                                        <option value="Informatique" {{ old('departement', $enseignant->departement) == 'Informatique' ? 'selected' : '' }}>Informatique</option>
                                        <option value="Mathématiques" {{ old('departement', $enseignant->departement) == 'Mathématiques' ? 'selected' : '' }}>Mathématiques</option>
                                        <option value="Physique" {{ old('departement', $enseignant->departement) == 'Physique' ? 'selected' : '' }}>Physique</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="specialite" class="form-label">Spécialité</label>
                                    <input type="text" class="form-control" id="specialite" name="specialite" value="{{ old('specialite', $enseignant->specialite) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between border-top pt-4">
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
<script>
    function previewImage(input) {
        const preview = document.getElementById('avatarPreview');
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            
            reader.readAsDataURL(file);
        }
    }
</script>
</body>
</html>