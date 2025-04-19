<form action="{{ route('reclamations.store') }}" method="POST">
    @csrf
    <input type="hidden" name="type" value="{{ $type }}"> <!-- Défini dans le contrôleur -->
    
    <div class="form-group">
        <label>Destinataire</label>
        <select name="destinataire_id" class="form-control" required>
            @foreach($destinataires as $dest)
                <option value="{{ $dest->id }}">{{ $dest->nom }}</option>
            @endforeach
        </select>
        <input type="hidden" name="destinataire_type" value="{{ $destinataireType }}">
    </div>
    
    <div class="form-group">
        <label>Contenu</label>
        <textarea name="contenu" class="form-control" required></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>