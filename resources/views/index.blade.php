@extends('layouts.app')
@section('title', '')
@section('content')
<div class="page" id="index">
    <van-button type="primary" round block url="/apply_list">查看申请</van-button>
    <van-button type="primary" round block url="/hotel_list">查找房源</van-button>
    <van-button type="primary" round block url="#">酒店入口</van-button>
    <van-button type="primary" round block url="#">管理入口</van-button>
</div>
@endsection
@section('js')
<script src="{{asset('/js/index.js')}}"></script>
@endsection