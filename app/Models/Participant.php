<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'id_etudiant', 
    ];
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant');
    }
}