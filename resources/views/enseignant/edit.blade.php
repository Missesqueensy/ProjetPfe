<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <title>Dashboard Enseignant - Mes Cours</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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
            <img src="{{ asset('assets/img/user.jpeg') }}" height="50" width="50" alt="Photo de profil">
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
                <label for="">
                    <span class="las la-bars"></span>
                </label>
            </div>
        </header>

        <div class="container">
            <div class="form-container">
                <div class="form-header">
                    <h1 class="h3 mb-0"><i class="las la-edit"></i> Modifier le cours</h1>
                </div>

                <form action="{{ route('Enseignant.courses.update', $cours->id_cours) }}" method="POST" enctype="multipart/form-data">
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
                        <a href="{{ route('Enseignant.courses.index') }}" class="btn btn-outline-secondary">
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