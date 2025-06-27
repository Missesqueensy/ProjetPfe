<?php

namespace App\Models;
use App\Models\Participant;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
class Conversation extends Model
{
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'participants', 'conversation_id', 'id_etudiant');
    }
}