<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Étendre Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable // Étendre Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';

    // Indiquer explicitement la table associée si nécessaire
    protected $table = 'admin';

    // Indiquer les champs qui peuvent être remplis en masse
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'tel'];

    // Hachage du mot de passe lors de la création ou mise à jour
    protected $hidden = [
        'password',
    ];
    public function reclamationsTraitees()
{
    return $this->hasMany(Reclamation::class);
}

}
