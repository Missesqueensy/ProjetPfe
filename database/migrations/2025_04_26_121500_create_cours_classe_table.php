<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cours_classe', function (Blueprint $table) {
            // Pas besoin de $table->id() pour une table pivot
            $table->foreignId('id_cours')->constrained('cours', 'id_cours')->onDelete('cascade');
            $table->foreignId('id_classe')->constrained('classe', 'id_classe')->onDelete('cascade');
            $table->primary(['id_cours', 'id_classe']); // Clé primaire composite
            // Pas besoin de timestamps() pour une table pivot simple
        });
    }

    public function down()
    {
        Schema::dropIfExists('cours_classe');
    }
};
?>