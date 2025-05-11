<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Etudiant;

return new class extends Migration
    {
        public function up()
        {
            Schema::create('formulaires', function (Blueprint $table) {
                $table->id('id_formulaire');
                $table->string('titre');
                $table->text('contenu');
                $table->enum('type', ['question', 'explication']);
                $table->unsignedInteger('id_etudiant');
                $table->timestamps();
        
                // Clé étrangère
                $table->foreign('id_etudiant')
                      ->references('id_etudiant')
                      ->on('etudiant')
                      ->onDelete('cascade');
        
                // Index optionnel (non nécessaire si la clé étrangère existe déjà)
                // $table->index('id_etudiant');
            });
        }
        public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant', 'id_etudiant');
    }
    };