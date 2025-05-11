<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class commentaire extends Model
{
    protected $fillable = [
        'contenu', 'id_formulaire','id_etudiant' // adapte selon ta base
    ];

public function formulaire()
    {
        return $this->belongsTo(Formulaire::class, 'id_formulaire', 'id_formulaire');
    }
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant', 'id_etudiant');
    }
}