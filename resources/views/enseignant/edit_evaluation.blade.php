<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title style="color:#c433ff;">Profil Enseignant - {{ Auth::guard('enseignant')->user()->prenom }} {{ Auth::guard('enseignant')->user()->nom }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">

    <meta name="description" content="Page de profil de l'enseignant">
    <meta property="og:title" content="Profil Enseignant">
    <meta property="og:description" content="Page de gestion du profil pour enseignants">
</head>

<body>

<div class="dashboard-container">
    <!-- Sidebar --
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{ asset('assets/img/logosvg.svg') }}" width="50" alt="Logo de l'établissement" loading="lazy">
                <div class="brand-icons">
                    <span class="las la-user-circle"></span>
                </div>
            </div>
        </div>
        
        <div class="sidebar-user">
            <img src="{{ Auth::guard('enseignant')->user()->image ? asset('storage/images/' . Auth::guard('enseignant')->user()->image) : asset('assets/img/user.jpeg') }}" 
                 width="50" height="50" alt="Photo de profil" class="rounded-circle" loading="lazy">
            <div>
                <span>{{ Auth::guard('enseignant')->user()->prenom }} {{ Auth::guard('enseignant')->user()->nom }}</span>
                <small class="text-muted d-block">{{ Auth::guard('enseignant')->user()->email }}</small>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <ul>
                <li class="active">
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
                <li>
                    <a href="{{route('enseignant.evaluations.index')}}">
                        <span class="las la-clipboard-list"></span>
                        Évaluations
                    </a>
                </li>
              
                <li>
                    <a href="">
                        <span class="la la-check-circle"></span>
                     Résultats étudiants
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-chalkboard-teacher"></span>
                        Réclamations
                       </a>
                </li>
                <li>
                    <a href="{{ route('Enseignant.emails') }}">
                    <span class="las la-envelope"></span>
                      boîte e-mails
                    </a>
                </li>
                <li>
                    <a href="{{ route('enseignant.logout') }}">
                        <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
                            <span class="las la-sign-out-alt"></span>
                            Déconnexion
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content --
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

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0">
                <span class="las la-edit text-primary"></span> Modifier l'évaluation : {{ $evaluation->titre }}
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.evaluations.index') }}">Évaluations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Édition</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('enseignant.evaluations.update', $evaluation->id_evaluation) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Colonne de gauche --
                    <div class="col-md-6">
                        <!-- Titre --
                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre *</label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                                   id="titre" name="titre" value="{{ old('titre', $evaluation->titre) }}" required>
                            @error('titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Cours associé --
                        <div class="mb-3">
                            <label for="id_cours" class="form-label">Cours *</label>
                            <select class="form-select @error('id_cours') is-invalid @enderror" 
                                    id="id_cours" name="id_cours" required>
                                @foreach($cours as $id => $titre)
                                    <option value="{{ $id }}" {{ old('id_cours', $evaluation->id_cours) == $id ? 'selected' : '' }}>
                                        {{ $titre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_cours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Type --
                        <div class="mb-3">
                            <label for="type" class="form-label">Type *</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                @foreach($types as $key => $value)
                                    <option value="{{ $key }}" {{ old('type', $evaluation->type) == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                          <!--classe--
                          <div class="mb-3">
    <label for="classe_id" class="form-label">Classe</label>
    <select name="classe_id" id="classe_id" class="form-select" required>
        <option value="">-- Sélectionner une classe --</option>
        @php
use App\Models\Classe;
@endphp

        @foreach(Classe::all() as $classe)
            <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
        @endforeach
    </select>
</div>

                        <!-- Statut --
                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut *</label>
                            <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" {{ $evaluation->estModifiable() ? '' : 'disabled' }}>
                            @php
use App\Models\Evaluation;
@endphp

                            @foreach([
                                    Evaluation::STATUT_BROUILLON => 'Brouillon',
                                    Evaluation::STATUT_PROGRAMME => 'Programmé',
                                    Evaluation::STATUT_PUBLIE => 'Publié',
                                    Evaluation::STATUT_ARCHIVE => 'Archivé'
                                ] as $key => $value)
                                    <option value="{{ $key }}" {{ old('statut', $evaluation->statut) == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @if(!$evaluation->estModifiable())
                                <input type="hidden" name="statut" value="{{ $evaluation->statut }}">
                                <small class="text-muted d-block">Le statut ne peut plus être modifié pour cette évaluation.</small>
                            @endif
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Colonne de droite --
                    <div class="col-md-6">
                        <!-- Date --
                        <div class="mb-3">
                            <label for="date_evaluation" class="form-label">Date de l'évaluation *</label>
                            <input type="datetime-local" class="form-control @error('date_evaluation') is-invalid @enderror" 
                                   id="date_evaluation" name="date_evaluation"
                                   value="{{ old('date_evaluation', $evaluation->date_evaluation ? $evaluation->date_evaluation->format('Y-m-d\TH:i') : '') }}" 
                                   required>
                            @error('date_evaluation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Durée --
                        <div class="mb-3">
                            <label for="duree_minutes" class="form-label">Durée (minutes) *</label>
                            <input type="number" class="form-control @error('duree_minutes') is-invalid @enderror" 
                                   id="duree_minutes" name="duree_minutes" min="1" max="360"
                                   value="{{ old('duree_minutes', $evaluation->duree_minutes) }}" 
                                   required {{ $evaluation->estModifiable() ? '' : 'readonly' }}>
                            @error('duree_minutes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Barème --
                        <div class="mb-3">
                            <label for="bareme_total" class="form-label">Barème total *</label>
                            <input type="number" step="0.01" min="1" max="100" 
                                   class="form-control @error('bareme_total') is-invalid @enderror" 
                                   id="bareme_total" name="bareme_total" 
                                   value="{{ old('bareme_total', $evaluation->bareme_total) }}" required>
                            @error('bareme_total')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fichier --
                        <div class="mb-3">
                            <label for="fichier_consigne" class="form-label">Nouveau fichier de consigne</label>
                            <input type="file" class="form-control @error('fichier_consigne') is-invalid @enderror" 
                                   id="fichier_consigne" name="fichier_consigne" accept=".pdf">
                            @error('fichier_consigne')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format PDF uniquement - Max 5MB</small>
                            
                            @if($evaluation->fichier_consigne)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/'.$evaluation->fichier_consigne) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-file-pdf"></i> Voir le fichier actuel
                                    </a>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="remove_file" name="remove_file" value="1">
                                        <label class="form-check-label text-danger" for="remove_file">
                                            Supprimer le fichier actuel
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Description --
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $evaluation->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Actions --
                <div class="d-flex justify-content-between">
                    <a href="{{ route('enseignant.evaluations.show', $evaluation->id_evaluation) }}" class="btn btn-secondary">
                        <i class="las la-times"></i> Annuler
                    </a>
                    <div>
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="las la-save"></i> Enregistrer
                        </button>
                        @if($evaluation->estModifiable())
                            <a href="{{ route('enseignant.evaluations.index', $evaluation->id_evaluation) }}" class="btn btn-success">
                                <i class="las la-check-circle"></i> Publier
                            </a>
                           
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date_evaluation');
    const dureeInput = document.getElementById('duree_minutes');
    
    function updateDateLimite() {
        if(dateInput.value && dureeInput.value) {
            const date = new Date(dateInput.value);
            date.setMinutes(date.getMinutes() + parseInt(dureeInput.value));
        }
    }
    
    dateInput.addEventListener('change', updateDateLimite);
    dureeInput.addEventListener('input', updateDateLimite);
});
</script>
@endsection
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Évaluation - {{ Auth::guard('enseignant')->user()->prenom }} {{ Auth::guard('enseignant')->user()->nom }}</title>
    
    <!-- CSS --
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    
    <!-- Meta --
    <meta name="description" content="Modification d'évaluation">
</head>

<body>
<div class="dashboard-container">
    <!-- Sidebar --
    @include('enseignant.partials.sidebar') <!-- Extrait le sidebar dans un partial -->

    <!-- Main Content --
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

        <div class="container-fluid">
            <!-- En-tête et fil d'ariane --
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3 mb-0">
                        <span class="las la-edit text-primary"></span> Modifier l'évaluation : {{ $evaluation->titre }}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('enseignant.dashboard') }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('enseignant.evaluations.index') }}">Évaluations</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Édition</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Messages d'alerte --
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Carte principale --
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('enseignant.evaluations.update', $evaluation->id_evaluation) }}" method="POST" enctype="multipart/form-data" id="evaluationForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Colonne de gauche --
                            <div class="col-md-6">
                                <!-- Titre --
                                <div class="mb-3">
                                    <label for="titre" class="form-label">Titre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                                           id="titre" name="titre" value="{{ old('titre', $evaluation->titre) }}" required>
                                    @error('titre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Cours associé --
                                <div class="mb-3">
                                    <label for="id_cours" class="form-label">Cours <span class="text-danger">*</span></label>
                                    <select class="form-select @error('id_cours') is-invalid @enderror" 
                                            id="id_cours" name="id_cours" required>
                                        <option value="">-- Sélectionnez un cours --</option>
                                        @foreach($cours as $id => $titre)
                                            <option value="{{ $id }}" {{ old('id_cours', $evaluation->id_cours) == $id ? 'selected' : '' }}>
                                                {{ $titre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_cours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Classe --
                                <div class="mb-3">
                                    <label for="classe_id" class="form-label">Classe <span class="text-danger">*</span></label>
                                    <select name="classe_id" id="classe_id" class="form-select @error('classe_id') is-invalid @enderror" required>
                                        <option value="">-- Sélectionner une classe --</option>
                                        @foreach($classes as $classe)
                                            <option value="{{ $classe->id }}" {{ old('classe_id', $evaluation->classe_id) == $classe->id ? 'selected' : '' }}>
                                                {{ $classe->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('classe_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Colonne de droite --
                            <div class="col-md-6">
                                <!-- Type --
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                        @foreach($types as $key => $value)
                                            <option value="{{ $key }}" {{ old('type', $evaluation->type) == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Statut --
                                <div class="mb-3">
                                    <label for="statut" class="form-label">Statut <span class="text-danger">*</span></label>
                                    <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" {{ $evaluation->estModifiable() ? '' : 'disabled' }}>
                                        @foreach([
                                            App\Models\Evaluation::STATUT_BROUILLON => 'Brouillon',
                                            App\Models\Evaluation::STATUT_PROGRAMME => 'Programmé',
                                            App\Models\Evaluation::STATUT_PUBLIE => 'Publié',
                                            App\Models\Evaluation::STATUT_ARCHIVE => 'Archivé'
                                        ] as $key => $value)
                                            <option value="{{ $key }}" {{ old('statut', $evaluation->statut) == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if(!$evaluation->estModifiable())
                                        <input type="hidden" name="statut" value="{{ $evaluation->statut }}">
                                        <small class="text-muted d-block mt-1">Le statut ne peut plus être modifié pour cette évaluation.</small>
                                    @endif
                                    @error('statut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Barème --
                                <div class="mb-3">
                                    <label for="bareme_total" class="form-label">Barème total <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="1" max="100" 
                                           class="form-control @error('bareme_total') is-invalid @enderror" 
                                           id="bareme_total" name="bareme_total" 
                                           value="{{ old('bareme_total', $evaluation->bareme_total) }}" required>
                                    @error('bareme_total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <!-- Date --
                                <div class="mb-3">
                                    <label for="date_evaluation" class="form-label">Date de l'évaluation <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control @error('date_evaluation') is-invalid @enderror" 
                                           id="date_evaluation" name="date_evaluation"
                                           value="{{ old('date_evaluation', $evaluation->date_evaluation ? $evaluation->date_evaluation->format('Y-m-d\TH:i') : '') }}" 
                                           required>
                                    @error('date_evaluation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Durée --
                                <div class="mb-3">
                                    <label for="duree_minutes" class="form-label">Durée (minutes) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('duree_minutes') is-invalid @enderror" 
                                           id="duree_minutes" name="duree_minutes" min="1" max="360"
                                           value="{{ old('duree_minutes', $evaluation->duree_minutes) }}" 
                                           required {{ $evaluation->estModifiable() ? '' : 'readonly' }}>
                                    @error('duree_minutes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Fichier --
                        <div class="mb-3">
                            <label for="fichier_consigne" class="form-label">Nouveau fichier de consigne</label>
                            <input type="file" class="form-control @error('fichier_consigne') is-invalid @enderror" 
                                   id="fichier_consigne" name="fichier_consigne" accept=".pdf">
                            @error('fichier_consigne')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format PDF uniquement - Max 5MB</small>
                            
                            @if($evaluation->fichier_consigne)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/'.$evaluation->fichier_consigne) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-file-pdf"></i> Voir le fichier actuel
                                    </a>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="remove_file" name="remove_file" value="1">
                                        <label class="form-check-label text-danger" for="remove_file">
                                            Supprimer le fichier actuel
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Description --
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description', $evaluation->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Actions --
                        <div class="d-flex justify-content-between border-top pt-3">
                            <a href="{{ route('enseignant.evaluations.index') }}" class="btn btn-secondary">
                                <i class="las la-times"></i> Annuler
                            </a>
                            <div>
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="las la-save"></i> Enregistrer les modifications
                                </button>
                                @if($evaluation->estModifiable())
                                    <button type="button" class="btn btn-success" id="publishBtn">
                                        <i class="las la-check-circle"></i> Publier
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts --
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Calcul de la date limite
    const dateInput = document.getElementById('date_evaluation');
    const dureeInput = document.getElementById('duree_minutes');
    
    function updateDateLimite() {
        if(dateInput.value && dureeInput.value) {
            const date = new Date(dateInput.value);
            date.setMinutes(date.getMinutes() + parseInt(dureeInput.value));
        }
    }
    
    dateInput.addEventListener('change', updateDateLimite);
    dureeInput.addEventListener('input', updateDateLimite);

    // Bouton Publier
    const publishBtn = document.getElementById('publishBtn');
    if (publishBtn) {
        publishBtn.addEventListener('click', function() {
            document.getElementById('statut').value = '{{ App\Models\Evaluation::STATUT_PUBLIE }}';
            document.getElementById('evaluationForm').submit();
        });
    }

    // Validation avant soumission
    const form = document.getElementById('evaluationForm');
    form.addEventListener('submit', function(e) {
        // Vous pouvez ajouter ici une validation supplémentaire si nécessaire
        // Par exemple vérifier que la date est dans le futur
        const selectedDate = new Date(dateInput.value);
        const now = new Date();
        
        if (selectedDate < now) {
            e.preventDefault();
            alert('La date de l\'évaluation doit être dans le futur');
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
    <title>Modifier Évaluation - {{ $evaluation->titre }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">

    <style>
        .file-preview {
            max-height: 200px;
            border: 1px dashed #dee2e6;
            border-radius: 4px;
            padding: 10px;
        }
        .form-section {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
    </style>
</head>

<body>
<div class="dashboard-container">
    <!-- Sidebar (identique à show_evaluation) -->
    @include('enseignant.partials.sidebar')

    <div class="main-content">
        <header class="sticky-top bg-white shadow-sm">
            <div class="container-fluid py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="menu-toggle">
                        <button class="btn btn-outline-secondary sidebar-toggle">
                            <i class="las la-bars"></i>
                        </button>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="me-3 d-none d-md-inline">Bonjour, {{ Auth::guard('enseignant')->user()->prenom }}</span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="las la-user-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('enseignant.dashboard') }}">Mon profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="{{ route('enseignant.logout') }}">Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-fluid py-4">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.evaluations.index') }}">Évaluations</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.evaluations.show', $evaluation->id_evaluation) }}">{{ Str::limit($evaluation->titre, 20) }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="fas fa-edit text-primary me-2"></i>
                    Modifier l'évaluation
                </h1>
                <div>
                    <a href="{{ route('enseignant.evaluations.show', $evaluation->id_evaluation) }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-times me-1"></i> Annuler
                    </a>
                    <button type="submit" form="editEvaluationForm" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Enregistrer
                    </button>
                </div>
            </div>

            <div class="card border-0 shadow">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">{{ $evaluation->titre }}</h5>
                </div>
                
                <form id="editEvaluationForm" action="{{ route('enseignant.evaluations.update', $evaluation->id_evaluation) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <!-- Section Informations de base -->
                        <div class="form-section">
                            <h5 class="mb-4">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Informations de base
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="titre" class="form-label required-field">Titre</label>
                                    <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                                           id="titre" name="titre" value="{{ old('titre', $evaluation->titre) }}" required>
                                    @error('titre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="type" class="form-label required-field">Type</label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="examen" {{ old('type', $evaluation->type) == 'examen' ? 'selected' : '' }}>Examen</option>
                                        <option value="devoir" {{ old('type', $evaluation->type) == 'devoir' ? 'selected' : '' }}>Devoir</option>
                                        <option value="quiz" {{ old('type', $evaluation->type) == 'quiz' ? 'selected' : '' }}>Quiz</option>
                                        <option value="projet" {{ old('type', $evaluation->type) == 'projet' ? 'selected' : '' }}>Projet</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="id_cours" class="form-label required-field">Cours</label>
                                    <select class="form-select @error('id_cours') is-invalid @enderror" id="id_cours" name="id_cours" required>
                                        @foreach($cours as $id => $titre)
                                            <option value="{{ $id }}" {{ old('id_cours', $evaluation->id_cours) == $id ? 'selected' : '' }}>
                                                {{ $titre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_cours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="id_classe" class="form-label required-field">Classe</label>
                                    <select class="form-select @error('id_classe') is-invalid @enderror" id="id_classe" name="id_classe" required>
                                        @foreach($classes as $id => $nom)
                                            <option value="{{ $id }}" {{ old('id_classe', $evaluation->id_classe) == $id ? 'selected' : '' }}>
                                                {{ $nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_classe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4">{{ old('description', $evaluation->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Section Dates et paramètres -->
                        <div class="form-section">
                            <h5 class="mb-4">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                Dates et paramètres
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="date_publication" class="form-label required-field">Date de publication</label>
                                    <input type="datetime-local" class="form-control @error('date_publication') is-invalid @enderror" 
                                           id="date_publication" name="date_publication"
                                           value="{{ old('date_publication', $evaluation->date_publication->format('Y-m-d\TH:i')) }}" required>
                                    @error('date_publication')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="date_debut" class="form-label required-field">Date de début</label>
                                    <input type="datetime-local" class="form-control @error('date_debut') is-invalid @enderror" 
                                           id="date_debut" name="date_debut"
                                           value="{{ old('date_debut', $evaluation->date_debut->format('Y-m-d\TH:i')) }}" required>
                                    @error('date_debut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="date_limite" class="form-label required-field">Date limite</label>
                                    <input type="datetime-local" class="form-control @error('date_limite') is-invalid @enderror" 
                                           id="date_limite" name="date_limite"
                                           value="{{ old('date_limite', $evaluation->date_limite->format('Y-m-d\TH:i')) }}" required>
                                    @error('date_limite')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="duree_minutes" class="form-label required-field">Durée (minutes)</label>
                                    <input type="number" class="form-control @error('duree_minutes') is-invalid @enderror" 
                                           id="duree_minutes" name="duree_minutes" min="1" max="360"
                                           value="{{ old('duree_minutes', $evaluation->duree_minutes) }}" required>
                                    @error('duree_minutes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="bareme_total" class="form-label required-field">Barème total</label>
                                    <input type="number" step="0.01" class="form-control @error('bareme_total') is-invalid @enderror" 
                                           id="bareme_total" name="bareme_total" min="1"
                                           value="{{ old('bareme_total', $evaluation->bareme_total) }}" required>
                                    @error('bareme_total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="statut" class="form-label required-field">Statut</label>
                                    <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                                        <option value="brouillon" {{ old('statut', $evaluation->statut) == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                        <option value="programme" {{ old('statut', $evaluation->statut) == 'programme' ? 'selected' : '' }}>Programmé</option>
                                        <option value="en_cours" {{ old('statut', $evaluation->statut) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                        <option value="corrige" {{ old('statut', $evaluation->statut) == 'corrige' ? 'selected' : '' }}>Corrigé</option>
                                        <option value="archive" {{ old('statut', $evaluation->statut) == 'archive' ? 'selected' : '' }}>Archivé</option>
                                    </select>
                                    @error('statut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section Fichiers -->
                        <div class="form-section">
                            <h5 class="mb-4">
                                <i class="fas fa-paperclip text-primary me-2"></i>
                                Fichiers associés
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fichier_consigne" class="form-label">Fichier de consignes (PDF)</label>
                                    <input type="file" class="form-control @error('fichier_consigne') is-invalid @enderror" 
                                           id="fichier_consigne" name="fichier_consigne" accept=".pdf">
                                    @error('fichier_consigne')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    @if($evaluation->fichier_consigne)
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/'.$evaluation->fichier_consigne) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-pdf me-1"></i> Voir le fichier actuel
                                            </a>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" id="remove_fichier_consigne" name="remove_fichier_consigne" value="1">
                                                <label class="form-check-label" for="remove_fichier_consigne">
                                                    Supprimer ce fichier
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="fichier_correction" class="form-label">Fichier de correction (PDF)</label>
                                    <input type="file" class="form-control @error('fichier_correction') is-invalid @enderror" 
                                           id="fichier_correction" name="fichier_correction" accept=".pdf">
                                    @error('fichier_correction')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    @if($evaluation->fichier_correction)
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/'.$evaluation->fichier_correction) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-file-pdf me-1"></i> Voir le fichier actuel
                                            </a>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" id="remove_fichier_correction" name="remove_fichier_correction" value="1">
                                                <label class="form-check-label" for="remove_fichier_correction">
                                                    Supprimer ce fichier
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white d-flex justify-content-between">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="fas fa-undo me-1"></i> Réinitialiser
                        </button>
                        <div>
                            <a href="{{ route('enseignant.evaluations.show', $evaluation->id_evaluation) }}" class="btn btn-outline-danger me-2">
                                <i class="fas fa-times me-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validation des dates
    const dateDebut = document.getElementById('date_debut');
    const dateLimite = document.getElementById('date_limite');
    
    dateDebut.addEventListener('change', function() {
        if (dateLimite.value && new Date(dateDebut.value) > new Date(dateLimite.value)) {
            alert('La date de début doit être antérieure à la date limite');
            dateDebut.value = '';
        }
    });
    
    dateLimite.addEventListener('change', function() {
        if (dateDebut.value && new Date(dateLimite.value) < new Date(dateDebut.value)) {
            alert('La date limite doit être postérieure à la date de début');
            dateLimite.value = '';
        }
    });
    
    // Toggle sidebar
    document.querySelector('.sidebar-toggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('collapsed');
        document.querySelector('.main-content').classList.toggle('expanded');
    });
});
</script>
</body>
</html>