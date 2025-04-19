<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    
     public function up(){
    Schema::create('reclamation', function (Blueprint $table) {
        $table->id();
        $table->text('contenu');
        $table->string('type'); // prof_vers_etud, etud_vers_prof, etud_vers_etud
        $table->string('statut')->default('en_attente');
        
        // Relation polymorphe pour l'expéditeur
        $table->unsignedBigInteger('expediteur_id');
        $table->string('expediteur_type'); // App\Models\Etudiant ou App\Models\Professeur
        
        // Relation polymorphe pour le destinataire
        $table->unsignedBigInteger('destinataire_id')->nullable();
        $table->string('destinataire_type')->nullable(); // App\Models\Etudiant ou App\Models\Professeur
        $table->id()->first(); // Ajoute une colonne id auto-incrémentée
        $table->foreignId('id')->constrained('admin');
        $table->timestamps();
        $table->foreign(['expediteur_id', 'expediteur_type'])
          ->references(['id_etudiant', DB::raw("'App\\\\Models\\\\Etudiant'")])
          ->on('etudiant')
          ->onDelete('RESTRICT');
          $table->text('reponse')->nullable();
          $table->timestamp('date_reponse')->nullable();
          $table->foreignId('id')->nullable()->constrained('admin');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamation');
    }
};
