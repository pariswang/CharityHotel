@extends('layouts.app')
@section('title', '')
@section('content')
<div class="page" id="index">
    <van-button type="primary" round block url="/apply_list">查看申请</van-button>
    <van-button type="primary" round block url="/hotel_list">查找房源</van-button>
    <van-button type="primary" round block url="/login">医护人员入口</van-button>
    <van-button type="primary" round block url="/admin/auth/login">酒店人员入口</van-button>
    <van-button type="primary" round block url="/admin/auth/login">系统管理入口</van-button>
</div>
@endsection
@section('js')
<script src="{{asset('/js/index.js')}}"></script>
@endsection