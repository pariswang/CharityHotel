<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableHotelHospitalPrimaryKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('wh_hotel_hospital');
        Schema::create('wh_hotel_hospital', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id');
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
    }
}

/**
 * /vendor/encore/laravel-admin/src/Form/Field下的Select.php文件
 
    $script = <<<EOT
    $(document).on('change', "{$this->getElementClassSelector()}", function () {
     var target = $(this).closest('.fields-group').find(".$class");
     $.get("$sourceUrl?q="+this.value, function (data) {
      target.find("option").remove();
      $(target).select2({
       data: $.map(data, function (d) {
        d.id = d.$idField;
        d.text = d.$textField;
        return d;
       })
      }).trigger('change');
     });
    });

    //该处新增  $('{$this->getElementClassSelector()}').trigger('change');

    EOT;
*/
