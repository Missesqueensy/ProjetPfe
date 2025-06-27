<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaires - Plateforme Étudiante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">
       <style>
        .form-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .badge-question {
            background-color: #0d6efd;
        }
        .badge-explication {
            background-color: #198754;
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

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-share-alt me-2"></i> Formulaires partagés</h2>
        <a href="{{ route('etudiant.formulaires.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Retour
        </a>
    </div>

    @if($formulaires->count() > 0)
        <div class="row">
            @foreach($formulaires as $formulaire)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $formulaire->titre }}</h5>
                            <p class="card-text">{{ Str::limit($formulaire->contenu, 100) }}</p>
                            <p class="text-muted small">
                                Par {{ $formulaire->etudiant->nom }} {{ $formulaire->etudiant->prenom }}
                            </p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('etudiant.formulaires.show', $formulaire->id_formulaire) }}" 
                               class="btn btn-sm btn-primary">
                                Voir le formulaire
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $formulaires->links() }}
        </div>
    @else
        <div class="alert alert-info">
            Aucun formulaire partagé disponible pour le moment.
        </div>
    @endif
</div>
</body>
</html>