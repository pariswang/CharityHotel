@extends('layouts.app')
@section('title', '公告-')
@section('css')
<style>
html,body,#app{ height:100%;}
.sub_title {font-weight: bold;}
</style>
@endsection
@section('content')
<div class="page page--start" id="detail" style="margin-top:10px;">
    <h1 class="page-title">关于酒店公寓志愿联盟调整平台定价规则的通知</h1>

    <p class="sub_title">尊敬的酒店公寓业主：</p>

    <p>酒店公寓志愿联盟（以下简称联盟）于1月25日发布了“日月同城医护酒店公寓平台（以下简称平台）”，得到了广大医护人员和酒店业主的支持，再次感谢您的信任！</p>

    <p>截止2020年3月1日中午，已经有161家酒店通过平台提供近4500个房间，但由于部分酒店定价偏高，且地理位置不邻近医院，医护人员选择的几率相对比较低，也影响了医护人员的体验。</p>

    <p>为了最大程度地利用各家酒店的现有供应量，同时在这个特殊时期为医护人员及志愿者提供性价比最高的住宿服务，联盟和平台决定自即日起对平台的定价规则做如下调整：</p>

    <p class="sub_title">新增酒店：</p>

    <p>新增酒店在注册时需要提供医护爱心价和非医护优惠价两类价格，其中医护爱心价不得超过100元，非医护优惠价不得超过200元。</p>

    <p class="text-center"><img src="{{asset('/imgs/notice_pic_01.png')}}" alt=""></p>

    <p class="sub_title">备注：</p>
    <p> 在以上页面中，如输入医护爱心价超过100，系统将默认为100元；请在医护人员入住时查验医院公函或工作证</p>
    <p> 在以上页面中，如输入非医护优惠价超过200元，系统将默认为200元</p>
    <p> 如提供公寓式住宿服务，请按照每个房间的价格提交，请在备注处注明最短起租期及押金等信息，平台将尽力协助医护人员安排合租。</p>

    <p class="sub_title">此前提交信息的酒店：</p>
    
    <p>如此前提交的优惠价格（A）低于100元，则默认医护爱心价等于=非医护优惠价=A</p>

    <p>如此前提交的优惠价格 （B）低于100元，小于200元，则非医护优惠价=B，医护爱心价不显示，请尽快登陆系统设定医护爱心价（不超过100元）</p>
    
    <p>如此前提交的优惠价格 （C）高于200元，则非医护优惠价=C，医护爱心价不显示，请尽快登陆系统设定医护爱心价（不超过100元）和非医护优惠价（不超过200元）。</p>
    
    <p>请各位业主在收到此通知后尽快登陆系统，按照上述要求修改价格信息。</p>

    <p>如未能在3月2日1200前进行价格信息修改，平台默认将所有医护爱心价和非医护优惠价分别设定为100元和200元。</p>

    <p class="sub_title">目前平台的酒店列表页面和搜索结果页面是按照低价优先的规则进行展示，以便于医护人员选择性价比更高的住宿服务。</p>
    
    <p>如不能接受上述规则，酒店可以选择通过系统将所属酒店进行隐藏处理（将系统内的状态改为禁用）。</p>

    <p class="sub_title">另，平台上公布的全部价格均包括水电费等杂费，酒店及公寓不得额外收取任何其他费用。如有客户投诉并确认，平台将有权对相关酒店做下线处理。</p>
    <br/>
    <div style="width: 100%;">
        <p class="sub_title">
            <span style="float: right; margin-right: 10px;">
                酒店公寓志愿联盟<br/>
                日月同城医护酒店公寓平台<br/>
                2020年3月1日<br/>
            </span>
        </p>
    </div>
</div>
@endsection