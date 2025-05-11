<?php

namespace App\Models;
    
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Formulaire extends Model
{
    protected $table = 'formulaires'; // Correspond au nom de ta table

    protected $primaryKey = 'id_formulaire'; // Clé primaire personnalisée

    protected $fillable = [
        'titre',
        'contenu',
        'type',
        'id_etudiant',
    ];

    /**
     * Relation : un formulaire appartient à un étudiant.
     */
    public function etudiant()
{
    return $this->belongsTo(Etudiant::class, 'id_etudiant', 'id_etudiant')
                ->withDefault([
                    'nom' => 'Étudiant Supprimé',
                    'id_etudiant' => null
                ]); // Valeur par défaut si la relation est null
}
    public function commentaires()
{
    return $this->hasMany(Commentaire::class, 'id_formulaire', 'id_formulaire');
}
}
