<?php 
// app/Models/Note.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NoteDeCours extends Model
{
    use HasFactory;
protected $table = 'notes'; // ou 'note' selon ta base
    protected $primaryKey = 'id'; // ou ton nom de clé primaire

    protected $fillable = [
        'id_etudiant',
        'contenu',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant', 'id_etudiant');
    }
}
