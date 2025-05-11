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
        {        if (!Schema::hasTable('etudiant')) {

            Schema::create('etudiant', function (Blueprint $table) {
                $table->unsignedInteger('id_etudiant');
                $table->string('nom');
                $table->string('prénom');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('tel');
                $table->string('CNI');
                $table->timestamps();
            });
        }
    }
    
        public function down()
        {
            Schema::dropIfExists('etudiant');
        }
    };

