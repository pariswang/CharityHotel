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
    protected $title = '酒店管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Hotel());

        $grid->column('id', __('ID'));
        // $grid->column('user_id', __('关联用户'));
        // $grid->column('phone', __('Phone'));
        // $grid->column('pwd', __('Pwd'));
        $grid->column('region_id', __('区域'));
        // $grid->column('hotel_name', __('酒店名称'));
        // $grid->column('simple_name', __('简称'));
        // $grid->column('classify', __('类型'));
        // $grid->column('address', __('地址'));
        // $grid->column('uname', __('联系人'));
        // $grid->column('wechat', __('微信'));
        $grid->column('基本信息')->display(function(){
            $fieldArr = [
                'hotel_name'=>'酒店名称',
                'simple_name'=>'简称',
                'classify'=>'类型',
                'address'=>'地址',
                'uname'=>'联系人',
                'wechat'=>'微信',
                'user_id'=>'关联用户',
            ];
            $html = "";
            $cursor = 0;
            foreach ($fieldArr as $key => $value) {
                if(isset($this->$key)){
                    $html .= "<p>".$value.":<strong>".$this->$key."</strong></p>";
                }
            }
            return $html;
        });
        $grid->column('详细信息')->display(function(){
            $fieldArr = [
                'meal'=>'早中晚餐饮',
                'room_count'=>'可安排房间数',
                'use_room_count'=>'已使用房间数',
                'discount_price'=>'优惠房价',
                'medical_staff_free'=>'医务人员是否免费',
                'expropriation'=>'是否愿意被征用',
                'reception'=>'是否有接待',
                'cleaning'=>'是否有清洁',
            ];
            $html = "";
            $cursor = 0;
            foreach ($fieldArr as $key => $value) {
                if(isset($this->$key)){
                    $html .= "<p>".$value.":<strong>".($cursor>3?($this->$key?'是':'否'):$this->$key)."</strong></p>";
                }
                $cursor++;
            }
            return $html;
        });
        // $grid->column('meal', __('早中晚餐饮'));
        // $grid->column('room_count', __('可安排房间数'));
        // $grid->column('use_room_count', __('已使用房间数'));
        // $grid->column('medical_staff_free', __('医务人员是否免费'));
        // $grid->column('expropriation', __('是否愿意被征用'));
        // $grid->column('discount_price', __('优惠房价'));
        // $grid->column('reception', __('是否有接待'));
        // $grid->column('cleaning', __('是否有清洁'));
        $grid->column('collocation_description', __('房间搭配说明'));
        $grid->column('description', __('酒店说明'));
        $grid->column('create_date', __('创建日期'));
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
        $show = new Show(Hotel::findOrFail($id));
        $show->field('id', __('ID'));
        $show->field('user_id', __('关联用户'));
        // $show->field('phone', __('Phone'));
        // $show->field('pwd', __('Pwd'));
        $show->field('region_id', __('区域'));
        $show->field('hotel_name', __('酒店名称'));
        $show->field('simple_name', __('简称'));
        $show->field('classify', __('类型'));
        $show->field('meal', __('早中晚餐饮'));
        $show->field('address', __('地址'));
        $show->field('uname', __('联系人'));
        $show->field('wechat', __('微信'));
        $show->field('room_count', __('可安排房间数'));
        $show->field('use_room_count', __('已使用房间数'));
        $show->field('medical_staff_free', __('医务人员是否免费'));
        $show->field('expropriation', __('是否愿意被征用'));
        $show->field('discount_price', __('优惠房价'));
        $show->field('reception', __('是否有接待'));
        $show->field('cleaning', __('是否有清洁'));
        $show->field('collocation_description', __('房间搭配说明'));
        $show->field('description', __('酒店说明'));
        $show->field('create_date', __('创建日期'));

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

        // $form->number('user_id', __('User id'));
        // $form->mobile('phone', __('Phone'));
        // $form->password('pwd', __('Pwd'));
        $form->number('region_id', __('区域'));
        $form->text('hotel_name', __('酒店名称'));
        $form->text('simple_name', __('简称'));
        $form->text('classify', __('类型'));
        $form->text('meal', __('早中晚餐饮'));
        $form->text('address', __('地址'));
        $form->text('uname', __('联系人'));
        $form->text('wechat', __('微信'));
        $form->number('room_count', __('可安排房间数'));
        $form->number('use_room_count', __('已使用房间数'));
        $form->switch('medical_staff_free', __('医务人员是否免费'));
        $form->switch('expropriation', __('是否愿意被征用'));
        $form->decimal('discount_price', __('优惠房价'));
        $form->switch('reception', __('是否有接待'));
        $form->switch('cleaning', __('是否有清洁'));
        $form->text('collocation_description', __('房间搭配说明'));
        $form->text('description', __('酒店说明'));
        $form->datetime('create_date', __('创建日期'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
