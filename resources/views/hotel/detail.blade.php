@extends('layouts.app')
@section('title', '酒店详情')
@section('content')
<div class="page page--start" id="index">
    <h1 class="page-title">酒店详情</h1>
    @csrf
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>酒店名称</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->hotel_name}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>酒店类型</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->classify}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>酒店三餐</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->meal}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>酒店地址</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->address}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>联系人</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->uname}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>联系电话</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->phone}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>可安排房间数</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->room_count}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>医护人员免费</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->medical_staff_free ? '免费' : '不免费'}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>愿意被征用</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->expropriation ? '愿意' : '不愿意'}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>前台接待</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->reception ? '有' : '没有'}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>客房清洁服务</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->cleaning ? '有' : '没有'}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>房间配置说明</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->collocation_description}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>酒店说明</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$hotel->description}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-button class="submit-btn" color="#1d63cb" round block url="/apply_hotel?id={{$hotel->id}}">申请</van-button>
</div>
@endsection
@section('js')
<script src="{{asset('/js/index.js')}}"></script>
@endsection