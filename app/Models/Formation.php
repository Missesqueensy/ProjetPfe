<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $table = 'formation';

    protected $primaryKey = 'id_formation';
    public $timestamps = false; 
    protected $fillable = [
        'titre',
        'description',
        'image',
        'date_debut',
        'date_fin',
    ];

    protected $dates = [
        'date_debut',
        'date_fin',
    ];
}
?>