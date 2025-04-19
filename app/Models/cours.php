<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // <-- Ajoutez cette ligne

class Cours extends Model
{
    protected $table = 'cours'; // Nom de la table
    protected $primaryKey = 'id_cours'; // Clé primaire
    public $timestamps = false; // Si vous n'avez pas de colonnes created_at et updated_at
    public $incrementing = true;
    // Si vous utilisez les colonnes créées manuellement
    protected $fillable = ['image', 'titre', 'description','file','id_enseignant'];

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
}
