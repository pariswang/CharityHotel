@extends('layouts.app')
@section('title', '')
@section('css')
<style>
html,body,#app{ height:100%;}
</style>
@endsection
@section('content')
<div class="page page--start" id="index">
    <div class="banner __img-box"><img src="{{asset('/imgs/banner.jpg')}}" alt=""></div>
    <div class="menu-contain">
        <a href="/apply_list" class="menu__item">
            <div class="menu__icon __imgobox"><img src="{{asset('/imgs/icon_apply.png')}}" alt=""></div>
            <span class="menu__text">查看申请</span>
        </a>
        <a href="/hotel_list" class="menu__item">
            <div class="menu__icon __imgobox"><img src="{{asset('/imgs/icon_room.png')}}" alt=""></div>
            <span class="menu__text">查找房源</span>
        </a>
        <a href="/login" class="menu__item">
            <div class="menu__icon __imgobox"><img src="{{asset('/imgs/icon_doctor.png')}}" alt=""></div>
            <span class="menu__text">医护人员入口</span>
        </a>
        <a href="/admin/auth/login" class="menu__item">
            <div class="menu__icon __imgobox"><img src="{{asset('/imgs/icon_hottle.png')}}" alt=""></div>
            <span class="menu__text">酒店人员入口</span>
        </a>
        <!-- <a href="/admin/auth/login"" class="menu__item">
            <div class="menu__icon __imgobox"><img src="{{asset('/imgs/icon_setting.png')}}" alt=""></div>
            <span class="menu__text">系统管理入口</span>
        </a>
        <a href="/login"" class="menu__item">
            <div class="menu__icon __imgobox"><img src="{{asset('/imgs/icon_volunteer.png')}}" alt=""></div>
            <span class="menu__text">志愿者入口</span>
        </a> -->
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('/js/index.js')}}"></script>
@endsection