<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('classe', function (Blueprint $table) {
            $table->id('id_classe');
            $table->string('nom', 100);
            $table->string('niveau', 50); // Ex: 'Licence 1', 'Master 2'
            $table->string('filiere', 100); // Ex: 'Informatique', 'Mathématiques'
            $table->unsignedInteger('annee_scolaire'); // Ex: 2025
            $table->timestamps();
            $table->softDeletes();
            
            // Index
            $table->index(['niveau', 'filiere']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('classe');
    }
};
?>