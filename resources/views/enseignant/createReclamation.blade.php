<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant - Mes Évaluations</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <meta name="description" content="Gestion des évaluations pour enseignants">
    <meta property="og:title" content="Dashboard Enseignant - Évaluations">
    <meta property="og:description" content="Plateforme de gestion des évaluations pour enseignants">
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
                <li>
                    <a href="{{ route('enseignant.courses.index') }}">
                        <span class="las la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li class="active">
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
                    <a href="{{ route('Enseignant.emails') }}">
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
                        <button class="btn btn-outline-secondary">
                            <span class="las la-bars"></span>
                        </button>
                    </div>
                    <span class="me-3 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span> 
                </div>
            </div>
        </header>
        <form action="{{ route('enseignant.reclamations.store') }}" method="POST">
    @csrf
    
    <input type="hidden" name="type" value="{{ $type ?? 'prof_vers_etud' }}">
    
    <div class="mb-3">
        <label class="form-label">Étudiant concerné *</label>
        <select name="etudiant_id" class="form-select" required>
            <option value="">Sélectionnez un étudiant</option>
            @foreach($etudiants as $etudiant)
                <option value="{{ $etudiant->id }}">
                    {{ $etudiant->prenom }} {{ $etudiant->nom }} ({{ $etudiant->email }})
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Description détaillée *</label>
        <textarea name="contenu" class="form-control" rows="5" 
                  placeholder="Décrivez précisément la raison de votre réclamation..." required></textarea>
    </div>
    
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('enseignant.reclamations.index') }}" 
           class="btn btn-secondary">
            Annuler
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane me-1"></i> Envoyer
        </button>
    </div>
</form>
    </div>
</div>
</body>
</html>--
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une réclamation - Dashboard Enseignant</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <meta name="description" content="Gestion des évaluations pour enseignants">
    <meta property="og:title" content="Dashboard Enseignant - Évaluations">
    <meta property="og:description" content="Plateforme de gestion des évaluations pour enseignants">
    <meta name="description" content="Formulaire de création de réclamation pour enseignants">
</head>

