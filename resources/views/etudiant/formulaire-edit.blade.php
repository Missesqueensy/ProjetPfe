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

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Modifier le Formulaire</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('etudiant.formulaires.update', $formulaire->id_formulaire) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre</label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                                   id="titre" name="titre" value="{{ old('titre', $formulaire->titre) }}" required>
                            @error('titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                    id="type" name="type" required>
                                <option value="question" {{ $formulaire->type == 'question' ? 'selected' : '' }}>Question</option>
                                <option value="explication" {{ $formulaire->type == 'explication' ? 'selected' : '' }}>Explication</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contenu" class="form-label">Contenu</label>
                            <textarea class="form-control @error('contenu') is-invalid @enderror" 
                                      id="contenu" name="contenu" rows="8" required>{{ old('contenu', $formulaire->contenu) }}</textarea>
                            @error('contenu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('etudiant.formulaires.show', $formulaire->id_formulaire) }}" 
                               class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialisation d'un éditeur de texte riche (optionnel)
    document.addEventListener('DOMContentLoaded', function() {
        // SimpleMDE ou autre éditeur peut être initialisé ici
        // new SimpleMDE({ element: document.getElementById('contenu') });
    });
</script>
@endpush
</body>
</html>