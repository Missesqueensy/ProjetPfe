<?php

namespace App\Models;
use App\Models\NoteDeCours;
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
    protected $fillable = ['nom', 'prénom', 'email', 'password', 'tel', 'CNI', 'id_classe' ];

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
public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe', 'id_classe');
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
// Dans App\Models\Etudiant.php
public function notes()
{
    return $this->hasMany(Note::class, 'id_etudiant', 'id_etudiant');
}
// Ajoutez cette méthode dans votre modèle Etudiant

public function cours()
{
    return $this->belongsToMany(Cours::class, 'etudiant_cours', 'id_etudiant', 'id_cours')
                                ->withPivot('progression')
                                ->withTimestamps()
                ->withPivot(['created_at', 'updated_at']);
}
public function isFollowing($id_cours)
{
    return $this->cours()->where('id_cours', $id_cours)->exists();
}
public function noteDeCours()
{
    return $this->hasMany(NoteDeCours::class, 'id_etudiant');
}
public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'participants', 'id_etudiant', 'conversation_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'id_etudiant');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'id_etudiant');
    }
}
