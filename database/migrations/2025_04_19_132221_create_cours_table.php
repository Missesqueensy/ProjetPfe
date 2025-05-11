<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            // Clé primaire
            $table->id('id_cours');
            
            // Champs de base
            $table->string('titre', 255);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('video_path')->nullable();
            $table->string('format_video')->nullable();

            
            // Métadonnées
            $table->boolean('est_public')->default(false);
            $table->dateTime('date_publication')->nullable();
            
            // Clé étrangère améliorée
            $table->unsignedBigInteger('id_enseignant')->index();
            $table->foreign('id_enseignant')
                  ->references('id_enseignant')
                  ->on('enseignant')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            // Gestion des dates
            $table->timestamps();
            $table->softDeletes(); // Pour la suppression douce
        });

        // Index supplémentaires pour optimisation
        Schema::table('cours', function (Blueprint $table) {
            $table->index('titre');
            $table->index('created_at');
        });
    }

    public function down()
    {
        // Désactiver les contraintes de clé étrangère temporairement
        Schema::disableForeignKeyConstraints();
        
        Schema::dropIfExists('cours');

        // Réactiver les contraintes
        Schema::enableForeignKeyConstraints();
    }
}
?>