@extends('layouts.app')
@section('title', '酒店列表')
@section('content')
<div class="page page-tabbar" id="hotelList">
    <div class="list-hd">
        <div class="pickers">
            <van-button type="default" icon="arrow-down" round block size="small" plain :text="area !== '' ? area : '请选择区域'" @click="showAreas=true"></van-button>
            <van-button type="default" icon="arrow-down" round block size="small" plain :text="hospital !== '' ? hospital : '请选择医院'" @click="showHospitals=true"></van-button>
            <!-- <van-button type="default" icon="arrow-down" round block size="small" plain :text="statu !== '' ? statu : '请选择状态'" @click="showStatus=true"></van-button> -->
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
        <van-picker :columns="hospitals" :default-index="hospitalIndex || 0" @change="hospitalOnChange"/>
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
    @forelse ($hotels as $hotel)
        <div class="item">
            <a href="/hotel_detail?id={{$hotel->id}}" class="block__link">
                <div class="item-hd">
                    <span>{{$hotel->region->region_name}}</span>
                    <span class="item__value">{{$hotel->classify}}</span>
                </div>
                <div class="item-bd">
                    {{$hotel->hotel_name}}可安排{{$hotel->room_count-$hotel->use_room_count}}间
                    {{$hotel->medical_price !== null?($hotel->medical_price?('，医护爱心价'.$hotel->medical_price.'元'):'，医护人员免费'):''}}
                    {{$hotel->discount_price !== null?('，非医护'.$hotel->discount_price.'元'):''}}
                    @if ($hotel->receive_patient)
                        ，可提供隔离房。
                    @else
                        。
                    @endif
                </div>
            </a>
            <div class="item-ft">
                {{--<van-button type="default" size="small" round plain url="#"></van-button>--}}
                <van-button color="#1d63cb" size="small" round plain url="/hotel_detail?id={{$hotel->id}}">查看详情</van-button>
                <van-button color="#1d63cb" size="small" round url="/apply_hotel?id={{$hotel->id}}">我要申请</van-button>
            </div>
        </div>
    @empty
        <div class="item-empty">
            <p><van-icon name="bulb-o" size="60"/></p>
            <p>没有查询出符合条件的酒店信息, 换个条件试试~</p>
        </div>
    @endforelse
    <!-- <div class="ft-cover">
        <van-button color="#1d63cb" block round url="/apply">发布住宿申请</van-button>
    </div> -->
    <van-tabbar v-model="tabbarActive" active-color="#1e63cb">
        <van-tabbar-item url="/hotel_list" icon="search">查找房源</van-tabbar-item>
        <van-tabbar-item url="/apply" icon="bullhorn-o">发布申请</van-tabbar-item>
        <van-tabbar-item url="/profile" icon="user-o">个人中心</van-tabbar-item>
    </van-tabbar>
</div>
@endsection
@section('js')
<script>
    var REGIONS = {!! $regions->toJson() !!};
    var HOSPITALS = {!! $hospitals->toJson() !!};
    console.log('REGIONS', REGIONS);
    console.log('HOSPITALS', HOSPITALS);
</script>
<script src="{{asset('/js/hotelList.js').'?'.time()}}"></script>
@endsection
