<?php

namespace App\Admin\Controllers;

use App\Model\Hotel;
use App\Model\Region;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Box;

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
        if(!checkAdminRole(['administrator','volunteer'])){
            $grid->model()->where('user_id', '=', Admin::user()->id);
        }
        // $grid->model()->orderBy('id', 'desc');
        
        $grid->column('id', __('ID'))->sortable();
        $grid->column('region.region_name', __('区域'));
        $grid->column('附近医院')->display(function(){
            $html = "";
            foreach ($this->nearbyHospitals as $key => $value) {
                $html .= "<p>".$value->hospital_name.",距离:<strong>".$value->pivot->distance."</strong>公里</p>";
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
                // 'medical_staff_free'=>['医务人员是否免费','boolean'],
                'medical_price'=>['医护爱心价（元/间）'],
                'discount_price'=>['非医护优惠价（元/间）'],
                'receive_patient'=>['是否愿意接待隔离医护或病患','boolean'],
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
        $hotel_states = [
            'on'  => ['value' => 0, 'text' => '是', 'color' => 'primary'],
            'off' => ['value' => 5, 'text' => '否', 'color' => 'default']
        ];
        $grid->column('status','是否显示')->switch($hotel_states);

        if(checkAdminRole(['administrator','volunteer'])){
            $ban_status = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'default']
            ];
            $grid->column('ban_status', __('是否禁用'))->switch($ban_status);
        }else{
            $grid->column('ban_status', __('是否禁用'))->display(function () {
                return $this->ban_status?'禁用':'启用';
            });
        }
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
        $grid->column('create_date', __('创建日期'))->sortable();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });
        if(!checkAdminRole(['administrator','hotel_user'])){
            $grid->disableCreateButton();
        }
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            $filter->column(1/2, function ($filter) {
                $filter->equal('region_id','地区')->select(Region::pluck('region_name', 'id')->all());
                $filter->equal('receive_patient', '接待隔离')->select(['1' => '是', '0' => '否']);
            });

            $filter->column(1/2, function ($filter) {
                $filter->like('hotel_name', '酒店名称');
                $filter->where(function ($query) {
                    switch ($this->input) {
                        case '0':
                            $query->where('medical_price', '=', 0);
                            break;
                        case '1':
                            $query->where('medical_price', '>', 0);
                            break;
                    }

                }, '医护免费')->select(['0' => '是', '1' => '否']);
            });
            $filter->orderBy('id', 'desc');
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
                $html .= "<p>".$value->hospital_name.",距离:<strong>".$value->pivot->distance."</strong>公里</p>";
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

    public function create(Content $content)
    {
        return $content
            ->title($this->title())
            ->description("<span style='color:red;'>如遇到问题，<a href='http://1252139118.vod2.myqcloud.com/48f025a3vodcq1252139118/6b40cf595285890799046373528/MO9OIDEE9twA.mp4'>请点击查看帮助视频</a>！</span>")
            ->body($this->form());
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

        $form->text('hotel_name', __('酒店名称'))->required()->help('无需填写湖北省/武汉市/行政区等信息');
        $form->radio('classify', __('类型'))->options([
            '酒店' => '酒店', '公寓' => '公寓', '民宿' => '民宿',
        ])->required();
        // $form->text('simple_name', __('简称'));
        $form->radio('region_id', __('所在区域'))->options(Region::pluck('region_name', 'id')->all())->required()->help('酒店所属行政区');
     
        $form->text('address', __('地址'))->required()->help('详细填写路名+门牌号，请勿填写武汉市及所属行政区');
        $form->mobile('linephone', __('固定电话'))->options(['mask' => '999 9999 9999']);
        $form->text('uname', __('联系人'))->required();
        $form->mobile('phone', __('手机号码'))->options(['mask' => '999 9999 9999'])->required();
        $form->text('wechat', __('微信号'))->required();
        $form->number('room_count', __('可提供房间数'))->min(1)->help('请设置数字')->required();
        $form->number('medical_price', __('医护爱心价（元/间）'))->max(100)->help('最高限价<strong>100</strong>元<br>如果您提供的是<strong>多个房间</strong>的公寓，请按照<strong>每个房间</strong>的价格提交，此价格均已包括水电费等杂费。<br/>请在医护人员入住时查验公函或证件。')->required();
        $form->number('discount_price', __('非医护优惠价（元/间）'))->max(200)->help('最高限价<strong>200</strong>元<br>如果您提供的是<strong>多个房间</strong>的公寓，请按照<strong>每个房间</strong>的价格提交，此价格均已包括水电费等杂费。')->required();
        // $form->switch('medical_staff_free', __('医务人员是否免费'))->states($states)->default(1);
        $form->switch('receive_patient', __('是否愿意接待隔离医护或病患'))->states($states);
        $form->switch('expropriation', __('是否愿意被征用'))->states($states);
        $form->radio('meal', __('是否提供餐食'))->options([
            '早餐' => '早餐', '午餐' => '午餐', '晚餐' => '晚餐', '三餐都提供' => '三餐都提供', '不提供餐食' => '不提供餐食'
        ])->required()->default('不提供餐食');
        $form->switch('reception', __('是否有前台接待'))->states($states)->default(1);
        $form->switch('cleaning', __('是否提供客房清洁服务'))->states($states)->default(1);
        $form->textarea('collocation_description', __('房间说明'))->help('请提供房型说明(单间,两室,三室等)<br>房间配置(如独立空凋,洗衣机,冰箱等)');
        $form->textarea('description', __('酒店介绍'))->help('如周边地标、地铁站、火车站等交通信息');


        $form->hotelHasManyHospitals('hospitals','周边医院', function (Form\NestedForm $form) {
            $form->region('region_id','地区')->options(Region::pluck('region_name', 'id')->all())->load('hospital_id', '/api/hospital_region')->required();
            $form->select('hospital_id','医院')->required()->help('请通过百度地图搜索自己的酒店，然后点击“周边”选择“更多”-“生活”-“医院”就可以看到附近医院列表');
            $form->number('distance','距离/公里')->required();
        });
        $hotel_states = [
            'on'  => ['value' => 0, 'text' => '是', 'color' => 'primary'],
            'off' => ['value' => 5, 'text' => '否', 'color' => 'default'],
        ];
        $form->switch('status','是否显示')->states($hotel_states);
        if(checkAdminRole(['administrator','volunteer'])){
            $ban_status = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'default']
            ];
            $form->switch('ban_status', __('是否禁用'))->states($ban_status);
        }
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
            if(!array_key_exists('user_id', request()->input()) ){
                return $form;
            }
            $count_address = $form->model()->where(['user_id'=>Admin::user()->id,'address'=>$form->address])->count();
            if($form->isCreating() && $count_address>0){
                $error = new \Illuminate\Support\MessageBag([
                    'title'   => '您已创建该地址的酒店',
                    'message' => '请核查您的酒店列表，已有该地址的酒店'
                ]);
            }
            if (isset($form->hospitals) && count($form->hospitals) - array_sum(array_column($form->hospitals, '_remove_'))>3) {
                $error = new \Illuminate\Support\MessageBag([
                    'title'   => '请录入周边医院',
                    'message' => '至多输入三家',
                ]);
            }elseif (isset($form->hospitals) && count($form->hospitals) > count(array_unique(array_column($form->hospitals, 'hospital_id'))) ) {
                $error = new \Illuminate\Support\MessageBag([
                    'title'   => '请录入周边医院',
                    'message' => '请勿录入相同医院',
                ]);
            }
            if(isset($error)){
                return back()->withInput()->with(compact('error'));
            }
            if($form->isCreating()){
                $form->user_id = Admin::user()->id;
                $form->create_date = date('Y-m-d H:i:s');
            }
            return $form;
        });
        return $form;
    }
}
