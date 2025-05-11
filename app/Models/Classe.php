<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{
    use SoftDeletes;
    protected $table = 'classe'; // ← très important ici

    protected $primaryKey = 'id_classe';
    protected $fillable = [
        'nom',
        'niveau',
        'filiere',
        'annee_scolaire'
    ];
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'id_classe', 'id_classe');
    }
    
    // Relation avec les étudiants
    public function etudiants()
{
    return $this->hasMany(Etudiant::class, 'id_classe', 'id_classe');
}


    // Relation avec les cours (si nécessaire)
    public function cours()
    {
        return $this->belongsToMany(Cours::class, 'cours_classe', 'id_classe', 'id_cours');

    }

}