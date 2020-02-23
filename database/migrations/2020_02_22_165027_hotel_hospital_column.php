<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HotelHospitalColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_hotel_hospital', function (Blueprint $table) {
            $table->bigInteger('hospital_id')->change();
            $table->primary(['hotel_id', 'hospital_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_hotel_hospital', function (Blueprint $table) {
            $table->integer('hospital_id')->change();
            $table->dropPrimary();
        });
    }
}
