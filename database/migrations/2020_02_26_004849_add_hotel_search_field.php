<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHotelSearchField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wh_hotel', function (Blueprint $table) {
            $table->text('search_keywords')->nullable();
            $table->string('hospital_ids', 200)->nullable();
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
            $table->dropColumn('search_keywords');
            $table->dropColumn('hospital_ids');
        });
    }
}
