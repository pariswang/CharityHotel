<?php

namespace App\Admin\Controllers;

use App\Model\Subscribe;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SubscribeController extends AdminController
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

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('conn_person', __('Conn person'));
        $grid->column('conn_phone', __('Conn phone'));
        $grid->column('conn_type', __('Conn type'));
        $grid->column('checkin_num', __('Checkin num'));
        $grid->column('checked', __('Checked'));
        $grid->column('date_begin', __('Date begin'));
        $grid->column('date_end', __('Date end'));
        $grid->column('region_id', __('Region id'));
        $grid->column('hope_addr', __('Hope addr'));
        $grid->column('checkin_reson', __('Checkin reson'));
        $grid->column('remark', __('Remark'));
        $grid->column('createdate', __('Createdate'));
        $grid->column('hotel_id', __('Hotel id'));

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

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('conn_person', __('Conn person'));
        $show->field('conn_phone', __('Conn phone'));
        $show->field('conn_type', __('Conn type'));
        $show->field('checkin_num', __('Checkin num'));
        $show->field('checked', __('Checked'));
        $show->field('date_begin', __('Date begin'));
        $show->field('date_end', __('Date end'));
        $show->field('region_id', __('Region id'));
        $show->field('hope_addr', __('Hope addr'));
        $show->field('checkin_reson', __('Checkin reson'));
        $show->field('remark', __('Remark'));
        $show->field('createdate', __('Createdate'));
        $show->field('hotel_id', __('Hotel id'));

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

        $form->number('user_id', __('User id'));
        $form->text('conn_person', __('Conn person'));
        $form->text('conn_phone', __('Conn phone'));
        $form->number('conn_type', __('Conn type'));
        $form->number('checkin_num', __('Checkin num'));
        $form->number('checked', __('Checked'));
        $form->date('date_begin', __('Date begin'))->default(date('Y-m-d'));
        $form->date('date_end', __('Date end'))->default(date('Y-m-d'));
        $form->number('region_id', __('Region id'));
        $form->text('hope_addr', __('Hope addr'));
        $form->text('checkin_reson', __('Checkin reson'));
        $form->text('remark', __('Remark'));
        $form->datetime('createdate', __('Createdate'))->default(date('Y-m-d H:i:s'));
        $form->number('hotel_id', __('Hotel id'));

        return $form;
    }
}
