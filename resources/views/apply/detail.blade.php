@extends('layouts.app')
@section('title', '申请详情')
@section('content')
<div class="page page--start">
    <h1 class="page-title">申请详情</h1>
    @csrf
    @if ($apply->hotel)
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>酒店名称</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->hotel->hotel_name}}</div>
            </div>
        </div>
    </van-cell-group>
    @endif
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
            <div class="van-cell__title van-field__label"><span>是否愿意付费</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->can_pay ? '是' : '否'}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>是否有公函</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->has_letter ? '有' : '没有'}}</div>
            </div>
        </div>
    </van-cell-group>
    @if ($apply->region)
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>区域</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->region ? $apply->region->region_name : ''}}</div>
            </div>
        </div>
    </van-cell-group>
    @endif
    @if ($apply->hope_addr)
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>期望地址</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->hope_addr}}</div>
            </div>
        </div>
    </van-cell-group>
    @endif
    @if ($apply->remark)
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>其他说明</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->remark}}</div>
            </div>
        </div>
    </van-cell-group>
    @endif

    @if (($apply->status == 1 && (isset($user) && $user->id != $apply->user_id)) || !isset($user))
        <van-button class="submit-btn" color="#1d63cb" round block url="/admin/taking/{{$apply->id}}">我来接单</van-button>
    @endif
    @if ($apply->status == 1 && (isset($user) && $user->id == $apply->user_id))
        <van-button class="submit-btn" color="#1d63cb" round block @click="cancelApply({{$apply->id}})">取消申请</van-button>
    @endif
</div>
@endsection
@section('js')
<script>
new Vue({
    el: '#app',
    methods: {
        cancelApply: function (applyid) {
            var _this = this;
            function beforeClose(action, done) {
                if (action === 'confirm') {
                    $.ajax({
                        type: 'POST',
                        url: '/apply/cancel',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            id: applyid,
                        },
                        success: function (res) {
                            console.log('res', res);
                            done();
                            window.location.href = '/profile';
                        },
                        error: function (res) {
                            var errors = res.responseJSON.errors;
                            console.log('errors', errors);
                            var errors_text = '';
                            for(var i in  errors) {
                                var item = errors[i];
                                item.forEach(function (_item) { 
                                    errors_text += _item;
                                });
                            }
                            vant.Notify({ type: 'danger', message: errors_text !== '' ? errors_text : '登录错误，请重试'});
                        },
                        complete: function () {
                            done();
                        }
                    });
                } else {
                    done();
                }
            }
            vant.Dialog.confirm({
                title: '提示',
                message: '你确定要取消这个申请单？',
                beforeClose
            });
        }
    }
});
</script>
@endsection