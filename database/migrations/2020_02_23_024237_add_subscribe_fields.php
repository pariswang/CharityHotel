<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscribeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_subscribe', function (Blueprint $table){
            $table->string('conn_position', 100)->nullable();
            $table->string('conn_company', 100)->nullable();
            $table->integer('room_count')->nullable();
            $table->smallInteger('can_pay')->default(0);
            $table->smallInteger('has_letter')->default(0);
            $table->integer('admin_id')->nullable(); // 接单人
            $table->smallInteger('status')->nullable();// 状态：1已申请，5已接单
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
            $table->dropColumn('conn_position');
            $table->dropColumn('conn_company');
            $table->dropColumn('room_count');
            $table->dropColumn('can_pay');
            $table->dropColumn('has_letter');
            $table->dropColumn('admin_id');
            $table->dropColumn('status');
        });
    }
}
