<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reclamation', function (Blueprint $table) {
            $table->id();
            $table->text('contenu');
            $table->enum('type', ['prof_vers_etud', 'etud_vers_prof', 'etud_vers_etud']);
            $table->string('statut')->default('en_attente');
            
            // Expéditeur (polymorphe)
            $table->unsignedBigInteger('expediteur_id');
            $table->string('expediteur_type'); // 'App\Models\Etudiant' ou 'App\Models\Enseignant'
            
            // Destinataire (polymorphe)
            $table->unsignedBigInteger('destinataire_id')->nullable();
            $table->string('destinataire_type')->nullable(); // 'App\Models\Etudiant' ou 'App\Models\Enseignant'
            
            // Réponse et admin
            $table->text('reponse')->nullable();
            $table->timestamp('date_reponse')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            
            $table->timestamps();
            
            // Clé étrangère vers admin (si admin_id est utilisé)
            $table->foreign('admin_id')
                  ->references('id')
                  ->on('admin')
                  ->onDelete('SET NULL');
            
            // Index pour les relations polymorphes (améliore les performances)
            $table->index(['expediteur_id', 'expediteur_type']);
            $table->index(['destinataire_id', 'destinataire_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reclamation');
    }
};
?>