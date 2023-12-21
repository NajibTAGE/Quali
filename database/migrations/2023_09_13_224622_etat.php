<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rapporta');
            $table->string('statut')->nullable();
            $table->string('commentaire')->nullable();
            $table->timestamps();
            $table->foreign('id_rapporta')->references('id')->on('rapporta');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('etat');
    }
};
