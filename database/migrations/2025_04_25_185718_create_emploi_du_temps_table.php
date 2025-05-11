<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('emploi_du_temps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_enseignant'); // Doit correspondre au nom et type de la clé primaire dans 'enseignant'
            $table->foreignId('cours_id')->constrained('cours')->cascadeOnDelete();
            $table->dateTime('debut');
            $table->dateTime('fin');
            $table->string('salle');
            $table->timestamps();
    
            // Clé étrangère manuelle
            $table->foreign('id_enseignant')
                  ->references('id_enseignant')
                  ->on('enseignant')
                  ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emploi_du_temps');
    }
};
