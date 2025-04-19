<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/*class Enseignant extends Model
{
    use Notifiable;
    protected $table = 'enseignant'; 
    protected $primaryKey = 'id_enseignant'; 
    public $timestamps = false; 
    public $incrementing = true;
    protected $fillable = ['id_enseignant', 'specialite', 'departement','nom','prenom','email','password'];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function cours()
    {
        return $this->hasMany(Cours::class, 'id_enseignant');
    }
}*/

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

    public function cours()
    {
        return $this->hasMany(Cours::class, 'id_enseignant');
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
public function getAuthPassword()
{
    return $this->password;
}
}