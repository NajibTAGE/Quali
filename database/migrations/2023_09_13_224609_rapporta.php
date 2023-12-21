<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapporta', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('id_user');
                    $table->string('client')->nullable();
                    $table->string('Projet')->nullable();
                    $table->text('constat');
                    $table->text('recommandations');
                    $table->string('departement')->nullable();
                    $table->string('risque')->nullable();
                    $table->string('priorite')->nullable();
                    $table->timestamps();
                    $table->foreign('id_user')->references('id')->on('users');
                });
            }
            
            public function down()
            {
                Schema::dropIfExists('rapporta');
            }
            
};
