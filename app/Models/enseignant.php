<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $table = 'enseignant'; // Nom de la table
    protected $primaryKey = 'id_enseignant'; // Clé primaire
    public $timestamps = false; // Si vous n'avez pas de colonnes created_at et updated_at
    public $incrementing = true;
    // Si vous utilisez les colonnes créées manuellement
    protected $fillable = ['id_enseignant', 'specialite', 'departement','nom','prenom','email','password'];
    // Relation avec le modèle Cours (un enseignant peut avoir plusieurs cours)
    public function cours()
    {
        return $this->hasMany(Cours::class, 'id_enseignant');
    }
}
