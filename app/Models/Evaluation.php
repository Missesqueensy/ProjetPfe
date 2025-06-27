<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Question;
use App\Models\Note;
use App\Models\Classe;

class Evaluation extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id_evaluation';
    protected $dates = ['date_publication', 'date_debut', 'date_limite'];

    protected $fillable = [
        'titre',
        'description',
        'type',
        'date_publication',
        'date_debut',
        'date_limite',
        'duree_minutes',
        'bareme_total',
        'est_visible',
        'statut',
        'fichier_consigne',
        'fichier_correction',
        'id_cours',
        'id_enseignant',
        'id_classe'
    ];
    const STATUT_BROUILLON = 'brouillon';
    const STATUT_PROGRAMME = 'programme';
    const STATUT_PUBLIE = 'publie';
    const STATUT_ARCHIVE = 'archive';
    protected $casts = [
        'date_limite' => 'datetime',
    ];
    // Relations
    public function cours()
    {
        return $this->belongsTo(Cours::class, 'id_cours','id_cours');//hna zedna id_cours
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'id_enseignant','id_enseignant');
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe', 'id_classe');
    }
    
public function notes()
{
    return $this->hasMany(Note::class, 'id_evaluation');
}
    /*public function questions()
    {
        return $this->hasMany(Question::class, 'id_evaluation');
    }*/

    // Scopes utiles
    public function scopeVisible($query)
    {
        return $query->where('est_visible', true);
    }

    public function scopePourCours($query, $coursId)
    {
        return $query->where('id_cours', $coursId);
    }

    // Méthodes helpers
    public function estTerminee()
    {
        return now() > $this->date_limite;
    }

    public function estDisponible()
    {
        return $this->est_visible 
            && now() >= $this->date_publication 
            && !$this->estTerminee();
    }
    public function estModifiable()
    {
        return in_array($this->statut, [
            self::STATUT_BROUILLON, 
            self::STATUT_PROGRAMME
        ]);
    }
    public function estPubliable()
    {
        return $this->statut === self::STATUT_BROUILLON;
    }
    public function getFormattedDateEvaluationAttribute()
{
    return $this->date_evaluation 
        ? $this->date_evaluation->format('Y-m-d\TH:i')
        : null;
}
// Dans app/Models/Evaluation.php
public function getStatusColorAttribute()
{
    return match($this->statut) {
        'programme' => 'programme',
        'en_cours' => 'en_cours',
        'corrige' => 'corrige',
        'archive' => 'archive',
        default => 'secondary'
    };
}

public function getStatutTextAttribute()
{
    return match($this->statut) {
        'programme' => 'Programmée',
        'en_cours' => 'En cours',
        'corrige' => 'Corrigée',
        'archive' => 'Archivée',
        default => $this->statut
    };
}
}