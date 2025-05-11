<?php
/*namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
    {

        protected $table = 'reclamation'; // Spécifie le nom exact de la table


        protected $fillable = ['contenu', 'type', 'statut', 'expediteur_id', 'expediteur_type', 'destinataire_id', 'destinataire_type', 'id'];
    
        /*public function expediteur()
{
    return $this->morphTo()->withDefault(function ($expediteur, $parent) {
        // Vérification du type avant d'instancier
        $className = $parent->expediteur_type;
        
        if (!class_exists($className)) {
            return $this->createDefaultExpediteur();
        }

        try {
            $model = new $className();
            return $model->newInstance([], true);
        } catch (\Exception $e) {
            return $this->createDefaultExpediteur();
        }
    });
}*/
/*public function expediteur()
{
    return $this->morphTo()->withDefault(function () {
        return (object) [
            'nom' => 'Utilisateur supprimé',
            'email' => 'non-disponible@exemple.com',
            'type' => $this->expediteur_type ? class_basename($this->expediteur_type) : 'Inconnu'
        ];
    });
}*/

/*protected function createDefaultExpediteur()
{
    return (object) [
        'nom' => 'Utilisateur supprimé',
        'email' => 'non-disponible@exemple.com',
        'getAttributes' => fn() => []
    ];
}
    
        public function destinataire()
        {
            return $this->morphTo();
        }
    
        public function admin()
        {
            return $this->belongsTo(\App\Models\Admin::class, 'id');
        }
        public function getExpediteurSafeAttribute()
{
    if (!$this->expediteur) {
        return (object) [
            'nom' => 'Utilisateur supprimé',
            'email' => 'N/A',
            'type' => class_basename($this->expediteur_type)
        ];
    }
    return $this->expediteur;
}
    }*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    protected $table = 'reclamation';
    protected $fillable = [
        'contenu',
        'type',
        'statut',
        'expediteur_id',
        'expediteur_type',
        'destinataire_id',
        'destinataire_type',
        'reponse',
        'date_reponse',
        'admin_id',
    ];
    
    
    // Relation avec l'expéditeur (polymorphe)
    public function expediteur()
    {
        return $this->morphTo();
    }
    
    // Relation avec le destinataire (polymorphe)
    public function destinataire()
    {
        return $this->morphTo();
    }
    
    // Relation avec l'admin (si nécessaire)
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    }
    public function typeToString(): string
    {
        return match($this->type) {
            'prof_vers_etud' => 'Enseignant vers Étudiant',
            'etud_vers_prof' => 'Étudiant vers Enseignant',
            'etud_vers_etud' => 'Étudiant vers Étudiant',
            default => $this->type, // Fallback si nouveau type non géré
        };
    }
    
}
    
   
?>