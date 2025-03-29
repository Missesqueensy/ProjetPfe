<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    // Indiquer explicitement la table associée si nécessaire
    protected $table = 'etudiant';

    // Indiquer les champs qui peuvent être remplis en masse
    protected $fillable = ['nom', 'prénom', 'email', 'password', 'tel', 'role'];
}
?>