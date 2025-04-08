<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $table = 'enseignants'; // Nom de la table
    protected $primaryKey = 'id'; // Clé primaire
    public $timestamps = false; // Si vous n'avez pas de colonnes created_at et updated_at

    // Relation avec le modèle Cours (un enseignant peut avoir plusieurs cours)
    public function cours()
    {
        return $this->hasMany(Cours::class, 'id_enseignant');
    }
}
