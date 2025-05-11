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
        Schema::table('etudiant', function (Blueprint $table) {
            $table->unsignedBigInteger('id_classe')
                  ->nullable()
                  ->after('CNI'); // Positionnez la colonne où vous voulez
            
            $table->foreign('id_classe')
                  ->references('id_classe')->on('classe')
                  ->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('etudiant', function (Blueprint $table) {
            $table->dropForeign(['id_classe']);
            $table->dropColumn('id_classe');
        });
    }
};
