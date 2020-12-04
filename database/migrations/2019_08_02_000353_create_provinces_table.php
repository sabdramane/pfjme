<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelleP',60)->unique();
            $table->bigInteger('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provinces', function(Blueprint $table) {
            $table->dropForeign('provinces_regionId_foreign');
        });
        Schema::dropIfExists('provinces');
    }
}
