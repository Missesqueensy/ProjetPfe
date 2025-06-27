<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Notes de Cours - Tableau de Bord Étudiant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
                <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">

    <style>
       
        /* Main content */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        .notes-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Card styles */
        .notes-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .notes-card .card-header {
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.25rem;
            font-weight: 600;
        }

        /* Editor styles */
        #editor {
            min-height: 300px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .ql-toolbar {
            border-radius: 4px 4px 0 0;
        }

        .ql-container {
            border-radius: 0 0 4px 4px;
        }

        /* Note list styles */
        .note-item {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .note-item:hover {
            border-left-color: var(--accent-color);
            transform: translateX(5px);
        }

        .note-content {
            font-family: inherit;
        }

        .note-content img {
            max-width: 100%;
            height: auto;
        }

        .note-content p {
            margin-bottom: 0.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #c433ff;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }

        .sidebar {
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
            color: white;
            position: fixed;
            width: 280px;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        .course-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            border: none;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .course-img-container {
            height: 180px;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .course-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: cover;
        }

        .course-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--accent-color);
            color: white;
        }

        .teacher-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .teacher-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #c433ff; /* Conservation de votre couleur violette */
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --sidebar-bg: linear-gradient(to bottom, #6a11cb, #2575fc);
        }

        body {
            background: #f5f7fa;
            font-family: 'Poppins', sans-serif;
            color: #495057;
        }

        .sidebar {
            background: var(--sidebar-bg);
            min-height: 100vh;
            color: white;
            padding: 2rem 1rem;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 280px;
            z-index: 100;
        }

        .sidebar h4 {
            color: white;
            font-weight: 600;
            margin-bottom: 2rem;
            padding-left: 10px;
            border-left: 4px solid var(--accent-color);
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }

        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        .dashboard-header {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .dashboard-header h2 {
            color: var(--accent-color); /* Utilisation de votre couleur violette */
            font-weight: 700;
            margin-bottom: 0;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(to right, var(--primary-color), var(--accent-color)); /* Intégration de votre couleur */
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.25rem;
            font-weight: 600;
        }

        .info-item {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .info-value {
            color: #6c757d;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px 15px;
            border-radius: 8px;
            width: 100%;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-logout i {
            margin-right: 8px;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .user-role-badge {
            background: var(--accent-color); /* Utilisation de votre couleur violette */
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            margin-top: 10px;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
                width: 280px;
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block !important;
            }
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: var(--accent-color); /* Utilisation de votre couleur violette */
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-section {
            text-align: center;
            padding: 2rem;
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-top: 1rem;
            color: var(--dark-color);
        }

        .modal-photo {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.8);
        }

        .modal-content {
            margin: 10% auto;
            display: block;
            max-width: 80%;
            max-height: 80%;
            border: 3px solid var(--accent-color); /* Utilisation de votre couleur violette */
            border-radius: 10px;
        }
    </style>
</head>
<body>
    
   <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar" id="sidebar">
        <h4>Menu Étudiant</h4>
        <a href="{{route('etudiant.dashboardetd')}}" class="active">
            <i class="fas fa-home"></i> Accueil
        </a>
        <a href="{{route('cours.index')}}">
            <i class="fas fa-book"></i>Cours publiés
        </a>
        <a href="{{route('etudiant.cours')}}">
            <i class="fas fa-book"></i> Mes cours
        </a>
        
        <a href="{{ route('etudiant.evaluations.index') }}" class="{{ request()->routeIs('etudiant.evaluations.*') ? 'active' : '' }}">
            <i class="fas fa-clipboard-check me-2"></i>Évaluations
        </a>
        <a href="{{ route('etudiant.notes') }}">
            <i class="fas fa-clipboard-list"></i> Notes
        </a>
        <a href="{{route('etudiant.formulaires.index')}}">
            <i class="fas fa-file-alt"></i>Formulaires
        </a>
        <a href="{{ route('etudiant.reclamations') }}">
            <i class="fas fa-envelope"></i> Réclamations
        </a>
        <a href="{{ route('etudiant.messagerie.index') }}">
            <i class="fas fa-comments"></i> Messagerie
        </a>
        <a href="{{ route('etudiant.parametres') }}">
            <i class="fas fa-cog"></i> Paramètres
        </a>

        <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>

    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Menu Étudiant</h4>
        <a href="{{ route('etudiant.dashboardetd') }}">
            <i class="fas fa-home"></i> Accueil
        </a>
        <a href="{{ route('cours.index') }}">
            <i class="fas fa-book"></i> Cours publiés
        </a>
        <a href="{{ route('etudiant.cours') }}">
            <i class="fas fa-book-open"></i> Mes cours
        </a>
         <a href="{{ route('etudiant.evaluations.index') }}">

                    <i class="fas fa-clipboard-check"></i> Évaluations
                    </a>
        <a href="{{ route('etudiant.notes') }}" class="active">
            <i class="fas fa-clipboard-list"></i> Notes
        </a>
        <a href="{{ route('etudiant.formulaires.index') }}">
            <i class="fas fa-file-alt"></i> Formulaires
        </a>
        <a href="{{ route('etudiant.reclamations') }}">
            <i class="fas fa-exclamation-circle"></i> Réclamations
        </a>
        <a href="{{ route('etudiant.messagerie.index') }}">
            <i class="fas fa-comments"></i> Messagerie
        </a>
        <a href="{{ route('etudiant.parametres') }}">
            <i class="fas fa-cog"></i> Paramètres
        </a>
       <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>

    <div class="main-content">
        <div class="notes-container">
            <div class="notes-card card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-clipboard-list me-2"></i>Mes Notes de Cours</span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Formulaire d'ajout/modification -->
                    <form id="noteForm" method="POST" action="{{ isset($note) ? route('etudiant.notes.update', $note->id) : route('etudiant.notes.store') }}">
                        @csrf
                        @if(isset($note))
                            @method('PUT')
                        @endif
                        <div class="form-group mb-4">
                            <label for="contenu" class="form-label fw-bold mb-3">Contenu de la note</label>
                            <div id="editor">
                                {!! isset($note) ? $note->contenu : old('contenu', '') !!}
                            </div>
                            <textarea class="form-control d-none @error('contenu') is-invalid @enderror" id="contenu" name="contenu" rows="5" required>{{ old('contenu', isset($note) ? $note->contenu : '') }}</textarea>
                            @error('contenu')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            @if(isset($note))
                                <a href="{{ route('etudiant.notes.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                            @endif
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>{{ isset($note) ? 'Mettre à jour' : 'Enregistrer' }}
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <!-- Liste des notes existantes -->
                    <h5 class="mb-3 fw-bold"><i class="fas fa-list-ul me-2"></i>Mes notes enregistrées</h5>
                    
                    @if(!isset($notes) || $notes->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Aucune note enregistrée pour le moment.
                        </div>
                    @else
                        <div class="list-group">
                            @foreach($notes as $noteItem)
                                <div class="list-group-item note-item">
                                    <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                                        <small class="text-muted">
                                            <i class="far fa-calendar me-1"></i>Créée le {{ $noteItem->created_at->format('d/m/Y H:i') }}
                                        </small>
                                        <div class="btn-group">
                                            <a href="{{ route('etudiant.notes.edit', $noteItem->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('etudiant.notes.destroy', $noteItem->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="note-content mt-2 mb-1">
                                        {!! $noteItem->contenu !!}
                                    </div>
                                    @if($noteItem->updated_at != $noteItem->created_at)
                                        <small class="text-muted d-block mt-2">
                                            <i class="fas fa-history me-1"></i>Modifiée le {{ $noteItem->updated_at->format('d/m/Y H:i') }}
                                        </small>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
       document.addEventListener('DOMContentLoaded', function() {
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        },
        placeholder: 'Saisissez votre note ici...',
    });

    // Initialisation plus robuste du contenu
    const textarea = document.getElementById('contenu');
    if (textarea.value.trim() !== '') {
        try {
            quill.root.innerHTML = textarea.value;
        } catch (e) {
            console.error('Erreur initialisation Quill:', e);
        }
    }

    // Gestion améliorée de la soumission
    const form = document.getElementById('noteForm');
    form.addEventListener('submit', function(e) {
        // Double vérification du contenu
        const htmlContent = quill.root.innerHTML;
        const plainText = quill.getText().trim();
        
        if (plainText.length < 1) {
            e.preventDefault();
            showAlert('Le contenu de la note ne peut pas être vide');
            return false;
        }
        
        // Transfert du contenu vers le textarea
        textarea.value = htmlContent;
        
        // Debug: affiche le contenu qui sera envoyé
        console.log('Contenu à envoyer:', htmlContent);
        
        return true;
    });

    function showAlert(message) {
        let alertDiv = form.querySelector('.alert-danger');
        if (!alertDiv) {
            alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger mt-3';
            form.insertBefore(alertDiv, form.firstChild);
        }
        alertDiv.innerHTML = `<i class="fas fa-exclamation-circle me-2"></i>${message}`;
    }
});
</script>
</body>
</html>