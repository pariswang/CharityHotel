<?php

/**
 * @Author: Simon Zhao
 * @Date:   2020-02-29 21:05:16
 * @Last Modified by:   Simon Zhao
 * @Last Modified time: 2020-02-29 22:47:51
 */
namespace App\Admin\Extensions;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Form\Field\HasMany;
use Encore\Admin\Form\NestedForm;

class HotelHasManyHospitals extends HasMany
{
    protected function setupScriptForDefaultView($templateScript)
    {
        $removeClass = NestedForm::REMOVE_FLAG_CLASS;
        $defaultKey = NestedForm::DEFAULT_KEY_NAME;

        /**
         * When add a new sub form, replace all element key in new sub form.
         *
         * @example comments[new___key__][title]  => comments[new_{index}][title]
         *
         * {count} is increment number of current sub form count.
         */
        $script = <<<EOT
var index = 0;
var max_hospitals_count = 3;
var hospitals_notice = '<h4 class="pull-left">提交附近医院信息将有助于您的医院被展示,最多三家</h4>';
$('#has-many-{$this->column}').prev().prev().find('div.col-sm-8').html(hospitals_notice);
if($('.has-many-{$this->column}-form').find('.$removeClass'+'[value=0]').length >= max_hospitals_count){
    $('#has-many-{$this->column} .add').hide();
}

$('#has-many-{$this->column}').off('click', '.add').on('click', '.add', function () {

    var tpl = $('template.{$this->column}-tpl');

    index++;

    var template = tpl.html().replace(/{$defaultKey}/g, index);
    $('.has-many-{$this->column}-forms').append(template);
    {$templateScript}

	if($('.has-many-{$this->column}-form').find('.$removeClass'+'[value=0]').length >= max_hospitals_count){
		$('#has-many-{$this->column} .add').hide();
	}
    return false;
});

$('#has-many-{$this->column}').off('click', '.remove').on('click', '.remove', function () {
    $(this).closest('.has-many-{$this->column}-form').hide();
    $(this).closest('.has-many-{$this->column}-form').find('.$removeClass').val(1);
	if($('.has-many-{$this->column}-form').find('.$removeClass'+'[value=0]').length < max_hospitals_count){
		$('#has-many-{$this->column} .add').show();
	}
    return false;
});

EOT;

        Admin::script($script);
    }
}
