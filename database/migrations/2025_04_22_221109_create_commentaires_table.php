<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 

    public function up()
{
    if (!Schema::hasTable('commentaires')) {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id('id_commentaire');
            $table->text('contenu');
            $table->unsignedInteger('id_formulaire');
            $table->unsignedInteger('id_etudiant');
            $table->timestamps();

            // Ajoutez ces index d'abord
            $table->index('id_formulaire');
            $table->index('id_etudiant');
        });

        // Ajoutez les contraintes étrangères APRÈS la création de la table
        Schema::table('commentaires', function (Blueprint $table) {
            $table->foreign('id_formulaire')
                  ->references('id_formulaire')
                  ->on('formulaires')
                  ->onDelete('cascade');
                  
            $table->foreign('id_etudiant')
                  ->references('id_etudiant')
                  ->on('etudiant')
                  ->onDelete('cascade');
        });
    }
}

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};