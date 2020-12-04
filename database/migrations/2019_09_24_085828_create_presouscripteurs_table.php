<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresouscripteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presouscripteurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('genre')->nullable();
            $table->string('lieuNaissance')->nullable();
            $table->date('dateNaissance')->nullable();
            $table->string('numCnib',20);
            $table->date('dateEtabCnib');
            $table->string('telephone');
            $table->string('email');
            $table->string('niveauEtude')->nullable();
            $table->string('connaissance')->nullable();
            $table->string('profession')->nullable();
            $table->boolean('electricite')->default(false);
            $table->boolean('electronique')->default(false);
            $table->boolean('electrotechnique')->default(false);
            $table->boolean('climatisation')->default(false);
            $table->boolean('energie')->default(false);
            $table->bigInteger('localite_id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('cnib')->nullable();
            $table->string('diplome')->nullable();
            $table->string('attestation')->nullable();
            $table->string('autreDocument')->nullable();
            $table->foreign('localite_id')
                  ->references('id')
                  ->on('localites')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presouscripteurs');
    }
}
