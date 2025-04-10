<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulaire extends Model
{
    protected $fillable = [
        // Ajoute ici les colonnes que tu veux remplir, ex :
        'titre', 'description', 'etudiant_id'
    ];
}
