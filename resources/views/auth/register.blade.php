


@extends('layouts.app')
@section('title', '注册')
@section('content')
<div class="page" id="register">
    <h3 class="register-titile" >本系统为不涉及捐赠等事情，如果发现有人涉嫌利用虚假信息进行诈骗等活动，请及时举报。</h3>
    @csrf
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
    <p class="register-tip">请如实录入您真实信息，不要透漏个人隐私</p>
    <van-button class="login-btn" type="primary" round block :loading="submitLoading" loading-text="注册中..." @click="onSubmit">注册</van-button>
    <van-button plain round block type="default" url="/login">登录</van-button>
</div>
<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="">
    @csrf
    手机：<input name="phone"/><br/>
    密码：<input type="password" name="password"/><br/>
    确认密码：<input type="password" name="password_confirmation"/><br/>
    姓名：<input name="uname"/><br/>
    岗位：<input name="position"/><br/>
    工作单位：<input name="company"/><br/>
    <input type="submit" value="提交"/>
</form>-->
@endsection

@section('js')
<script src="{{asset('/js/register.js')}}"></script>
@endsection
