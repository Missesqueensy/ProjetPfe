<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id('id_note');
            
            // Clé étrangère vers evaluations (id_evaluation est un id() standard)
            $table->foreignId('id_evaluation')->constrained('evaluations', 'id_evaluation');
            
            // Clé étrangère vers etudiant (adaptée à unsignedInteger)
            $table->unsignedInteger('id_etudiant'); // Correspond au type dans etudiant
            
            // Données de la note
            $table->decimal('valeur', 5, 2)->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamp('date_notation')->nullable();
            $table->enum('statut', ['en_attente', 'corrige', 'publie'])->default('en_attente');
            
            $table->timestamps();
            
            // Contraintes étrangères manuelles
            $table->foreign('id_etudiant')
                  ->references('id_etudiant')
                  ->on('etudiant')
                  ->onDelete('cascade');
            
            // Unicité
            $table->unique(['id_evaluation', 'id_etudiant']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
?>