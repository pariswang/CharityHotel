<?php

namespace App\Admin\Controllers;

use App\Model\Subscribe;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Form\Builder;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use App\Model\Hotel;
use Encore\Admin\Layout\Content;
use Request;

class SubscribeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '房源需求';

    public function myTaking(Content $content) 
    {
        return $content
            ->header('我的已接单')
            ->description('')
            ->body($this->grid());
    }

    public function myApply(Content $content) 
    {
        return $content
            ->header('申请单(我的酒店)')
            ->description('')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Subscribe());
        $path = explode('/',request()->path())[1];
        if(Admin::user()->id != '1'){
            switch ($path) {
                case 'subscribe':
                    $grid->model()->where(['admin_id'=> 0,'hotel_id'=> 0]);
                    break;
                case 'my-apply':
                    $grid->model()->where(['admin_id'=> Admin::user()->id,'status'=>1]);
                    break;
                case 'my-taking':
                    $grid->model()->where(['admin_id'=> Admin::user()->id,'status'=>5]);
                    break;
                default:
                    # code...
                    break;
            }
        }
        $grid->column('id', __('ID'));

        $grid->column('user.uname', __('用户'));
        $grid->column('region.region_name', __('区域'));
        $grid->column('基本信息1')->display(function(){
            return htmlInOneField([
                'conn_person'=>['联系人'],
                'conn_phone'=>['联系电话'],
                'conn_type'=>['身份信息'],
                'checkin_num'=>['入住人数'],
                'date_begin'=>['开始日期'],
                'date_end'=>['结束日期'],
                'hope_addr'=>['希望地点'],
                'checkin_reson'=>['入住原因'],
                'remark'=>['其他说明'],
            ],$this);
        });
        $grid->column('基本信息2')->display(function(){
            return htmlInOneField([
                'conn_position'=>['联系人职位'],
                'conn_company'=>['联系人公司'],
                'room_count'=>['所需房间数'],
                'checkin_num'=>['入住人数'],
                'can_pay'=>['能否支付费用','boolean'],
                'has_letter'=>['是否有介绍信','boolean'],
            ],$this);
        });
        $grid->column('checked', __('是否核实'))->display(function () {
            return $this->checked?'已核实':'未核实';
        });
        if(checkAdminRole('administrator')){
            $grid->column('status', __('接单状态'))->display(function () {
                return $this->status==5?'已接单':'未接单';
            });
            $grid->column('hotel.hotel_name', __('接单酒店'));
        }else{
            $grid->column('接单操作')->display(function(){
                if($this->status == 1){
                    return '<a href="/admin/taking/'.$this->id.'" class="btn btn-sm btn-success"><i class="fa fa-plus"></i><span class="hidden-xs">'.(explode('/',request()->path())[1]=='my-apply'?'确认接单':'我要接单').'</span></a>';
                }
                return $this->status==5?'已接单':'未接单';
                
            });
        }
        $grid->column('createdate', __('创建日期'));

        // $grid->column('conn_person', __('联系人'));
        // $grid->column('conn_phone', __('联系电话'));
        // $grid->column('conn_type', __('身份信息'));
        // $grid->column('checkin_num', __('入住人数'));
        // $grid->column('date_begin', __('开始日期'));
        // $grid->column('date_end', __('结束日期'));
        // $grid->column('hope_addr', __('希望地点'));
        // $grid->column('checkin_reson', __('入住原因'));
        // $grid->column('remark', __('其他说明'));

        // $grid->column('conn_position', __('联系人职位'));
        // $grid->column('conn_company', __('联系人公司'));
        // $grid->column('room_count', __('所需房间数'));
        // $grid->column('can_pay', __('能否支付费用'));
        // $grid->column('has_letter', __('是否有介绍信'));
        // // $grid->column('admin_id', __('Admin id'));
        // // $grid->column('status', __('接单状态'));
        // $grid->column('hotel_id', __('接单酒店'));
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableCreateButton();
        $grid->disableActions();
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            if(explode('/',request()->path())[1] != 'my-taking'){
                $filter->disableIdFilter();
            }
            $filter->equal('region_id','地区')->select(\App\Model\Region::pluck('region_name', 'id')->all());
        });
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableView();
            $actions->disableEdit();
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
        // $show = new Show(Subscribe::findOrFail($id));

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
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        // $form = new Form(new Subscribe());

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

        return $form;
    }

    public function taking($id, Content $content)
    {
        if(Hotel::where('user_id',Admin::user()->id)->doesntExist()){
            return $content->withWarning('错误', '请先进入酒店管理菜单->新增酒店,创建酒店后方可接单');
        }
        if($subs = Subscribe::find($id)){
            if($subs->admin_id != 0 && $subs->admin_id != Admin::user()->id){
                return $content->withWarning('错误', '您不能操作该申请单！');
            }
        }else{
            return $content->withWarning('错误', '申请单不存在！');
        }
        
        $form = $this->takingForm($id);
        if (Request::capture()->isMethod("put")){
            return $form->update($id);
        }
        return $content
            ->header('接单提交')
            ->body($form->edit($id));
    }

    protected function takingForm($id)
    {
        $form = new Form(new Subscribe());
        $subs = Subscribe::find($id);
        if($subs->hotel_id > 0){
            $form->select('hotel_id', __('酒店'))->options(Hotel::where('user_id',Admin::user()->id)->pluck('hotel_name', 'id')->all())->readonly()->help('申请人预选的酒店无法更改');
        }else{
            $form->select('hotel_id', __('酒店'))->options(Hotel::where('user_id',Admin::user()->id)->pluck('hotel_name', 'id')->all())->required()->help('请选择您要接单的酒店');
        }
        $form->hidden('admin_id');
        $form->hidden('status');
        $form->setAction($form->resource().'/taking/'.$id);

        $form->hidden(Builder::PREVIOUS_URL_KEY)->value($form->resource());
        $form->ignore(Builder::PREVIOUS_URL_KEY);

        $form->tools(function (Form\Tools $tools) {
            $tools->disableList();// 去掉`列表`按钮
            $tools->disableDelete();// 去掉`删除`按钮
            $tools->disableView();// 去掉`查看`按钮
        });
        $form->footer(function ($footer) {
            $footer->disableReset();// 去掉`重置`按钮
            // $footer->disableSubmit();// 去掉`提交`按钮
            $footer->disableViewCheck();// 去掉`查看`checkbox
            $footer->disableEditingCheck();// 去掉`继续编辑`checkbox
            $footer->disableCreatingCheck();// 去掉`继续创建`checkbox
        });
        $form->saving(function (Form $form) {
            $form->admin_id = Admin::user()->id;
            $form->status = 5;
            return $form;
        });
        $form->saved(function (Form $form) {
            if($form->status == 5){
                return redirect('/admin/my-taking?id='.$form->model()->id);
            }
        });

        return $form;
    }



}
