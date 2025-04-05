<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Étendre Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable // Étendre Authenticatable
{
    use HasFactory;

    // Indiquer explicitement la table associée si nécessaire
    protected $table = 'admin';

    // Indiquer les champs qui peuvent être remplis en masse
    protected $fillable = ['nom', 'prénom', 'email', 'password', 'tel'];

    // Hachage du mot de passe lors de la création ou mise à jour
    public static function boot()
    {
        parent::boot();

        static::creating(function ($admin) {
            if ($admin->password) {
                $admin->password = Hash::make($admin->password); // Hachage du mot de passe lors de la création
            }
        });

        static::updating(function ($admin) {
            if ($admin->password) {
                $admin->password = Hash::make($admin->password); // Hachage du mot de passe lors de la mise à jour
            }
        });
    }
}
