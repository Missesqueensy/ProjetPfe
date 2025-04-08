<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCoursTable extends Migration
{
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id('id_cours'); // Définition de la colonne id_cours (clé primaire)
            $table->string('titre'); // Définition de la colonne titre
            $table->text('description'); // Définition de la colonne description
            $table->string('image'); // Définition de la colonne image
            $table->unsignedBigInteger('id_enseignant'); // Définition de la colonne id_enseignant (clé étrangère)

            // Ajout de la contrainte de clé étrangère
            $table->foreign('id_enseignant')->references('id')->on('enseignant')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps(); // Si vous souhaitez ajouter created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('cours');
    }
}
