@extends('layouts.app')
@section('title', '登录')
@section('css')
<style>
html,body,#app{ height:100%;}
</style>
@endsection
@section('content')
<div class="page" id="login">
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
    <van-button class="login-btn" color="#1d63cb" round block :loading="submitLoading" loading-text="登录中..." @click="onSubmit">登录</van-button>
    <van-button plain round block type="default" url="/register">注册</van-button>
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
    <input type="submit" value="提交"/>
</form>

<a href="/register">注册</a> -->
@endsection

@section('js')
<script src="{{asset('/js/login.js')}}"></script>
@endsection
