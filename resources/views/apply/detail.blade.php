@extends('layouts.app')
@section('title', '申请详情')
@section('content')
<div class="page page--start" id="index">
    <h1 class="page-title">申请详情</h1>
    @csrf
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>酒店名称</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">酒店名称</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>联系人</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->conn_person}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>联系人电话</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->conn_phone}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>职位</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->conn_company}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>工作单位</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->conn_company}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>入住人数</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->checkin_num}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>所需房间数</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->room_count}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>入住/离店时间</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left"><span class="__cell__value">{{$apply->date_begin}}-{{$apply->date_end}}</span></div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>是否原意付费</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->can_pay}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>是否有公函</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->has_letter}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>选择区域</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">选择区域</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>期望地址</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">期望地址</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>其他说明</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">其他说明其他说明其他说明其他说明其他说明其他说明其他说明其他说明其他说明其他说明其他说明其他说明其他说明其他说明</div>
            </div>
        </div>
    </van-cell-group>
    <van-button class="submit-btn" type="primary" round block url="/admin/subscribe/taking/{{$apply->id}}">我来接单</van-button>
</div>
@endsection
@section('js')
<script src="{{asset('/js/index.js')}}"></script>
@endsection