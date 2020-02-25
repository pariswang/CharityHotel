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
    protected $title = '用户列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('ID'));
        $grid->column('phone', __('手机号'));
        $grid->column('uname', __('姓名'));
        $grid->column('wechat', __('微信号'));
        $grid->column('phonenumber', __('联系电话'));
        $grid->column('position', __('岗位'));
        $grid->column('company', __('公司'));
        $grid->column('role', __('角色'))->using(['1' => '管理人员', '2' => '求助者', '3'=>'酒店人员','4'=>'志愿者']);
        $grid->column('state', __('核实状态'));
        $grid->column('create_date', __('创建时间'));
        // $grid->column('openid', __('Openid'));
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('uname', '姓名');
            $filter->like('phone', '手机号');
            $filter->equal('role', '用户角色')->select(['1' => '管理人员', '2' => '求助者', '3'=>'酒店人员','4'=>'志愿者']);
        });
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });
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
        $show->field('id', __('ID'));
        $show->field('phone', __('手机号'));
        $show->field('uname', __('姓名'));
        $show->field('wechat', __('微信号'));
        $show->field('phonenumber', __('联系电话'));
        $show->field('position', __('岗位'));
        $show->field('company', __('公司'));
        $show->field('role', __('角色'));
        $show->field('state', __('核实状态'));
        $show->field('create_date', __('创建时间'));
        // $show->field('openid', __('Openid'));
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

        $form->mobile('phone', __('手机号'));
        $form->text('uname', __('姓名'));
        $form->text('wechat', __('微信号'));
        $form->text('phonenumber', __('联系电话'));
        $form->text('position', __('岗位'));
        $form->text('company', __('公司'));
        $form->switch('role', __('角色'));
        $form->switch('state', __('核实状态'));
        $form->datetime('create_date', __('创建时间'))->default(date('Y-m-d H:i:s'));
        // $form->text('openid', __('Openid'));

        return $form;
    }
}
