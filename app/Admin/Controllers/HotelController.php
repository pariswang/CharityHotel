<?php

namespace App\Admin\Controllers;

use App\Model\Hotel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HotelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Model\Hotel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Hotel());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('phone', __('Phone'));
        $grid->column('pwd', __('Pwd'));
        $grid->column('region_id', __('Region id'));
        $grid->column('hotel_name', __('Hotel name'));
        $grid->column('simple_name', __('Simple name'));
        $grid->column('classify', __('Classify'));
        $grid->column('meal', __('Meal'));
        $grid->column('address', __('Address'));
        $grid->column('uname', __('Uname'));
        $grid->column('wechat', __('Wechat'));
        $grid->column('room_count', __('Room count'));
        $grid->column('use_room_count', __('Use room count'));
        $grid->column('medical_staff_free', __('Medical staff free'));
        $grid->column('expropriation', __('Expropriation'));
        $grid->column('discount_price', __('Discount price'));
        $grid->column('reception', __('Reception'));
        $grid->column('cleaning', __('Cleaning'));
        $grid->column('collocation_description', __('Collocation description'));
        $grid->column('description', __('Description'));
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
        $show = new Show(Hotel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('phone', __('Phone'));
        $show->field('pwd', __('Pwd'));
        $show->field('region_id', __('Region id'));
        $show->field('hotel_name', __('Hotel name'));
        $show->field('simple_name', __('Simple name'));
        $show->field('classify', __('Classify'));
        $show->field('meal', __('Meal'));
        $show->field('address', __('Address'));
        $show->field('uname', __('Uname'));
        $show->field('wechat', __('Wechat'));
        $show->field('room_count', __('Room count'));
        $show->field('use_room_count', __('Use room count'));
        $show->field('medical_staff_free', __('Medical staff free'));
        $show->field('expropriation', __('Expropriation'));
        $show->field('discount_price', __('Discount price'));
        $show->field('reception', __('Reception'));
        $show->field('cleaning', __('Cleaning'));
        $show->field('collocation_description', __('Collocation description'));
        $show->field('description', __('Description'));
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
        $form = new Form(new Hotel());

        $form->number('user_id', __('User id'));
        $form->mobile('phone', __('Phone'));
        $form->password('pwd', __('Pwd'));
        $form->number('region_id', __('Region id'));
        $form->text('hotel_name', __('Hotel name'));
        $form->text('simple_name', __('Simple name'));
        $form->text('classify', __('Classify'));
        $form->text('meal', __('Meal'));
        $form->text('address', __('Address'));
        $form->text('uname', __('Uname'));
        $form->text('wechat', __('Wechat'));
        $form->number('room_count', __('Room count'));
        $form->number('use_room_count', __('Use room count'));
        $form->switch('medical_staff_free', __('Medical staff free'));
        $form->switch('expropriation', __('Expropriation'));
        $form->decimal('discount_price', __('Discount price'));
        $form->switch('reception', __('Reception'));
        $form->switch('cleaning', __('Cleaning'));
        $form->text('collocation_description', __('Collocation description'));
        $form->text('description', __('Description'));
        $form->datetime('create_date', __('Create date'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
