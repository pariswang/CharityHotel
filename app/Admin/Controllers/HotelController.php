<?php

namespace App\Admin\Controllers;

use App\Model\Hotel;
use App\Model\Region;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
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
        ;
        $grid = new Grid(new Hotel());
        if(!checkAdminRole('administrator')){
            $grid->model()->where('user_id', '=', Admin::user()->id);
        }
        $grid->column('id', __('ID'));
        $grid->column('region.region_name', __('区域'));
        $grid->column('附近医院')->display(function(){
            $html = "";
            foreach ($this->nearbyHospitals as $key => $value) {
                $html .= "<p>".$value->hospital_name.",距离:<strong>".$value->pivot->distance."</strong>米</p>";
            }
            return $html;
        });
        $grid->column('基本信息')->display(function(){
            $fieldArr = [
                'hotel_name'=>['酒店名称'],
                'simple_name'=>['简称'],
                'classify'=>['类型'],
                'address'=>['地址'],
                'linephone'=>['固定电话'],
                'uname'=>['联系人'],
                'phone'=>['联系人电话'],
                'wechat'=>['微信'],
            ];
            return htmlInOneField($fieldArr,$this);
        });
        $grid->column('详细信息')->display(function(){
            $fieldArr = [
                'meal'=>['早中晚餐饮'],
                'room_count'=>['可安排房间数'],
                // 'use_room_count'=>['已使用房间数'],
                'discount_price'=>['优惠房价'],
                'medical_staff_free'=>['医务人员是否免费','boolean'],
                'expropriation'=>['是否愿意被征用','boolean'],
                'reception'=>['是否有接待','boolean'],
                'cleaning'=>['是否有清洁','boolean'],
            ];
            return htmlInOneField($fieldArr,$this);
        });
        $grid->column('酒店和房间说明')->display(function(){
            $fieldArr = [
                'collocation_description'=>['房间说明','longtext'],
                'description'=>['酒店说明','longtext']
            ];
            return htmlInOneField($fieldArr,$this);
        })->width(350);
        // $grid->column('meal', __('早中晚餐饮'));
        // $grid->column('room_count', __('可安排房间数'));
        // $grid->column('use_room_count', __('已使用房间数'));
        // $grid->column('medical_staff_free', __('医务人员是否免费'));
        // $grid->column('expropriation', __('是否愿意被征用'));
        // $grid->column('discount_price', __('优惠房价'));
        // $grid->column('reception', __('是否有接待'));
        // $grid->column('cleaning', __('是否有清洁'));
        
        // $grid->column('collocation_description', __('房间搭配说明'));
        // $grid->column('description', __('酒店说明'));
        $grid->column('create_date', __('创建日期'));
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            $filter->equal('region_id','地区')->select(Region::pluck('region_name', 'id')->all());
            $filter->like('hotel_name', '酒店名称');
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
        // $show->field('pwd', __('Pwd'));
        $show->field('region_id', __('区域'))->as(function () {
            return isset($this->region)?$this->region->region_name:'';
        });
        $show->field('附近医院')->unescape()->as(function(){
            $html = "";
            foreach ($this->nearbyHospitals as $key => $value) {
                $html .= "<p>".$value->hospital_name.",距离:<strong>".$value->pivot->distance."</strong>米</p>";
            }
            return $html;
        });
        $show->field('hotel_name', __('酒店名称'));
        $show->field('simple_name', __('简称'));
        $show->field('classify', __('类型'));
        $show->field('meal', __('早中晚餐饮'));
        $show->field('address', __('地址'));
        $show->field('uname', __('联系人'));
        $show->field('phone', __('联系人电话'));
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
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $form = new Form(new Hotel());
        // $form->number('user_id', __('User id'));
        // $form->mobile('phone', __('Phone'));
        // $form->password('pwd', __('Pwd'));
        $form->text('hotel_name', __('酒店名称'))->required()->help('无需填写湖北省/武汉市/行政区等信息');
        $form->radio('classify', __('类型'))->options([
            '酒店' => '酒店', '公寓' => '公寓', '民宿' => '民宿',
        ])->required();
        // $form->text('simple_name', __('简称'));
        $form->radio('region_id', __('所在区域'))->options(Region::pluck('region_name', 'id')->all())->required()->help('酒店所属行政区');
     
        $form->text('address', __('地址'))->required()->help('详细填写路名+门牌号，请勿填写武汉市及所属行政区');
        $form->mobile('linephone', __('固定电话'))->options(['mask' => '999 9999 9999'])->required();
        $form->text('uname', __('联系人'))->required();
        $form->mobile('phone', __('手机号码'))->options(['mask' => '999 9999 9999'])->required();
        $form->text('wechat', __('微信号'))->required();
        $form->number('room_count', __('可提供房间数'))->min(1)->help('请设置数字')->required();
        $form->decimal('discount_price', __('优惠价格（元/间）'));
//        $form->number('use_room_count', __('已使用房间数'))->min(0)->help('请设置数字');
        $form->switch('medical_staff_free', __('医务人员是否免费'))->states($states);
        $form->switch('expropriation', __('是否愿意被征用'))->states($states);
        $form->radio('meal', __('是否提供餐食'))->options([
            '早餐' => '早餐', '午餐' => '午餐', '晚餐' => '晚餐', '三餐都提供' => '三餐都提供', '不提供餐食' => '不提供餐食'
        ])->required()->default('不提供餐食');
        $form->switch('reception', __('是否有前台接待'))->states($states);
        $form->switch('cleaning', __('是否提供客房清洁服务'))->states($states);
        $form->text('collocation_description', __('房间配置说明'))->help('如独立空凋,洗衣机,冰箱等');
        $form->textarea('description', __('酒店介绍'))->help('如周边地标、地铁站、火车站等交通信息');
        $form->hasMany('hospitals','周边医院,最近的医院,最多3家', function (Form\NestedForm $form) {
            $form->select('region_id','地区')->options(Region::pluck('region_name', 'id')->all())->load('hospital_id', '/api/hospital_region')->required();
            $form->select('hospital_id','医院')->required();
            $form->number('distance','距离/公里')->required();
        });
        $form->hidden('create_date');
        $form->hidden('user_id');

        $form->footer(function ($footer) {
            // 去掉`重置`按钮
            // $footer->disableReset();
            // 去掉`提交`按钮
            // $footer->disableSubmit();
            // 去掉`查看`checkbox
            $footer->disableViewCheck();
            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();
            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();

        });

        $form->saving(function (Form $form) {
            if($form->hospitals == null || (count($form->hospitals) - array_sum(array_column($form->hospitals, '_remove_')) == 0) ){
                $error = new \Illuminate\Support\MessageBag([
                    'title'   => '请录入周边医院',
                    'message' => '至少录入一家',
                ]);
                return back()->with('error');
            }elseif (count($form->hospitals) - array_sum(array_column($form->hospitals, '_remove_'))>3) {
                $error = new \Illuminate\Support\MessageBag([
                    'title'   => '请录入周边医院',
                    'message' => '至多输入三家',
                ]);
            }elseif (count($form->hospitals) > count(array_unique(array_column($form->hospitals, 'hospital_id'))) ) {
                $error = new \Illuminate\Support\MessageBag([
                    'title'   => '请录入周边医院',
                    'message' => '请勿录入相同医院',
                ]);
            }
            if(isset($error)){
                return back()->with(['error'=>$error]);
            }
            $form->user_id = Admin::user()->id;
            $form->create_date = date('Y-m-d H:i:s');
            return $form;
        });
        return $form;
    }
}
