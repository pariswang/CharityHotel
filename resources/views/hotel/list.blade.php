@extends('layouts.app')
@section('title', '酒店列表')
@section('content')
<div class="page" id="hotelList">
    <div class="list-hd">
        <div class="pickers">
            <van-button type="default" icon="arrow-down" round block size="small" plain :text="area !== '' ? area : '请选择区域'" @click="showAreas=true"></van-button>
            <van-button type="default" icon="arrow-down" round block size="small" plain :text="hospital !== '' ? hospital : '请选择医院'" @click="showHospitals=true"></van-button>
            <!-- <van-button type="default" icon="arrow-down" round block size="small" plain :text="statu !== '' ? statu : '请选择状态'" @click="showStatus=true"></van-button> -->
        </div>
        <van-field v-model="keyword" placeholder="地址关键词">
            <van-button slot="button" type="primary" round size="small" @click="onSearch">查询</van-button>
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
        <van-picker :columns="areas" @change="areaOnChange"/>
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
        <van-picker :columns="status" @change="statuOnChange"/>
    </van-popup>
    <!--
    参数说明
    ?distinct={distinct_id}&hospital={hospital_id}&s={addr_str}
    -->
    @foreach ($hotels as $hotel)
    <div class="item">
        <div class="item-hd">
            <span>2019/02/19</span>
            <span class="item__value">{{$hotel->region->region_name}}</span>
        </div>
        <div class="item-bd">
            {{$hotel->hotel_name}}可安排{{$hotel->room_count-$hotel->use_room_count}}间，
            @if ($hotel->medical_staff_free)
                医护人员免费，其他收费<span class="text--green">{{$hotel->discount_price}}/晚</span>。
                @else
                <span class="text--green">免费</span>。
            @endif
            联系人:{{$hotel->uname}}
        </div>
        <div class="item-ft">
            <van-button type="default" size="small" round plain url="#">已申请xxx酒店</van-button>
            <van-button type="primary" size="small" round plain url="/hotel_detail?id={{$hotel->id}}">查看详情</van-button>
            <van-button type="primary" size="small" round url="/apply_hotel?id={{$hotel->id}}">我要申请</van-button>
        </div>
    </div>
    @endforeach
    <div class="ft-cover">
        <van-button type="primary" block round url="/apply">发布住宿申请</van-button>
    </div>
</div>
@endsection
@section('js')
<script>
    var REGIONS = {!! $regions->toJson() !!};
    var HOSPITALS = {!! $hospitals->toJson() !!};
    console.log('REGIONS', REGIONS);
    console.log('HOSPITALS', HOSPITALS);
</script>
<script src="{{asset('/js/hotelList.js')}}"></script>
@endsection
