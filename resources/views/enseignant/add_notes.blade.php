
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant - Mes Cours</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    
    <!-- Meta pour le référencement et les réseaux sociaux -->
    <meta name="description" content="Gestion des cours pour enseignants">
    <meta property="og:title" content="Dashboard Enseignant">
    <meta property="og:description" content="Plateforme de gestion des cours pour enseignants">
</head>

<body
<div class="dashboard-container">
        <div class="container">
            <h2>Ajouter des notes pour l'évaluation: {{ $evaluation->titre }}</h2>
            <p class="text-muted">Cours: {{ $evaluation->cours->titre }} | Classe: {{ $evaluation->classe->nom ?? 'SMI' }}</p>

            @if($evaluation->classe)
                <form action="{{ route('enseignant.notes.store', $evaluation->id_evaluation) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_evaluation" value="{{ $evaluation->id_evaluation }}">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Note (sur {{ $evaluation->bareme_total }})</th>
                                    <th>Commentaire</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($evaluation->classe->etudiants as $etudiant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $etudiant->nom }}</td>
                                    <td>{{ $etudiant->prenom }}</td>
                                    <td>
                                        <input type="number" 
                                               name="notes[{{ $etudiant->id_etudiant }}][valeur]" 
                                               class="form-control" 
                                               min="0" 
                                               max="{{ $evaluation->bareme_total }}" 
                                               step="0.01"
                                               value="{{ optional($etudiant->notes->where('id_evaluation', $evaluation->id_evaluation)->first())->valeur }}">
                                    </td>
                                    <td>
                                        <textarea name="notes[{{ $etudiant->id_etudiant }}][commentaire]" 
                                                  class="form-control">{{ optional($etudiant->notes->where('id_evaluation', $evaluation->id_evaluation)->first())->commentaire }}</textarea>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucun étudiant dans cette classe</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <label for="statut">Statut des notes</label>
                        <select name="statut" id="statut" class="form-control">
                            <option value="en_attente">En attente</option>
                            <option value="corrige">Corrigé</option>
                            <option value="publie">Publié</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer les notes
                        </button>
                        <a href="{{ route('enseignant.evaluations.show', $evaluation->id_evaluation) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </form>
            @else
                <!--<div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    Cette évaluation n'est associée à aucune classe. Impossible d'ajouter des notes.
                    <a href="{{ route('enseignant.evaluations.edit', $evaluation->id_evaluation) }}" class="alert-link">
                        Modifier l'évaluation
                    </a>
                </div>->
            @endif
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>