<body>
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
                <li>
                    <a href="{{ route('enseignant.courses.index') }}">
                        <span class="las la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li class="active">
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
                    <a href="{{ route('Enseignant.emails') }}">
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
                        <button class="btn btn-outline-secondary">
                            <span class="las la-bars"></span>
                        </button>
                    </div>
                    <span class="me-3 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span> 
                </div>
            </div>
        </header>

        <div class="container-fluid py-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-circle me-2"></i>Nouvelle réclamation
                    </h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('enseignant.reclamations.store') }}" method="POST">
                        @csrf
                        
                        <input type="hidden" name="type" value="{{ $type ?? 'prof_vers_etud' }}">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Étudiant concerné <span class="text-danger">*</span></label>
                            <select name="etudiant_id" class="form-select form-select-lg" required>
                                <option value="" disabled selected>Sélectionnez un étudiant</option>
                                @foreach($etudiants as $etudiant)
                                    <option value="{{ $etudiant->id }}">
                                        {{ $etudiant->prenom }} {{ $etudiant->nom }} ({{ $etudiant->email }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Sélectionnez l'étudiant concerné par cette réclamation</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Description détaillée <span class="text-danger">*</span></label>
                            <textarea name="contenu" class="form-control" rows="8" 
                                      placeholder="Décrivez précisément la raison de votre réclamation (comportement, travail rendu, participation, etc.)..." 
                                      required></textarea>
                            <small class="text-muted">Soyez aussi précis que possible pour faciliter le traitement de votre réclamation</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pièces jointes (optionnel)</label>
                            <input type="file" class="form-control" name="pieces_jointes[]" multiple>
                            <small class="text-muted">Vous pouvez ajouter jusqu'à 3 fichiers (PDF, JPG, PNG) - 5MB max par fichier</small>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="{{ route('enseignant.reclamations.index') }}" 
                               class="btn btn-outline-secondary px-4">
                                <i class="fas fa-arrow-left me-2"></i> Retour
                            </a>
                            <div class="d-flex gap-3">
                                <button type="reset" class="btn btn-outline-danger px-4">
                                    <i class="fas fa-eraser me-2"></i> Effacer
                                </button>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-paper-plane me-2"></i> Envoyer la réclamation
                                    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="alert alert-info mt-4">
                <h6><i class="fas fa-info-circle me-2"></i>Informations importantes</h6>
                <ul class="mb-0">
                    <li>Les réclamations sont traitées dans un délai de 48h</li>
                    <li>Vous recevrez une notification par email lors de la réponse</li>
                    <li>Merci de rester courtois et professionnel dans vos échanges</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Validation simple du formulaire
    document.querySelector('form').addEventListener('submit', function(e) {
        const description = document.querySelector('textarea[name="contenu"]').value.trim();
        if (description.length < 20) {
            e.preventDefault();
            alert('Veuillez fournir une description plus détaillée (au moins 20 caractères)');
        }
    });
</script>
</body>
</html>-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une réclamation - Dashboard Enseignant</title>
    
    <!-- CSS -->
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
</head>

<body>
<!-- Supprimer un des dashboard-container -->
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
                <li>
                    <a href="{{ route('enseignant.courses.index') }}">
                        <span class="las la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li class="active">
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
                    <a href="{{ route('Enseignant.emails') }}">
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

    <!-- Contenu principal amélioré -->
    <div class="main-content">
        <header class="sticky-top bg-white shadow-sm">
            <div class="container-fluid py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="menu-toggle">
                        <button class="btn btn-outline-secondary">
                            <span class="las la-bars"></span>
                        </button>
                    </div>
                    <span class="me-3 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span> 
                </div>
            </div>
        </header>

        <div class="container-fluid py-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-circle me-2"></i>Nouvelle réclamation
                    </h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('enseignant.reclamations.store') }}" method="POST">
                        @csrf
                        
                        <!-- Champ caché pour le type -->
                        <input type="hidden" name="type" value="{{ $type ?? 'prof_vers_etud' }}">
                        
                        <!-- Sélection de l'étudiant améliorée -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Étudiant concerné <span class="text-danger">*</span></label>
                            <select name="etudiant_id" class="form-select form-select-lg" required>
                                <option value="" disabled selected>Sélectionnez un étudiant</option>
                                @foreach($etudiants as $etudiant)
                                    <option value="{{ $etudiant->id }}">
                                        {{ $etudiant->prenom }} {{ $etudiant->nom }} ({{ $etudiant->email }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Sélectionnez l'étudiant concerné par cette réclamation</small>
                        </div>
                        
                        <!-- Contenu amélioré -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Description détaillée <span class="text-danger">*</span></label>
                            <textarea name="contenu" class="form-control" rows="8" 
                                      placeholder="Décrivez précisément la raison de votre réclamation (comportement, travail rendu, participation, etc.)..." 
                                      required></textarea>
                            <small class="text-muted">Soyez aussi précis que possible pour faciliter le traitement de votre réclamation</small>
                        </div>
                        
                        <!-- Pièces jointes optionnelles -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pièces jointes (optionnel)</label>
                            <input type="file" class="form-control" name="pieces_jointes[]" multiple>
                            <small class="text-muted">Vous pouvez ajouter jusqu'à 3 fichiers (PDF, JPG, PNG) - 5MB max par fichier</small>
                        </div>
                        
                        <!-- Boutons améliorés -->
                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="{{ route('enseignant.reclamations.index') }}" 
                               class="btn btn-outline-secondary px-4">
                                <i class="fas fa-arrow-left me-2"></i> Retour
                            </a>
                            <div class="d-flex gap-3">
                                <button type="reset" class="btn btn-outline-danger px-4">
                                    <i class="fas fa-eraser me-2"></i> Effacer
                                </button>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-paper-plane me-2"></i> Envoyer la réclamation
                                    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Informations supplémentaires -->
            <div class="alert alert-info mt-4">
                <h6><i class="fas fa-info-circle me-2"></i>Informations importantes</h6>
                <ul class="mb-0">
                    <li>Les réclamations sont traitées dans un délai de 48h</li>
                    <li>Vous recevrez une notification par email lors de la réponse</li>
                    <li>Merci de rester courtois et professionnel dans vos échanges</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Scripts JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Validation simple du formulaire
    document.querySelector('form').addEventListener('submit', function(e) {
        const description = document.querySelector('textarea[name="contenu"]').value.trim();
        if (description.length < 20) {
            e.preventDefault();
            alert('Veuillez fournir une description plus détaillée (au moins 20 caractères)');
        }
    });
</script>
</body>
</html>