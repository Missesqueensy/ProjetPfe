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
    protected $primaryKey = 'id_etudiant'; // <-- AJOUT CRITIQUE
    public $incrementing = true;           // <-- Si l'ID est auto-incrémenté
    protected $keyType = 'int';            // <-- Type de clé (int par défaut)


    // Indiquer les champs qui peuvent être remplis en masse
    protected $fillable = ['id_etudiant','nom', 'prénom', 'email', 'password', 'tel', 'CNI'];

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
    public function formulaires()
{
    return $this->hasMany(Formulaire::class, 'id_etudiant','id_etudiant');
}
public function reclamations()
{
    return $this->morphMany(Reclamation::class, 'expediteur');
}
public function reclamationsEnvoyees()
{
    return $this->morphMany(Reclamation::class, 'expediteur');
}

public function reclamationsRecues()
{
    return $this->morphMany(Reclamation::class, 'destinataire');
}
}
