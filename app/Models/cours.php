<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // <-- Ajoutez cette ligne
use App\Models\EmploiDuTemps;
use App\Models\CoursClasse;
use App\Models\enseignant;
class Cours extends Model
{
    protected $table = 'cours'; // Nom de la table
    protected $primaryKey = 'id_cours'; // Clé primaire
    public $timestamps = false; // Si vous n'avez pas de colonnes created_at et updated_at
    public $incrementing = true;
    // Si vous utilisez les colonnes créées manuellement
    protected $fillable = ['image', 'titre', 'description','file','id_enseignant'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at', // si vous utilisez SoftDeletes
        'date_publication' // si ce champ existe
    ];
    protected $casts = [
    'date_publication' => 'datetime',
];

    // Relation avec le modèle Enseignant (chaque cours appartient à un enseignant)
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'id_enseignant','id_enseignant');//mseht wahd id ense tanya
    }
    public function getImageUrlAttribute()
{
    if (!$this->image) {
        return asset('assets/img/default-course.png');
    }
    
    $path = 'public/'.$this->image;
    return Storage::exists($path)
           ? Storage::url($this->image)
           : asset('assets/img/default-course.png');
}
public function evaluations()
{
    return $this->hasMany(Evaluation::class, 'id_cours');
}
public function emploisDuTemps()
{
    return $this->hasMany(EmploiDuTemps::class, 'id_cours', 'id_cours');
}
public function scopeForTeacher($query, $teacherId)
{
    return $query->where('id_enseignant', $teacherId);
}
public function classes()
{
    return $this->belongsToMany(Classe::class, 'cours_classe', 'id_cours', 'id_classe');
}

public function getIdEnseignantAttribute()
{
    return Enseignant::find($this->attributes['id_enseignant']);
}
public function etudiants()
{
    return $this->belongsToMany(Etudiant::class, 'etudiant_cours', 'id_cours', 'id_etudiant')
                ->withTimestamps()
                ->withPivot(['created_at', 'updated_at']);
}
}
