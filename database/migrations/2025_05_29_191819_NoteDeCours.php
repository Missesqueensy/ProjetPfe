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
        Schema::create('NoteDeCours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_etudiant');
            $table->foreign('id_etudiant')->references('id_etudiant')->on('etudiant')->onDelete('cascade');
            $table->text('contenu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
