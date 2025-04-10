<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">

    <lile>Admin Dashboard Panel</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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
                    <a href="{{url('/AdminAnalyses')}}">
                    <span class="las la-chart-pie"></span>
                      Analyses
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminCalendrier')}}">
                        <span class="las la-calendar"></span>
                        calendrier
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
                
             </ul>
            </div>
    </div>
</div>
<div class="main-content">
        <header>
            <h1>Modifier le Cours</h1>
        </header>

        <div class="container">
            <form action="{{ route('Admin.courses.update', $cours->id_cours) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="titre">Titre du Cours</label>
                    <input type="text" name="titre" id="titre" class="form-control" value="{{ $cours->titre }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" required>{{ $cours->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image du Cours</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Mettre à Jour le Cours</button>
            </form>
        </div>
    </div>

</body>
</html>-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard Panel</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
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
        .file-upload {
            border: 2px dashed #ddd;
            padding: 2rem;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .file-upload:hover {
            border-color: #0d6efd;
        }
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 1rem;
            border-radius: 4px;
        }
    </style>
</head>
<body> 
<div class="dashboard-container">
    <!-- Sidebar (identique à votre version originale) -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{asset('assets/img/logosvg.svg')}}" width="50px" alt="">
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
                    <a href="{{url('/AdminAnalyses')}}">
                    <span class="las la-chart-pie"></span>
                      Analyses
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminCalendrier')}}">
                        <span class="las la-calendar"></span>
                        Calendrier
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
                      Les Formations 
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminMails')}}">
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
                <label for="">
                    <span class="las la-bars"></span>
                </label>
            </div>
        </header>

        <div class="container">
            <div class="form-container">
                <div class="form-header">
                    <h1 class="h3 mb-0"><i class="las la-edit"></i> Modifier le Cours</h1>
                </div>

                <form action="{{ route('Admin.courses.update', $cours->id_cours) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="titre" class="form-label fw-bold">Titre du Cours</label>
                        <input type="text" name="titre" id="titre" class="form-control form-control-lg" value="{{ $cours->titre }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required>{{ $cours->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Image du Cours</label>
                        <div class="file-upload">
                            <div class="mb-2">
                                <i class="las la-image" style="font-size: 2rem; color: #6c757d;"></i>
                            </div>
                            <input type="file" name="image" id="image" class="d-none" onchange="previewFile()">
                            <label for="image" class="btn btn-outline-primary">Parcourir...</label>
                            <p class="small text-muted mt-2" id="file-name">Aucun fichier sélectionné</p>
                            
                            @if($cours->image)
                                <div class="mt-3">
                                    <p>Image actuelle :</p>
                                    <img src="{{ asset('storage/' . $cours->image) }}" alt="Image du cours" class="preview-image">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <a href="{{ route('Admin.courses.index') }}" class="btn btn-outline-secondary">
                            <i class="las la-arrow-left"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="las la-save"></i> Mettre à Jour le Cours
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function previewFile() {
        const fileInput = document.getElementById('image');
        const fileNameDisplay = document.getElementById('file-name');
        
        if(fileInput.files.length > 0) {
            fileNameDisplay.textContent = fileInput.files[0].name;
            
            // Preview the new image
            const reader = new FileReader();
            reader.onload = function(e) {
                // Remove existing preview if any
                const oldPreview = document.querySelector('.preview-image.new');
                if(oldPreview) oldPreview.remove();
                
                // Create new preview
                const preview = document.createElement('img');
                preview.src = e.target.result;
                preview.className = 'preview-image new mt-2';
                fileNameDisplay.after(preview);
            }
            reader.readAsDataURL(fileInput.files[0]);
        } else {
            fileNameDisplay.textContent = 'Aucun fichier sélectionné';
        }
    }
</script>
</body>
</html>