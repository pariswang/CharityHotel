<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserPassword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_user', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
            $table->string('password')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wh_user', function (Blueprint $table) {
            $table->bigInteger('id')->change();
            $table->dropColumn('password');
            $table->dropColumn('remember_token');
        });
    }
}
