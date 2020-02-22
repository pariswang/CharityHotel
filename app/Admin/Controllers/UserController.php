<?php

namespace App\Admin\Controllers;

use App\Model\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Model\User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('phone', __('Phone'));
        $grid->column('uname', __('Uname'));
        $grid->column('wechat', __('Wechat'));
        $grid->column('phonenumber', __('Phonenumber'));
        $grid->column('position', __('Position'));
        $grid->column('company', __('Company'));
        $grid->column('role', __('Role'));
        $grid->column('state', __('State'));
        $grid->column('create_date', __('Create date'));
        $grid->column('openid', __('Openid'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('phone', __('Phone'));
        $show->field('uname', __('Uname'));
        $show->field('wechat', __('Wechat'));
        $show->field('phonenumber', __('Phonenumber'));
        $show->field('position', __('Position'));
        $show->field('company', __('Company'));
        $show->field('role', __('Role'));
        $show->field('state', __('State'));
        $show->field('create_date', __('Create date'));
        $show->field('openid', __('Openid'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->mobile('phone', __('Phone'));
        $form->text('uname', __('Uname'));
        $form->text('wechat', __('Wechat'));
        $form->text('phonenumber', __('Phonenumber'));
        $form->text('position', __('Position'));
        $form->text('company', __('Company'));
        $form->switch('role', __('Role'));
        $form->switch('state', __('State'));
        $form->datetime('create_date', __('Create date'))->default(date('Y-m-d H:i:s'));
        $form->text('openid', __('Openid'));

        return $form;
    }
}
