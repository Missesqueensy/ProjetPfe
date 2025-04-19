<?php

namespace App\Models;
    
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
    
    class Formulaire extends Model
    {
        use HasFactory;
    
        // Définir le nom de la table si ce n'est pas le nom par défaut (pluriel du modèle)
        protected $table = 'formulaire';
    
        // Activer les timestamps pour gérer les dates de création et de modification
        public $timestamps = false;
    
        // Spécifier les colonnes que vous pouvez mass-assign (pour des insertions ou des mises à jour en masse)
        protected $fillable = [
            'id_etudiant',
            'titre',
            'contenu',
            'type_sujet',
            'statut',
            'vue',
            'moderation_commentaire',
            'nombre_commentaires',
            'image',
            'date_publication',
            'date_modification',
            'visible',
        ];
    
        // Définir la relation avec l'étudiant (si vous avez une table users pour les étudiants)
        public function etudiant()
        {
            return $this->belongsTo(Etudiant::class, 'id_etudiant','id_etudiant');
        }
    
        // Vous pouvez également ajouter un mutateur pour `statut` ou `visible` si vous voulez le gérer différemment.
    }
    