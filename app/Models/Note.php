<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $primaryKey = 'id_note';
    protected $fillable = ['id_evaluation', 'id_etudiant', 'valeur', 'commentaire', 'statut'];

    // Relation avec l'évaluation
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'id_evaluation');
    }

    // Relation avec l'étudiant
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant');
    }
}
?>