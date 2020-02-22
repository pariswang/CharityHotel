<?php

namespace App\Admin\Controllers;

use App\Model\Hospital;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HospitalController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '医院管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Hospital());

        $grid->column('id', __('Id'));
        $grid->column('hospital_name', __('医院名称'));
        $grid->column('region.region_name', __('地区'));
        $grid->column('create_date', __('Create date'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Hospital::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('hospital_name', __('Hospital name'));
        $show->field('region_id', __('地区'))->as(function () {
            return isset($this->region)?$this->region->region_name:'';
        });
        $show->field('create_date', __('Create date'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Hospital());

        $form->text('hospital_name', __('Hospital name'));
        $form->number('region_id', __('Region id'));
        $form->datetime('create_date', __('Create date'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
