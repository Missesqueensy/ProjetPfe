<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id('id_evaluation');
            
            // Relations
            $table->foreignId('id_cours')->constrained('cours', 'id_cours');
            $table->foreignId('id_enseignant')->constrained('enseignant', 'id_enseignant');
            // Dans la méthode up() de votre migration
$table->foreignId('id_classe')->constrained('classe', 'id_classe')->after('id_enseignant');
            // Métadonnées
            $table->string('titre', 100);
            $table->text('description')->nullable();
            $table->enum('type', ['examen', 'devoir', 'quiz', 'projet']);
            
            // Dates importantes
            $table->dateTime('date_publication');
            $table->dateTime('date_debut');
            $table->dateTime('date_limite');
            $table->unsignedSmallInteger('duree_minutes');
            
            // Configuration
            $table->decimal('bareme_total', 5, 2)->default(20.00);
            $table->boolean('est_visible')->default(false);
            $table->enum('statut', ['brouillon', 'programme', 'en_cours', 'corrige', 'archive']);
            
            // Fichiers
            $table->string('fichier_consigne')->nullable();
            $table->string('fichier_correction')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Index
            $table->index('id_cours');
            $table->index('id_enseignant');
            $table->index('date_debut');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
};