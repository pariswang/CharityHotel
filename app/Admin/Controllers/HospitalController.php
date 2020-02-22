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
    protected $title = 'App\Model\Hospital';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Hospital());

        $grid->column('id', __('Id'));
        $grid->column('create_date', __('Create date'));
        $grid->column('hospital_name', __('Hospital name'));
        $grid->column('region_id', __('Region id'));

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
        $show->field('create_date', __('Create date'));
        $show->field('hospital_name', __('Hospital name'));
        $show->field('region_id', __('Region id'));

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

        $form->datetime('create_date', __('Create date'))->default(date('Y-m-d H:i:s'));
        $form->text('hospital_name', __('Hospital name'));
        $form->number('region_id', __('Region id'));

        return $form;
    }
}
