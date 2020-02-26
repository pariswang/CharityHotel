<?php

namespace App\Admin\Controllers;

use App\Model\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;

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

        $grid->column('id', __('ID'))->sortable();
        $grid->column('phone', __('手机号'));
        $grid->column('uname', __('姓名'));
        $grid->column('wechat', __('微信号'));
        $grid->column('phonenumber', __('联系电话'));
        $grid->column('position', __('岗位'));
        $grid->column('company', __('公司'));
        $grid->column('role', __('角色'))->using(['1' => '管理人员', '2' => '求助者', '3'=>'酒店人员','4'=>'志愿者']);
        $grid->column('state', __('核实状态'));
        $grid->column('create_date', __('创建时间'))->sortable();
        $grid->column('附加信息')->display(function(){
            switch ($this->role) {
                case '3':
                    if($hasHotelAdminUser = \App\Model\AdminUser::where('username',$this->phone)->has('hotels')->first()){
                        return implode("<br>", $hasHotelAdminUser->hotels->map(function ($hotel){
                            return $hotel->hotel_name.',ID:'.$hotel->id;
                        })->toArray());
                    }else{
                        return '未发布酒店';
                    }
                    return $hasHotelAdminUser ? $hasHotelAdminUser->hotels->pluck('hotel_name','id')->toArray() : '无发布酒店'; 
                    break;
                default:
                    break;
            }
        });
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


    /**
     * User setting page.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function getSetting(Content $content)
    {
        $form = $this->settingForm();
        $form->tools(
            function (Form\Tools $tools) {
                $tools->disableList();
                $tools->disableDelete();
                $tools->disableView();
            }
        );

        return $content
            ->title(trans('admin.user_setting'))
            ->body($form->edit(\Encore\Admin\Facades\Admin::user()->id));
    }

    /**
     * Update user setting.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putSetting()
    {
        return $this->settingForm()->update(\Encore\Admin\Facades\Admin::user()->id);
    }

    /**
     * Model-form for user setting.
     *
     * @return Form
     */
    protected function settingForm()
    {
        $class = config('admin.database.users_model');

        $form = new Form(new $class());

        $form->display('username', trans('admin.username'));
        $form->text('name', trans('admin.name'))->rules('required');
        // $form->image('avatar', trans('admin.avatar'));
        $form->password('password', trans('admin.password'))->rules('confirmed|required');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->setAction(admin_url('auth/setting'));

        $form->ignore(['password_confirmation']);

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
        });

        $form->saved(function () {
            admin_toastr(trans('admin.update_succeeded'));

            return redirect(admin_url('auth/setting'));
        });

        return $form;
    }
}
