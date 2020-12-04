<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSouscripteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('souscripteurs', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codeSouscripteur',100)->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('genre')->nullable();
            $table->string('lieuNaissance')->nullable();
            $table->date('dateNaissance')->nullable();
            $table->string('numCnib',20)->nullable();
            $table->date('dateEtabCnib')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
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
            $table->string('etat')->default("non formé");
            $table->string('cnib')->nullable();
            $table->string('diplome')->nullable();
            $table->string('attestation')->nullable();
            $table->string('autreDocument')->nullable();
            $table->string('codeValidation')->nullable();
            $table->string('numeroQuittance')->nullable();
            $table->string('quittance')->nullable();
            $table->string('attestationFormation')->nullable();
            $table->date('dateDebut')->nullable();
            $table->date('dateFin')->nullable();
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
        Schema::table('souscripteurs', function(Blueprint $table) {;
            $table->dropForeign('souscripteurs_localiteId_foreign');
        });
        Schema::dropIfExists('souscripteurs');
    }
}
