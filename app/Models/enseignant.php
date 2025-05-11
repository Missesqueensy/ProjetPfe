<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\EmploisDuTemps;
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Enseignant extends Authenticatable
{
    use Notifiable;

    protected $table = 'enseignant'; 
    protected $primaryKey = 'id_enseignant';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'specialite',
        'departement'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'cours_classe', 'id_enseignant', 'id_classe')
                    ->withPivot('id_cours');
    }
    public function courses()
    {
        return $this->hasMany(Cours::class, 'id_enseignant');
    }
    public function reclamations()
{
    return $this->morphMany(Reclamation::class, 'expediteur');
}
public function emploisDuTemps()
{
    return $this->hasMany(EmploiDuTemps::class, 'id_enseignant', 'id_enseignant');
}
public function reclamationsEnvoyees()
{
    return $this->morphMany(Reclamation::class, 'expediteur');
}

public function reclamationsRecues()
{
    return $this->morphMany(Reclamation::class, 'destinataire');
}
public function getAuthPassword()
{
    return $this->password;
}
public function evaluations()
{
    return $this->hasMany(Evaluation::class, 'id_enseignant');
}
// Dans app/Models/Enseignant.php
// Dans app/Models/Enseignant.php
public function cours()
{
    return $this->hasMany(Cours::class, 'id_enseignant');
    // Ou belongsToMany si un enseignant peut avoir plusieurs cours partagés
}
}