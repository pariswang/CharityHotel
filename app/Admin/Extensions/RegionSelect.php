<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/29
 * Project: CharityHotel
 * Github: https://github.com/pariswang/CharityHotel
 */

namespace App\Admin\Extensions;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Form\Field\Select;
use Illuminate\Support\Str;

class RegionSelect extends Select
{
    protected $view = 'admin::form.select';

    /**
     * Load options for other select on change.
     *
     * @param string $field
     * @param string $sourceUrl
     * @param string $idField
     * @param string $textField
     *
     * @return $this
     */
    public function load($field, $sourceUrl, $idField = 'id', $textField = 'text', bool $allowClear = true)
    {
        if (Str::contains($field, '.')) {
            $field = $this->formatName($field);
            $class = str_replace(['[', ']'], '_', $field);
        } else {
            $class = $field;
        }

        $placeholder = json_encode([
            'id'   => '',
            'text' => trans('admin.choose'),
        ]);

        $strAllowClear = var_export($allowClear, true);

        $script = <<<EOT
$(document).off('change', "{$this->getElementClassSelector()}");
$(document).on('change', "{$this->getElementClassSelector()}", function () {
    var target = $(this).closest('.fields-group').find(".$class");
    $.get("$sourceUrl",{q : this.value}, function (data) {
        target.find("option").remove();
        $(target).select2({
            placeholder: $placeholder,
            allowClear: $strAllowClear,
            data: $.map(data, function (d) {
                d.id = d.$idField;
                d.text = d.$textField;
                return d;
            })
        }).trigger('change');
        
        var isPreValueIndex = $.inArray( $(target).attr('data-value'),
                $.map( data, function(n){
                  return n.id;
                })
            );
        if(isPreValueIndex != '-1'){
           target.val(target.attr('data-value'));
           var target_render = target.next().find('.select2-selection__rendered');
           target_render.html(target_render.html().replace(target_render.attr('title'),data[isPreValueIndex].text));
        }  
    });
});

$('{$this->getElementClassSelector()}').trigger('change');

EOT;

        Admin::script($script);

        return $this;
    }
}