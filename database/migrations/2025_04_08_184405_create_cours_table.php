<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCoursTable extends Migration
{
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id('id_cours'); 
            $table->string('titre'); 
            $table->text('description'); 
            $table->string('image'); 
            $table->unsignedBigInteger('id_enseignant'); 

            $table->foreign('id_enseignant')->references('id_enseignant')->on('enseignant')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('cours');
    }
}
