
@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Étudiant - 
    @auth('etudiant')
        {{ Auth::guard('etudiant')->user()->prénom }} {{ Auth::guard('etudiant')->user()->nom }}
    @else
        Profil
    @endauth
    </title>
    <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #c433ff;
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
            display: flex;
            flex-direction: column;
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

        .main-content {
            margin-left: 280px;
            padding: 2rem;
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

        /* Styles spécifiques pour les évaluations */
        .evaluation-card {
            transition: all 0.3s ease;
            border-left: 4px solid;
        }
        
        .evaluation-card.programme {
            border-left-color: #0dcaf0;
        }
        
        .evaluation-card.en_cours {
            border-left-color: #198754;
        }
        
        .evaluation-card.corrige {
            border-left-color: #ffc107;
        }
        
        .evaluation-card.archive {
            border-left-color: #6c757d;
        }
        
        .status-badge {
            font-size: 0.8rem;
            padding: 0.35rem 0.65rem;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px 15px;
            border-radius: 8px;
            width: 100%;
            margin-top: auto;
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
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
       
        

       
       
    </style>
</head>
<body>
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar">
        <h4>Menu Étudiant</h4>
        <a href="{{ route('etudiant.dashboardetd') }}" class="{{ request()->routeIs('etudiant.dashboardetd') ? 'active' : '' }}">
            <i class="fas fa-home me-2"></i>Accueil
        </a>
        <a href="{{ route('cours.index') }}" class="{{ request()->routeIs('cours.index') ? 'active' : '' }}">
            <i class="fas fa-book me-2"></i>Cours publiés
        </a>
        <a href="{{ route('etudiant.cours') }}" class="{{ request()->routeIs('etudiant.cours') ? 'active' : '' }}">
            <i class="fas fa-book-open me-2"></i>Mes cours
        </a>
        <a href="{{ route('etudiant.evaluations.index') }}" class="{{ request()->routeIs('etudiant.evaluations.*') ? 'active' : '' }}">
            <i class="fas fa-clipboard-check me-2"></i>Évaluations
        </a>
        
        <a href="{{ route('etudiant.notes') }}" class="{{ request()->routeIs('etudiant.notes') ? 'active' : '' }}">
            <i class="fas fa-clipboard-list me-2"></i>Notes
        </a>
        <a href="{{ route('etudiant.formulaires.index') }}" class="{{ request()->routeIs('etudiant.formulaires.*') ? 'active' : '' }}">
            <i class="fas fa-file-alt me-2"></i>Formulaires
        </a>
        <a href="{{ route('etudiant.reclamations') }}" class="{{ request()->routeIs('etudiant.reclamations') ? 'active' : '' }}">
            <i class="fas fa-exclamation-circle me-2"></i>Réclamations
        </a>
        <a href="{{ route('etudiant.messagerie.index') }}" class="{{ request()->routeIs('etudiant.messagerie.*') ? 'active' : '' }}">
            <i class="fas fa-comments me-2"></i>Messagerie
        </a>
        <a href="{{ route('etudiant.parametres') }}" class="{{ request()->routeIs('etudiant.parametres') ? 'active' : '' }}">
            <i class="fas fa-cog me-2"></i>Paramètres
        </a>
        <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
            </button>
        </form>
    </div>

    <div class="main-content">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3">Mes évaluations</h1>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                        Filtres
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['statut' => '']) }}">Toutes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['statut' => 'en_cours']) }}">En cours</a></li>
                        <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['statut' => 'programme']) }}">À venir</a></li>
                        <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['statut' => 'corrige']) }}">Corrigées</a></li>
                    </ul>
                </div>
            </div>

            @if($evaluations->isEmpty())
                <div class="alert alert-info">
                    Aucune évaluation disponible pour le moment.
                </div>
            @else
                <div class="row">
                    @foreach($evaluations as $evaluation)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 evaluation-card {{ $evaluation->statut }}">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{ $evaluation->titre }}</h5>
                                    <span class="badge bg-light text-dark">{{ $evaluation->type }}</span>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <span class="fw-bold">Cours :</span> {{ $evaluation->cours->nom }}<br>
                                        <span class="fw-bold">Classe :</span> {{ $evaluation->classe->nom }}<br>
                                        <span class="fw-bold">Enseignant :</span> {{ $evaluation->enseignant->nom }}
                                    </div>

                                    <p class="card-text">{{ Str::limit($evaluation->description, 150) }}</p>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-bold">Début :</span>
                                            <span>{{ Carbon::parse($evaluation->date_debut)->format('d/m/Y H:i') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-bold">Fin :</span>
                                            <span>{{ $evaluation->date_limite->format('d/m/Y H:i') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-bold">Durée :</span>
                                            <span>{{ $evaluation->duree_minutes }} minutes</span>
                                        </div>
                                    </div>

                                    @if($evaluation->fichier_consigne)
                                        <div class="mb-3">
                                            <a href="{{ Storage::url($evaluation->fichier_consigne) }}" 
                                               class="btn btn-sm btn-outline-primary"
                                               target="_blank">
                                                <i class="fas fa-file-download"></i> Télécharger le sujet
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                                    <span class="badge status-badge bg-{{ $evaluation->status_color }}">
                                        {{ $evaluation->statut_text }}
                                    </span>

                                    @php
                                        $note = $evaluation->notes->where('id_etudiant', auth()->guard('etudiant')->id())->first();
                                    @endphp

                                    @if($note)
                                        <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" 
                                           data-bs-target="#resultModal{{ $evaluation->id_evaluation }}">
                                            Voir résultat
                                        </a>

                                        <!-- Modal pour afficher le résultat -->
                                        <div class="modal fade" id="resultModal{{ $evaluation->id_evaluation }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Résultat - {{ $evaluation->titre }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <span class="fw-bold">Note :</span>
                                                            <span class="fs-4 ms-2 {{ $note->valeur >= 10 ? 'text-success' : 'text-danger' }}">
                                                                {{ $note->valeur }}/{{ $evaluation->bareme_total }}
                                                            </span>
                                                        </div>
                                                        @if($note->commentaire)
                                                            <div class="mb-3">
                                                                <span class="fw-bold">Commentaire :</span>
                                                                <p class="mt-2">{{ $note->commentaire }}</p>
                                                            </div>
                                                        @endif
                                                        @if($evaluation->fichier_correction)
                                                            <div>
                                                                <a href="{{ Storage::url($evaluation->fichier_correction) }}" 
                                                                   class="btn btn-sm btn-primary"
                                                                   target="_blank">
                                                                    <i class="fas fa-file-download"></i> Correction
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($evaluation->statut === 'corrige')
                                        <span class="text-muted">Résultat en préparation</span>
                                    @else
                                        <a href="{{ route('etudiant.evaluations.show', $evaluation->id_evaluation) }}" 
                                           class="btn btn-sm btn-primary">
                                            Détails
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $evaluations->links() }}
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.toggle('active');
                });
            }
            
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('show.bs.modal', function () {
                    // Ajoutez ici des actions supplémentaires si nécessaire
                });
            });
        });
        function toggleDropdown(element) {
            element.classList.toggle('active');
            const dropdown = element.nextElementSibling;
            dropdown.classList.toggle('show');
        }

        // Fermer le menu déroulant quand on clique ailleurs
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown-toggle') && !event.target.closest('.dropdown-menu-eval')) {
                const openDropdowns = document.querySelectorAll('.dropdown-menu-eval.show');
                openDropdowns.forEach(dropdown => {
                    dropdown.classList.remove('show');
                    dropdown.previousElementSibling.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>