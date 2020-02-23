<?php

namespace App\Admin\Controllers;

use App\Model\Subscribe;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

class MyTakingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Model\Subscribe';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Subscribe());

        $grid->model()->where('admin_id', '=', Admin::user()->id);

        $grid->column('id', __('ID'));
        $grid->column('user_id', __('用户'));
        $grid->column('conn_person', __('联系人'));
        $grid->column('conn_phone', __('联系电话'));
        $grid->column('conn_type', __('身份信息'));
        $grid->column('checkin_num', __('入住人数'));
        $grid->column('checked', __('是否核实'));
        $grid->column('date_begin', __('开始日期'));
        $grid->column('date_end', __('结束日期'));
        $grid->column('region_id', __('区域'));
        $grid->column('hope_addr', __('希望地点'));
        $grid->column('checkin_reson', __('入住原因'));
        $grid->column('remark', __('其他说明'));
        $grid->column('createdate', __('创建日期'));
        $grid->column('hotel_id', __('酒店'));
        $grid->column('conn_position', __(''));
        $grid->column('conn_company', __('Conn company'));
        $grid->column('room_count', __('Room count'));
        $grid->column('can_pay', __('Can pay'));
        $grid->column('has_letter', __('Has letter'));
        $grid->column('admin_id', __('Admin id'));
        $grid->column('status', __('Status'));
        $grid->disableActions();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
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
        $show = new Show(Subscribe::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('user_id', __('用户'));
        $show->field('conn_person', __('联系人'));
        $show->field('conn_phone', __('联系电话'));
        $show->field('conn_type', __('身份信息'));
        $show->field('checkin_num', __('入住人数'));
        $show->field('checked', __('是否核实'));
        $show->field('date_begin', __('开始日期'));
        $show->field('date_end', __('结束日期'));
        $show->field('region_id', __('区域'));
        $show->field('hope_addr', __('希望地点'));
        $show->field('checkin_reson', __('入住原因'));
        $show->field('remark', __('其他说明'));
        $show->field('createdate', __('创建日期'));
        $show->field('hotel_id', __('酒店'));

        $show->field('conn_position', __('Conn position'));
        $show->field('conn_company', __('Conn company'));
        $show->field('room_count', __('Room count'));
        $show->field('can_pay', __('Can pay'));
        $show->field('has_letter', __('Has letter'));
        $show->field('admin_id', __('Admin id'));
        $show->field('status', __('Status'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Subscribe());

        $form->number('user_id', __('用户'));
        $form->text('conn_person', __('联系人'));
        $form->text('conn_phone', __('联系电话'));
        $form->number('conn_type', __('身份信息'));
        $form->number('checkin_num', __('入住人数'));
        $form->number('checked', __('是否核实'));
        $form->date('date_begin', __('开始日期'))->default(date('Y-m-d'));
        $form->date('date_end', __('结束日期'))->default(date('Y-m-d'));
        $form->number('region_id', __('区域'));
        $form->text('hope_addr', __('希望地点'));
        $form->text('checkin_reson', __('入住原因'));
        $form->text('remark', __('其他说明'));
        $form->datetime('createdate', __('创建日期'))->default(date('Y-m-d H:i:s'));
        $form->number('hotel_id', __('酒店'));

        $form->text('conn_position', __('Conn position'));
        $form->text('conn_company', __('Conn company'));
        $form->number('room_count', __('Room count'));
        $form->number('can_pay', __('Can pay'));
        $form->number('has_letter', __('Has letter'));
        $form->number('admin_id', __('Admin id'));
        $form->number('status', __('Status'));

        return $form;
    }
}
