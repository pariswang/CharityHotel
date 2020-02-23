@extends('layouts.app')
@section('title', '申请详情')
@section('content')
<div class="page page--start" id="index">
    <h1 class="page-title">申请详情</h1>
    @csrf
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="酒店名称"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="conn_person"
            disabled
            label="联系电话"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="conn_phone"
            disabled
            label="联系电话"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="conn_position"
            disabled
            label="职位"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="conn_company"
            disabled
            label="工作单位"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="checkin_num"
            disabled
            label="入住人数"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="room_count"
            disabled
            label="所需房间数"/>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>入住/离店时间</span></div>
            <div class="van-cell__value">
                <div class="van-field__body"><span class="__cell__value" v-text="date_begin+'-'+date_end"></span></div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>原意付费</span></div>
            <div class="van-cell__value">
                <div class="van-field__body">
                    <van-switch v-model="can_pay" disabled active-color="#07c160" size="24"/>
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>有公函</span></div>
            <div class="van-cell__value">
                <div class="van-field__body">
                    <van-switch v-model="has_letter" disabled active-color="#07c160" size="24"/>
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="room_count"
            disabled
            label="选择区域"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hope_addr"
            disabled
            label="期望地址"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="remark"
            disabled
            label="其他说明"
            type="textarea"
            autosize
            rows="2"/>
    </van-cell-group>
    <van-button class="submit-btn" type="primary" round block :loading="submitLoading" loading-text="取消发布中..." @click="onCancel">取消发布</van-button>
</div>
@endsection
@section('js')
<script>
    var HOTLE_NAME = '', // 酒店名称
        CONN_PERSON = '{!! $apply->conn_person !!}',
        CONN_PHONE = '{!! $apply->conn_phone !!}',
        CONN_POSITION = '{!! $apply->conn_position !!}',
        CONN_COMPANY = '{!! $apply->conn_company !!}',
        CHECKIN_NUM = '{!! $apply->checkin_num !!}',
        ROOM_COUNT = '{!! $apply->room_count !!}',
        DATE_BEGIN = '{!! $apply->date_begin !!}',
        DATE_END = '{!! $apply->date_end !!}',
        CAN_PAY = '{!! $apply->can_pay !!}',
        HAS_LETTER = '{!! isset($apply->has_letter) ? $apply->has_letter : false !!}',
        REGION_NAME = '', // 区域名称
        HOPE_ADDR = '{!! isset($apply->hope_addr) ? $apply->hope_addr : '' !!}',
        REMARK = '{!! isset($apply->remark) ? $apply->remark : '' !!}';
</script>
<script src="{{asset('/js/apply_detail.js')}}"></script>
@endsection