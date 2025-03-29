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
            // Vérifie si la colonne 'role' n'existe pas avant de l'ajouter
            if (!Schema::hasColumn('etudiant', 'role')) {
                $table->string('role')->default('etudiant'); // Ajout de la colonne role
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('etudiant', function (Blueprint $table) {
            // Supprime la colonne 'role' si elle existe
            if (Schema::hasColumn('etudiant', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
