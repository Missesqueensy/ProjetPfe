<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Étendre Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Etudiant extends Authenticatable // Étendre Authenticatable
{
    use HasFactory;

    // Indiquer explicitement la table associée si nécessaire
    protected $table = 'etudiant';

    // Indiquer les champs qui peuvent être remplis en masse
    protected $fillable = ['nom', 'prénom', 'email', 'password', 'tel', 'CNI'];

    // Hachage du mot de passe lors de la création ou mise à jour
    public static function boot()
    {
        parent::boot();

        static::creating(function ($etudiant) {
            if ($etudiant->password) {
                $etudiant->password = Hash::make($etudiant->password); // Hachage du mot de passe lors de la création
            }
        });

        static::updating(function ($etudiant) {
            if ($etudiant->password) {
                $etudiant->password = Hash::make($etudiant->password); // Hachage du mot de passe lors de la mise à jour
            }
        });
    }
}
