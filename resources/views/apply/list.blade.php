<!--
参数：
/apply_list?distinct={distinct_id}&hospital={hospital_id}&s={addr_str}&status={status_id}
-->
<!-- status:
1 => 已申请
5 => 已接单 -->

@extends('layouts.app')
@section('title', '申请列表')
@section('content')
<div class="page" id="applylList">
    <div class="list-hd">
        <div class="pickers">
            <van-button type="default" icon="arrow-down" round block size="small" plain :text="area !== '' ? area : '请选择区域'" @click="showAreas=true"></van-button>
            <!-- <van-button type="default" icon="arrow-down" round block size="small" plain :text="hospital !== '' ? hospital : '请选择医院'" @click="showHospitals=true"></van-button> -->
            <van-button type="default" icon="arrow-down" round block size="small" plain :text="statu !== '' ? statu : '请选择状态'" @click="showStatus=true"></van-button>
        </div>
        <van-field v-model="keyword" placeholder="地址关键词">
            <van-button slot="button" color="#1d63cb" round size="small" @click="onSearch">查询</van-button>
        </van-field>
        <!-- <van-action-sheet v-model="showAreas" :actions="areas" @select="areaOnSelect" /> -->
    </div>
    <van-popup
        v-model="showAreas"
        closeable
        round
        position="bottom"
        close-icon="{{asset('/imgs/confirm_btn.png')}}"
        :style="{ height: '30%' }">
        <van-picker :columns="areas" :default-index="areaIndex || 0" @change="areaOnChange"/>
    </van-popup>
    <van-popup
        v-model="showHospitals"
        closeable
        round
        position="bottom"
        close-icon="{{asset('/imgs/confirm_btn.png')}}"
        :style="{ height: '30%' }">
        <van-picker :columns="hospitals" @change="hospitalOnChange"/>
    </van-popup>
    <van-popup
        v-model="showStatus"
        closeable
        round
        position="bottom"
        close-icon="{{asset('/imgs/confirm_btn.png')}}"
        :style="{ height: '30%' }">
        <van-picker :columns="status" :default-index="statuIndex || 0" @change="statuOnChange"/>
    </van-popup>
    <!--
    参数说明
    ?distinct={distinct_id}&hospital={hospital_id}&s={addr_str}
    -->
    @forelse ($applies as $apply)
        <div class="item">
            <div class="item-hd">
                <span>{{$apply->date_begin}}</span>
                <span class="item__value" style="color:#1e63cb">
                    {{$apply->region ? $apply->region->region_name : ''}}
                </span>
            </div>
            <div class="item-bd">
                @if ($apply->region_id)
                    {{$apply->region->region_name}}{{$apply->hope_addr ?? ''}} ，
                @elseif ($apply->hotel_id)
                    {{$apply->hotel->region->region_name}}{{$apply->hotel->address}}附近，
                @else
                    &nbsp;
                @endif
                {{$apply->conn_company}} {{$apply->checkin_num}}名 {{$apply->conn_position}} 急需酒店。
                联系人：{{$apply->conn_person}}
            </div>
            <div class="item-ft">
                {{--<van-button type="default" size="small" round plain url="#">已拒绝</van-button>--}}
                @if ($apply->status==1)
                    <van-button color="#1d63cb" size="small" round url="/apply_detail?id={{$apply->id}}">我来接单</van-button>
                @elseif ($apply->status==5)
                    <van-button color="#1d63cb" size="small" round plain url="/apply_detail?id={{$apply->id}}">查看详情</van-button>
                @endif
            </div>
        </div>
    @empty
        <div class="item-empty">
            <p><van-icon name="bulb-o" size="60"/></p>
            <p>没有查询出符合条件的申请信息, 换个条件试试~</p>
        </div>
    @endforelse
    <div class="ft-cover">
        <van-button color="#1d63cb" block round url="/admin/hotel/create">发布酒店信息</van-button>
    </div>
</div>
@endsection
@section('js')
<script>
    var REGIONS = {!! $regions->toJson() !!};
    var HOSPITALS = {!! $hospitals->toJson() !!};
    var STATUS = [
        {
            id: 1,
            statu_name: '已申请',
        },
        {
            id: 5,
            statu_name: '已接单',
        }
    ];
    console.log('REGIONS', REGIONS);
    console.log('HOSPITALS', HOSPITALS);
</script>
<script src="{{asset('/js/apply_list.js').'?'.time()}}"></script>
@endsection
