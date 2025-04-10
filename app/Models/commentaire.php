<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class commentaire extends Model
{
    protected $fillable = [
        'contenu', 'etudiant_id', // adapte selon ta base
    ];
}
