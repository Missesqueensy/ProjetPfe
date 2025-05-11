<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('formulaires', function (Blueprint $table) {
        $table->integer('vues')->default(0)->after('id_formulaire');
    });
}

public function down()
{
    Schema::table('formulaires', function (Blueprint $table) {
        $table->dropColumn('vues');
    });
}
};
