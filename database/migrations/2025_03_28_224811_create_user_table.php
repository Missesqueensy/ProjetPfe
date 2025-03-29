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
        // Vérifie que la table `etudiant` existe avant de la modifier
        if (Schema::hasTable('etudiant')) {
            Schema::table('etudiant', function (Blueprint $table) {
                if (!Schema::hasColumn('etudiant', 'tel')) {
                    $table->string('tel')->nullable(); // Ajout d'un champ téléphone
                }
                if (!Schema::hasColumn('etudiant', 'role')) {
                    $table->string('role')->default('etudiant'); // Ajout d'un champ rôle
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasTable('etudiant')) {
            Schema::table('etudiant', function (Blueprint $table) {
                if (Schema::hasColumn('etudiant', 'tel')) {
                    $table->dropColumn('tel');
                }
                if (Schema::hasColumn('etudiant', 'role')) {
                    $table->dropColumn('role');
                }
            });
        }
    }
};
?>