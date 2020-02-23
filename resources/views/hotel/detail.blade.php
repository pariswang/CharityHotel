@extends('layouts.app')
@section('title', '酒店详情')
@section('content')
<div class="page page--start" id="index">
    <h1 class="page-title">酒店详情</h1>
    @csrf
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="酒店名称"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="酒店简介"
            type="textarea"
            autosize
            rows="2"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="酒店类型"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="酒店三餐"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="酒店地址"
            type="textarea"
            autosize
            rows="2"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="联系人"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="联系电话"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="可安排房间数"/>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>医护人员免费</span></div>
            <div class="van-cell__value">
                <div class="van-field__body">
                    <van-switch v-model="free" disabled active-color="#07c160" size="24"/>
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>愿意被征用</span></div>
            <div class="van-cell__value">
                <div class="van-field__body">
                    <van-switch v-model="free" disabled active-color="#07c160" size="24"/>
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="优惠房价"/>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>有前台接待</span></div>
            <div class="van-cell__value">
                <div class="van-field__body">
                    <van-switch v-model="free" disabled active-color="#07c160" size="24"/>
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>提供客房清洁服务</span></div>
            <div class="van-cell__value">
                <div class="van-field__body">
                    <van-switch v-model="free" disabled active-color="#07c160" size="24"/>
                </div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="房间配置说明"
            type="textarea"
            autosize
            rows="2"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="hotle_name"
            disabled
            label="酒店说明"
            type="textarea"
            autosize
            rows="2"/>
    </van-cell-group>
    <van-button class="submit-btn" type="primary" round block :loading="submitLoading" loading-text="取消发布中..." @click="onCancel">取消发布</van-button>
</div>
@endsection
@section('js')
<script>
    var HOTLE_NAME = '';
</script>
<script src="{{asset('/js/hotle_detail.js')}}"></script>
@endsection