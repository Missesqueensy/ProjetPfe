<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiDuTemps extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // Si votre table emploi_du_temps a une clé primaire standard 'id'

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'debut' => 'datetime',
        'fin' => 'datetime',
    ];

    /**
     * Relation avec le modèle Enseignant
     */
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'id_enseignant', 'id_enseignant');
    }

    /**
     * Relation avec le modèle Cours
     */
    public function cours()
    {
        return $this->belongsTo(Cours::class, 'id_cours', 'id_cours');
    }

    /**
     * Accesseur pour le titre complet du cours
     */
    public function getTitreCoursAttribute()
    {
        return $this->cours->titre ?? 'Cours inconnu';
    }

    /**
     * Accesseur pour le nom complet de l'enseignant
     */
    public function getNomEnseignantAttribute()
    {
        return $this->enseignant 
            ? $this->enseignant->nom . ' ' . $this->enseignant->prenom 
            : 'Enseignant inconnu';
    }

    /**
     * Scope pour les événements d'un enseignant spécifique
     */
    public function scopePourEnseignant($query, $id_enseignant)
    {
        return $query->where('id_enseignant', $id_enseignant);
    }

    /**
     * Scope pour les événements à venir
     */
    public function scopeAVenir($query)
    {
        return $query->where('debut', '>', now());
    }
}