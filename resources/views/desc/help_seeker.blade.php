@extends('layouts.app')
@section('title', '医护使用说明-')
@section('css')
<style>
html,body,#app{ height:100%;}
</style>
@endsection
@section('content')
<div class="page page--start" id="detail" style="margin-top:10px;">
    <h1 class="page-title">医护使用说明</h1>
    <h2 class="subtitle">为帮助医护人员及志愿者更好地使用此平台，请完整浏览此使用说明：</h2>
    <h2 class="subtitle">第一：请通过本系统的“医护人员入口”进行注册，并开始搜索酒店和提交住宿需求，<font style="font-weight: bold;">本平台的医护爱心价均不超过每间夜100元，非医护优惠价均不超过每间夜200元</font>，包括水电费等杂费。</h2>
    <h2 class="subtitle">第二：通过扫描以下二维码了解使用流程</h2>
    <p class="text-center"><img src="{{asset('/imgs/worker_video_qrcode.png')}}" alt=""></p>
    <h2 class="subtitle">第三：医护人士可以通过系统首页的“咨询客服”进行咨询或寻求服务。</h2>
</div>
@endsection