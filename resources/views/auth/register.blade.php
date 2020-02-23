


@extends('layouts.app')
@section('title', '注册')
@section('content')
<div class="page page--start" id="register">
    <h1 class="page-title">{{isset($hotel) ? '酒店人员注册' : ' 医护人员注册'}}</h1>
    <h3 class="register-titile" >本系统为不涉及捐赠等事情，如果发现有人涉嫌利用虚假信息进行诈骗等活动，请及时举报。</h3>
    @csrf
    <input type="hidden" name="ishotel" value="{{isset($hotel)? $hotel : '0'}}"/>
    <van-cell-group>
        <van-field
            v-model="phone"
            required
            type="tel"
            maxlength="11"
            label="手机号"
            placeholder="请输入手机号"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="password"
            required
            type="password"
            label="密码"
            placeholder="请输入密码"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="password_f"
            required
            type="password"
            label="确认密码"
            placeholder="请确认密码"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="uname"
            required
            label="姓名"
            placeholder="请输入姓名"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="position"
            required
            label="岗位"
            placeholder="请输入岗位"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="company"
            required
            label="工作单位"
            placeholder="请输入工作单位"/>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-cell--required van-field" @click="showRoles=true">
            <div class="van-cell__title van-field__label"><span>角色</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --space-between">
                    <span v-text="role !== '' ? role : '请选择角色'"></span>
                    <van-icon name="arrow-down"/>
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-popup
        v-model="showRoles"
        closeable
        round
        position="bottom"
        close-icon="{{asset('/imgs/confirm_btn.png')}}"
        :style="{ height: '30%' }">
        <van-picker :columns="roles" @change="rolesOnChange"/>
    </van-popup>
    <p class="register-tip">请如实录入您真实信息，不要透漏个人隐私</p>
    <van-button class="login-btn" type="primary" round block :loading="submitLoading" loading-text="注册中..." @click="onSubmit">注册</van-button>
    <van-button plain round block type="default" url="/login">登录</van-button>
</div>
@endsection

@section('js')
<script src="{{asset('/js/register.js')}}"></script>
@endsection
