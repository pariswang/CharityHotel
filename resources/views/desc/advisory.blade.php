@extends('layouts.app')
@section('title', '酒店支持')
@section('css')
<style>
html,body,#app{ height:100%;}
</style>
@endsection
@section('content')
<div class="page page--start" id="detail">
    <h1 class="page-title">客服咨询</h1>
    <p>客服咨询请按如下步骤进行：</p>
    <h2 class="subtitle">1.扫码关注微信公众号；</h2>
    <p class="text-center"><img src="{{asset('/imgs/advisory_qrcode.png')}}" alt=""></p>
    <h2 class="subtitle">2.在公众号中回复“医护”即可接通人工客服。</h2>
    <p>注：志愿者工作时间为每天早6：00到凌晨1：30，其余时间请留言，客服上班后会第一时间处理您的咨询。</p>
</div>
@endsection