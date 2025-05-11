<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

use Illuminate\Database\Eloquent\Model;

class CoursClasse extends Pivot
{
    protected $table = 'cours_classe';

    /*protected $fillable = [
        'id_cours',
        'id_classe',
        // d'autres champs si tu en ajoutes plus tard
    ];*/
}
