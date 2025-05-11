<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Dans le fichier de migration créé
public function up()
{
    Schema::table('evaluations', function (Blueprint $table) {
        $table->foreignId('id_classe')
              ->constrained('classe', 'id_classe')
              ->after('id_enseignant');
    });
}

public function down()
{
    Schema::table('evaluations', function (Blueprint $table) {
        $table->dropForeign(['id_classe']);
        $table->dropColumn('id_classe');
    });
}
};
