<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_hotel', function (Blueprint $table) {
            $table->smallInteger('medical_price')->nullable()->comment('医疗爱心价')->after('room_count');
            $table->boolean('receive_patient')->comment('是否接待隔离人员')->after('medical_staff_free');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_hotel', function (Blueprint $table) {
            $table->dropColumn('medical_price');
            $table->dropColumn('receive_patient');
        });
    }
}
