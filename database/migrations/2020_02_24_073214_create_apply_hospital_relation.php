<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyHospitalRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wh_subscribe_hospital', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subscribe_id');
            $table->integer('region_id');
            $table->bigInteger('hospital_id');
            $table->integer('distance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wh_subscribe_hospital');
    }
}
