<!--
参数：
/apply_list?distinct={distinct_id}&hospital={hospital_id}&s={addr_str}&status={status_id}
-->
<!-- status:
1 => 已申请
5 => 已接单 -->

@extends('layouts.app')
@section('title', '酒店列表')
@section('content')
<div class="page" id="applylList">
    <div class="list-hd">
        <div class="pickers">
            <van-button type="default" icon="arrow-down" round block size="small" plain :text="area" @click="showAreas=true"></van-button>
            <!-- <van-button type="default" icon="arrow-down" round block size="small" plain :text="hospital" @click="showHospitals=true"></van-button> -->
            <van-button type="default" icon="arrow-down" round block size="small" plain :text="statu" @click="showStatus=true"></van-button>
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
        :style="{ height: '30%' }">
        <van-picker :columns="areas" @change="areaOnChange"/>
    </van-popup>
    <van-popup
        v-model="showHospitals"
        closeable
        round
        position="bottom"
        :style="{ height: '30%' }">
        <van-picker :columns="hospitals" @change="hospitalOnChange"/>
    </van-popup>
    <van-popup
        v-model="showStatus"
        closeable
        round
        position="bottom"
        :style="{ height: '30%' }">
        <van-picker :columns="status" @change="statuOnChange"/>
    </van-popup>
    <!--
    参数说明
    ?distinct={distinct_id}&hospital={hospital_id}&s={addr_str}
    -->
    @foreach ($applies as $apply)
    <div class="item">
        <div class="item-hd">
            <span>{{$apply->date_begin}}</span>
            <span class="item__value">已申请</span>
        </div>
        <div class="item-bd">
            武昌-光谷附近 ，同济医院光谷分院  3名 医护人员 急需酒店
        </div>
        <div class="item-ft">
            <van-button type="default" size="small" round plain url="#">已拒绝</van-button>
            <van-button type="primary" size="small" round plain url="#">查看详情</van-button>
            <van-button type="primary" size="small" round :url="'/apply_hotel'">接单</van-button>
        </div>
    </div>
    @endforeach
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
<script src="{{asset('/js/apply_list.js')}}"></script>
@endsection
