<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Formulaire - Plateforme Étudiante</title>
    <title>Formulaires - Plateforme Étudiante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">

    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #0d6efd;
        }
        .btn-submit {
            width: 100%;
            padding: 10px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Menu Étudiant</h4>
        <a href="{{ route('etudiant.dashboardetd') }}">
            <i class="fas fa-home me-2"></i>Accueil
        </a>
        <a href="{{ route('cours.index') }}">
            <i class="fas fa-book me-2"></i>Cours publiés
        </a>
        <a href="{{ route('etudiant.cours') }}">
            <i class="fas fa-book-open me-2"></i>Mes cours
        </a>
        <a href="{{ route('etudiant.notes') }}">
            <i class="fas fa-clipboard-list me-2"></i>Notes
        </a>
        <a href="{{ route('etudiant.formulaires.index') }}" class="active">
            <i class="fas fa-file-alt me-2"></i>Formulaires
        </a>
        <a href="{{ route('etudiant.reclamations') }}">
            <i class="fas fa-exclamation-circle me-2"></i>Réclamations
        </a>
        <a href="{{ route('etudiant.messagerie.index') }}">
            <i class="fas fa-comments me-2"></i>Messagerie
        </a>
        <a href="{{ route('etudiant.parametres') }}">
            <i class="fas fa-cog me-2"></i>Paramètres
        </a>
        <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link text-white text-start w-100 ps-3 py-2 d-flex align-items-center">
                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
            </button>
        </form>
    </div>

    <div class="container py-5">
        <div class="form-container">
            <h2 class="form-title">Créer un nouveau formulaire</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('etudiant.formulaires.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="titre" class="form-label">Titre du formulaire *</label>
                    <input type="text" class="form-control" id="titre" name="titre" 
                           value="{{ old('titre') }}" required placeholder="Ex: Question sur le cours de mathématiques">
                </div>

                <div class="mb-4">
                    <label for="type" class="form-label">Type de formulaire *</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="">Sélectionnez un type</option>
                        <option value="question" {{ old('type') == 'question' ? 'selected' : '' }}>Question</option>
                        <option value="explication" {{ old('type') == 'explication' ? 'selected' : '' }}>Demande d'explication</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="contenu" class="form-label">Contenu détaillé *</label>
                    <textarea class="form-control" id="contenu" name="contenu" rows="8" 
                              required placeholder="Décrivez votre question ou demande en détail...">{{ old('contenu') }}</textarea>
                </div>

                <input type="hidden" name="id_etudiant" value="{{ Auth::id() }}">

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-submit">
                        Enregistrer le formulaire
                    </button>
                    <a href="{{ route('etudiant.formulaires.index') }}" class="btn btn-outline-secondary">
                        Annuler et retourner à la liste
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script optionnel pour améliorer l'expérience utilisateur
        document.addEventListener('DOMContentLoaded', function() {
            // Focus sur le premier champ
            document.getElementById('titre').focus();
            
            // Validation basique côté client
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const contenu = document.getElementById('contenu').value.trim();
                if (contenu.length < 20) {
                    alert('Le contenu doit faire au moins 20 caractères');
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Formulaire - Plateforme Étudiante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">
    <style>
        /* Styles généraux */
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
        
        /* Contenu principal */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        /* Formulaire */
        .form-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #0d6efd;
            font-weight: 600;
        }
        
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        
        .form-control, .form-select {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        textarea.form-control {
            min-height: 200px;
            resize: vertical;
        }
        
        /* Boutons */
        .btn-submit {
            width: 100%;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-outline-secondary {
            border-radius: 8px;
            padding: 12px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h4>Menu Étudiant</h4>
        <a href="{{ route('etudiant.dashboardetd') }}">
            <i class="fas fa-home me-2"></i>Accueil
        </a>
        <a href="{{ route('cours.index') }}">
            <i class="fas fa-book me-2"></i>Cours publiés
        </a>
        <a href="{{ route('etudiant.cours') }}">
            <i class="fas fa-book-open me-2"></i>Mes cours
        </a>
        <a href="{{ route('etudiant.evaluations.index') }}">

                    <i class="fas fa-clipboard-check"></i> Évaluations
                    </a>
        <a href="{{ route('etudiant.notes') }}">
            <i class="fas fa-clipboard-list me-2"></i>Notes
        </a>
        <a href="{{ route('etudiant.formulaires.index') }}" class="active">
            <i class="fas fa-file-alt me-2"></i>Formulaires
        </a>
        <a href="{{ route('etudiant.reclamations') }}">
            <i class="fas fa-exclamation-circle me-2"></i>Réclamations
        </a>
        <a href="{{ route('etudiant.messagerie.index') }}">
            <i class="fas fa-comments me-2"></i>Messagerie
        </a>
        <a href="{{ route('etudiant.parametres') }}">
            <i class="fas fa-cog me-2"></i>Paramètres
        </a>
        <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link text-white text-start w-100 ps-3 py-2 d-flex align-items-center">
                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container py-5">
            <div class="form-container">
                <h2 class="form-title">Créer un nouveau formulaire</h2>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <h5 class="alert-heading">Erreurs de validation</h5>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('etudiant.formulaires.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="titre" class="form-label">Titre du formulaire *</label>
                        <input type="text" class="form-control" id="titre" name="titre" 
                               value="{{ old('titre') }}" required placeholder="Ex: Question sur le cours de mathématiques">
                        <div class="form-text">Donnez un titre clair et concis à votre formulaire</div>
                    </div>

                    <div class="mb-4">
                        <label for="type" class="form-label">Type de formulaire *</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Sélectionnez un type</option>
                            <option value="question" {{ old('type') == 'question' ? 'selected' : '' }}>Question</option>
                            <option value="explication" {{ old('type') == 'explication' ? 'selected' : '' }}>Demande d'explication</option>
                            <option value="autre" {{ old('type') == 'autre' ? 'selected' : '' }}>Autre demande</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="contenu" class="form-label">Contenu détaillé *</label>
                        <textarea class="form-control" id="contenu" name="contenu" rows="8" 
                                  required placeholder="Décrivez votre question ou demande en détail...">{{ old('contenu') }}</textarea>
                        <div class="form-text">Soyez aussi précis que possible pour faciliter le traitement de votre demande</div>
                    </div>

                    <input type="hidden" name="id_etudiant" value="{{ Auth::id() }}">

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="fas fa-save me-2"></i>Enregistrer le formulaire
                        </button>
                        <a href="{{ route('etudiant.formulaires.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Annuler et retourner à la liste
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Focus sur le premier champ
            document.getElementById('titre').focus();
            
            // Validation basique côté client
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const contenu = document.getElementById('contenu').value.trim();
                if (contenu.length < 20) {
                    alert('Le contenu doit faire au moins 20 caractères');
                    e.preventDefault();
                }
            });
            
            // Compteur de caractères pour le contenu
            const contenuTextarea = document.getElementById('contenu');
            const contenuLabel = document.querySelector('label[for="contenu"]');
            const charCounter = document.createElement('small');
            charCounter.className = 'float-end text-muted';
            contenuLabel.appendChild(charCounter);
            
            contenuTextarea.addEventListener('input', function() {
                const remaining = 20 - this.value.trim().length;
                charCounter.textContent = remaining > 0 ? 
                    `${remaining} caractères minimum requis` : 
                    'Longueur suffisante';
                charCounter.style.color = remaining > 0 ? '#dc3545' : '#28a745';
            });
        });
    </script>
</body>
</html>