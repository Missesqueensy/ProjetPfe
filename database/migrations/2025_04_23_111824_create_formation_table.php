<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formation', function (Blueprint $table) {
            $table->id('id_formation');
            $table->string('titre');
            $table->text('description');
            $table->string('image')->nullable();
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->text('contenu_video'); // Suppression de ->nullable() pour le rendre obligatoire
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation');
    }
};