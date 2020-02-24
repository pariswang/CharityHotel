@extends('layouts.app')
@section('title', '申请{{$hotel->hotel_name}}的住宿')
@section('content')
<div class="page page--start page-tabbar">
    <h1 class="page-title">申请{{$hotel->hotel_name}}的住宿</h1>
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
        <div class="van-cell van-cell--required van-field" @click="showDateBeginPicker = true">
            <div class="van-cell__title van-field__label"><span>入住时间</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --space-between">
                    <span v-text="date_begin"></span>
                    <van-icon name="arrow-down" size="18"/>
                </div>
            </div>
        </div>
        <van-calendar title="请选择入住时间" v-model="showDateBeginPicker" color="#07c160" @confirm="dateBeginOnConfirm" />
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field" @click="showDateEndPicker = true">
            <div class="van-cell__title van-field__label"><span>离店时间</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --space-between">
                    <span v-text="date_end !== '' ? date_end : '请选择离店时间'"></span>
                    <van-icon name="arrow-down" size="18"/>
                </div>
            </div>
        </div>
        <van-calendar title="请选择离店时间" v-model="showDateEndPicker" :min-date="date_end_min" :default-date="date_end_default" color="#07c160" @confirm="dateEndOnConfirm" />
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-cell--required van-field">
            <div class="van-cell__title van-field__label"><span>愿意付费</span></div>
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
        <div class="van-cell van-cell--required van-field">
            <div class="van-cell__title van-field__label"><span>我的医院</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --column">
                    <div class="value___item" v-for="hospital in hospitals" key="hospital.id" >
                        <span v-text="hospital.hospital_name"></span>
                        <van-icon name="delete" color="#ee0a24" size="18" @click="deleteHospital(hospital.id)"/>
                        <!-- <van-button icon="delete" plain type="danger" size="mini"/> -->
                    </div>
                    <div class="value___item" @click="hospitalPicker = true">
                        <span>请增加医院</span>
                        <van-icon name="plus" size="18"/>
                    </div>
                </div>
            </div>
        </div>
        <van-popup v-model="hospitalPicker" position="bottom">
            <van-picker
                show-toolbar
                title="增加医院"
                :columns="hospitals_columns"
                @change="hospitalonChange"
                @cancel="hospitalPicker = false"
                @confirm="hospitalOnConfirm"
            />
        </van-popup>
    </van-cell-group>
    <van-button class="submit-btn" type="primary" round block :loading="submitLoading" loading-text="申请中..." @click="onSubmit">申请</van-button>
    <van-tabbar v-model="tabbarActive" active-color="#07c160">
        <van-tabbar-item url="/hotel_list" icon="search">查找房源</van-tabbar-item>
        <van-tabbar-item url="/apply" icon="bullhorn-o">发布申请</van-tabbar-item>
        <van-tabbar-item url="/profile" icon="user-o">个人中心</van-tabbar-item>
    </van-tabbar>
</div>
@endsection
@section('js')
<script>
    var REGIONS = {!! $regions->toJson() !!};
    console.log('REGIONS', REGIONS);
    var CONN_PERSON = '{!! $user->uname !!}',
        CONN_PHONE = '{!! $user->phone !!}',
        CONN_POSITION = '{!! $user->position !!}',
        CONN_COMPANY = '{!! $user->company !!}';
    console.log('CONN_PERSON', CONN_PERSON);
    console.log('CONN_PHONE', CONN_PHONE);
    console.log('CONN_POSITION', CONN_POSITION);
    console.log('CONN_COMPANY', CONN_COMPANY);
</script>
<script src="{{asset('/js/apply_mixin.js')}}"></script>
<script src="{{asset('/js/apply_hotel.js')}}"></script>
@endsection
