<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHoteltakingDateFieldInSubscribe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_subscribe', function (Blueprint $table){
            $table->dateTime('hoteltaking_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_subscribe', function (Blueprint $table) {
            $table->dropColumn('hoteltaking_date');
        });
    }
}
