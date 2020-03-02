@extends('layouts.app')
@section('title', '志愿者招募-')
@section('css')
<style>
html,body,#app{ height:100%;}
.sub_title {font-weight: bold;}
</style>
@endsection
@section('content')
<div class="page page--start" id="detail" style="margin-top:10px;">
    <h1 class="page-title">志愿者招募</h1>

    <p>酒店公寓志愿联盟领导开发的“日月同城”医护酒店平台已经上线，其核心目的是协助参与酒店管理和更新酒店房态，方便医护及其他后勤保障类志愿者实时查询酒店房态，并提交住宿需求，最终实现需求和供应的高效匹配。</p>

    <p>为了保证平台的正常运营和优化，在此面向社会爱心人士招募志愿者，欢迎有客服、运营、IT开发等方面工作经验者申请。</p>

    <p class="sub_title">PHP开发工程师</p>
    <p>工作职责：</p>
    <p>负责网站核心产品和内部管理系统的开发。</p>
    <p>任职要求：</p>
    <p>
        - 熟悉PHP开发，有一定的架构能力和良好代码规范；<br/> 
        - 熟悉mysql数据库应用开发，对性能优化有一定的经验；
    </p>

    <p class="sub_title">客服支持</p>
    <p>工作职责：</p>
    <p>
        - 与医护人员和酒店沟通，解决并反馈系统使用过程中的问题；<br/> 
        - 协助医护人员匹配住宿需求；<br/> 
        - 与酒店沟通医护人员的住宿需求；<br/> 
        - 负责其他临时安排的志愿者工作；<br/> 
    </p>
    <p>任职要求：</p>
    <p>
        - 具备客服、运营、IT、产品经验者优先；<br/> 
        - 乐于参与志愿者服务工作，有高度的奉献精神和专业的工作态度；<br/> 
        - 在未来两周内每天保证至少2小时的工作时间，可以参与排班。初期可能工作量稍大，但随着系统的稳定，工作量将逐步减少<br/> 
        - 日常沟通基本通过微信和电话，需保证网络畅通<br/> 
        - 必要时可以使用电脑整理文件和统计工作
    </p>

    <p class="sub_title">备注：以上志愿者职位均为远程参与。</p>

    <p>如有意参与，请进行<a href="https://www.wenjuan.com/s/bAfEB3c/">在线申请</a>或扫描下方二维码申请，请在申请前确认是否可以满足以上的工作时间要求。我们将在接收申请的24小时内通过微信或电话沟通。</p>

    <p class="text-center"><img src="{{asset('/imgs/voluteer_pic_01.jpg')}}" alt=""></p>
</div>
@endsection