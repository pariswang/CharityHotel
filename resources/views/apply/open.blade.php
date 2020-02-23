@extends('layouts.app')
@section('title', '申请住宿')
@section('content')
<div class="page page--start" id="index">
    <h1 class="page-title">申请住宿</h1>
    @csrf
    <van-cell-group>
        <van-field
            v-model="conn_person"
            required
            type="tel"
            maxlength="11"
            label="联系人"
            placeholder="请输入联系人"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="conn_phone"
            required
            type="tel"
            maxlength="11"
            label="联系电话"
            placeholder="请输入联系电话"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="conn_position"
            required
            label="职位"
            placeholder="请输入职位"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="conn_company"
            required
            label="工作单位"
            placeholder="请输入工作单位"/>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-cell--required van-field">
            <div class="van-cell__title van-field__label"><span>入住人数</span></div>
            <div class="van-cell__value">
                <div class="van-field__body">
                    <van-stepper v-model="checkin_num" />
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-cell--required van-field">
            <div class="van-cell__title van-field__label"><span>所需房间数</span></div>
            <div class="van-cell__value">
                <div class="van-field__body">
                    <van-stepper v-model="room_count" />
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-cell--required van-field" @click="showDatePicker = true">
            <div class="van-cell__title van-field__label"><span>入住/离店时间</span></div>
            <div class="van-cell__value">
                <div class="van-field__body"><span class="__cell__value" v-text="date_begin+'-'+date_end"></span></div>
            </div>
        </div>
        <van-calendar title="请选择入住/离店时间" v-model="showDatePicker" color="#07c160" type="range" @confirm="datePickerOnConfirm" />
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-cell--required van-field">
            <div class="van-cell__title van-field__label"><span>原意付费</span></div>
            <div class="van-cell__value">
                <div class="van-field__body">
                    <van-switch v-model="can_pay" active-color="#07c160" size="24"/>
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-cell--required van-field">
            <div class="van-cell__title van-field__label"><span>有公函</span></div>
            <div class="van-cell__value">
                <div class="van-field__body">
                    <van-switch v-model="has_letter" active-color="#07c160" size="24"/>
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-cell--required van-field" @click="showAreas=true">
            <div class="van-cell__title van-field__label"><span>选择区域</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --space-between">
                    <span v-text="area"></span>
                    <van-icon name="arrow-down"/>
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hope_addr"
            required
            label="期望地址"
            placeholder="请输入期望地址"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="remark"
            required
            label="其他说明"
            type="textarea"
            autosize
            rows="2"
            placeholder="请输入备注文字"/>
    </van-cell-group>
    <van-button class="submit-btn" type="primary" round block :loading="submitLoading" loading-text="申请中..." @click="onSubmit">申请</van-button>
</div>
@endsection
@section('js')
<script>
    var CONN_PERSON = '{!! $user->uname !!}',
        CONN_PHONE = '{!! $user->phone !!}',
        CONN_POSITION = '{!! $user->position !!}',
        CONN_COMPANY = '{!! $user->company !!}';
        REGIONS = {!! $regions->toJson() !!};
    console.log('REGIONS', REGIONS);
    console.log('CONN_PERSON', CONN_PERSON);
    console.log('CONN_PHONE', CONN_PHONE);
    console.log('CONN_POSITION', CONN_POSITION);
    console.log('CONN_COMPANY', CONN_COMPANY);
</script>
<script src="{{asset('/js/apply_open.js')}}"></script>
@endsection
