@extends('layouts.app')
@section('title', '酒店使用说明-')
@section('css')
<style>
html,body,#app{ height:100%;}
</style>
@endsection
@section('content')
<div class="page page--start" id="detail" style="margin-top:10px;">
    <h1 class="page-title">酒店使用说明</h1>
    <h2 class="subtitle">为帮助医护人员及志愿者更好地使用此平台，请完整浏览此使用说明：</h2>
    <h2 class="subtitle">第一：请通过本系统的“酒店人员入口”进行注册，并按照要求提交相应的酒店资料即可发布酒店，接待医护人员和其他志愿者。</h2>
    <h2 class="subtitle">第二：<a href="http://hotel_healthcare_support.dragongap.cn/download/%E9%85%92%E5%BA%97%E5%91%98%E5%B7%A5%E4%BD%BF%E7%94%A8%E6%89%8B%E5%86%8C.docx" target="_blank">点击此处</a>下载酒店用户手册了解使用流程</h2>
    <h2 class="subtitle">第三：可以通过以下二维码浏览酒店端操作视频了解使用流程</h2>
    <p class="text-center"><img src="{{asset('/imgs/hotle_video_qrcode.png')}}" alt=""></p>
    <h2 class="subtitle">第四：可以通过系统首页的“咨询客服”进行咨询或寻求支持。</h2>
</div>
@endsection