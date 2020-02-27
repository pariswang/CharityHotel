@extends('layouts.app')
@section('title', '志愿者支持')
@section('css')
<style>
html,body,#app{ height:100%;}
</style>
@endsection
@section('content')
<div class="page page--start" id="detail">
    <h1 class="page-title">&nbsp;</h1>
    <h1 class="page-title">“日月同城”医护酒店公寓平台-志愿者支持</h1>
    <p>当一场突如其来的疫情席卷中华大地时，武汉瞬间成为了旋涡中的焦点所在，牵动着亿万国人的心。</p>
    <p>当看到那么多的医护人员奋不顾身地投入到救治病人的战斗中时，感动之余，几位酒店业主和旅游业内人士也在思考如何以自己的方式支持这场抗击疫情的战斗，武汉医护酒店公寓支援联盟（以下简称联盟）就应运而生了，我们的使命就是为战斗在一线的医护人员和志愿者提供安全的、方便的住宿环境，让他们在战斗之余得到最好的休息。</p>
    <p>武汉医护酒店联盟领导开发了“日月同城”医护酒店公寓平台，其核心目的是协助参与酒店管理和更新酒店房态，方便医护及其他后勤保障类志愿者实时查询酒店房态，并提交住宿需求，最终实现需求和供应的高效匹配。</p>
    <p>为帮助酒店和公寓管理者更好地使用此平台，请按照以下步骤操作：</p>
    <h2 class="subtitle">第一：请扫描以下二维码加入医护酒店公寓平台微信群，参与在线培训，针对系统使用过程中遇到的问题也将通过此群反馈和解答</h2>
    <p class="text-center"><img src="{{asset('/imgs/help_seeker_qrcode.png')}}" alt=""></p>
    <h2 class="subtitle">第二：<a href="http://hotel_healthcare_support.dragongap.cn/download/%E5%8C%BB%E6%8A%A4%E4%BA%BA%E5%91%98%E4%BD%BF%E7%94%A8%E6%89%8B%E5%86%8C.docx" target="_blank">点击此处</a>下载酒店用户手册</h2>
    <h2 class="subtitle">第三：参与在线培训后，扫描以下二维码进入系统开始注册和提交酒店资料</h2>
    <p class="text-center"><img src="{{asset('/imgs/help_seeker_enterqrcode.png')}}" alt=""></p>
</div>
@endsection