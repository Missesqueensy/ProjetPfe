<?php

namespace App\Models;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
class Message extends Model
{
    protected $fillable = ['id_etudiant', 'content', 'conversation_id'];
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant');
    }
}