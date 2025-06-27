<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('etudiant_cours', function (Blueprint $table) {
            // Clés étrangères
            $table->unsignedBigInteger('id_etudiant');
            $table->unsignedBigInteger('id_cours');

            // Timestamps pour savoir quand l'étudiant a commencé à suivre le cours
            $table->timestamps();
            
            // Clé primaire composite
            $table->primary(['id_etudiant', 'id_cours']);
            
            // Contraintes de clé étrangère
            $table->foreign('id_etudiant')
                  ->references('id_etudiant')
                  ->on('etudiant')
                  ->onDelete('cascade');
                  
            $table->foreign('id_cours')
                  ->references('id_cours')
                  ->on('cours')
                  ->onDelete('cascade');
            
            // Index pour optimiser les requêtes
            $table->index('id_etudiant');
            $table->index('id_cours');
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('etudiant_cours');
        Schema::enableForeignKeyConstraints();
    }
};