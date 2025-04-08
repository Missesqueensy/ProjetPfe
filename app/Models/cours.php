<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $table = 'cours'; // Nom de la table
    protected $primaryKey = 'id_cours'; // Clé primaire
    public $timestamps = false; // Si vous n'avez pas de colonnes created_at et updated_at

    // Si vous utilisez les colonnes créées manuellement
    protected $fillable = ['titre', 'description', 'image', 'id_enseignant'];

    // Relation avec le modèle Enseignant (chaque cours appartient à un enseignant)
    public function enseignant()
    {
        return $this->belongsTo(enseignant::class, 'id_enseignant');
    }
}
