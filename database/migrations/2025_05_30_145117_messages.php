<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
    $table->id();
    $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
    $table->unsignedInteger('id_etudiant'); // Changé pour correspondre à votre structure
    $table->text('content');
    $table->timestamp('read_at')->nullable();
    $table->timestamps();
    
    $table->foreign('id_etudiant')->references('id_etudiant')->on('etudiant')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
