<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('correcteur', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_etat');
        $table->string('commentaire_management')->nullable();
        $table->text('piece_jointe')->nullable(); 
        $table->string('chemin_fichier')->nullable();
        $table->string('avancement')->nullable();
        $table->timestamps();
        $table->foreign('id_etat')->references('id')->on('etat');
    });
    }

    public function down()
    {
        Schema::dropIfExists('correcteur');
    }
};
