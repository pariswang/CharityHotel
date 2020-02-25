<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHideStatusFieldInSubscribe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_subscribe', function (Blueprint $table){
            $table->tinyInteger('hide_status')->default(0)->comment('隐藏状态');
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
            $table->tinyInteger('hide_status');
        });
    }
}
