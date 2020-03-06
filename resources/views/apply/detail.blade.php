@extends('layouts.app')
@section('title', '申请详情')
@section('content')
<div class="page page--start">
    <h1 class="page-title">申请详情</h1>
    @csrf
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
                <div class="van-field__body --text-left">{{$apply->conn_phone_show}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>备用电话</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->spare_phone_show}}</div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>职位</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left">{{$apply->conn_position}}</div>
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
    @if ($apply->region)
        <van-cell-group>
            <div class="van-cell van-field">
                <div class="van-cell__title van-field__label"><span>所在地区</span></div>
                <div class="van-cell__value">
                    <div class="van-field__body --text-left">{{$apply->region ? $apply->region->region_name : ''}}</div>
                </div>
            </div>
        </van-cell-group>
    @endif
    @if ($apply->hope_addr)
        <van-cell-group>
            <div class="van-cell van-field">
                <div class="van-cell__title van-field__label"><span>期望住址</span></div>
                <div class="van-cell__value">
                    <div class="van-field__body --text-left">{{$apply->hope_addr}}</div>
                </div>
            </div>
        </van-cell-group>
    @endif
    @if ($apply->hotel)
        <van-cell-group>
            <div class="van-cell van-field">
                <div class="van-cell__title van-field__label"><span>期望入住酒店</span></div>
                <div class="van-cell__value">
                    <div class="van-field__body --text-left">{{$apply->hotel->hotel_name}}</div>
                </div>
            </div>
        </van-cell-group>
    @endif
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
    <!--
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>入住/离店时间</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left"><span class="__cell__value">{{$apply->date_begin}}-{{$apply->date_end}}</span></div>
            </div>
        </div>
    </van-cell-group>
    -->
    <van-cell-group>
        <div class="van-cell van-field">
            <div class="van-cell__title van-field__label"><span>入住时间</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --text-left"><span>{{$apply->date_begin}}</span></div>
            </div>
        </div>
    </van-cell-group>
    <van-cell-group>
        <div class="van-cell van-field" @click="showDateEndPicker = true">
            <div class="van-cell__title van-field__label"><span>离店时间</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --space-between">
                    <span v-text="date_end !== '' ? date_end : '请选择离店时间'"></span>
                    <van-icon name="arrow-down"/>
                </div>
            </div>
        </div>
        <van-calendar title="请选择离店时间" v-model="showDateEndPicker" :min-date="date_end_min" :default-date="date_end_default" color="#1e63cb" @confirm="dateEndOnConfirm" />
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

    @if ($apply->status == 1)
        @if (isset($user) && $user->id == $apply->user_id)
            <van-button class="submit-btn" color="#1d63cb" round block :loading="submitLoading" loading-text="修改中..." @click="submit">修改离店时间</van-button>
            <van-button class="submit-btn" color="#1d63cb" round block @click="cancelApply({{$apply->id}})">取消申请</van-button>
        @else
            <van-button class="submit-btn" color="#1d63cb" round block url="/admin/taking/{{$apply->id}}">我来接单</van-button>
        @endif
    @endif
</div>
@endsection
@section('js')
<script>
new Vue({
    el: '#app',
    data:{
        applyid: '{!! $apply->id !!}',
        old_date_end: '{!! $apply->date_end !!}',
        date_end_min: new Date(moment('{!! $apply->date_begin !!}').add(1, 'days').format('YYYY/MM/DD')),
        date_end_default: new Date(moment('{!! $apply->date_begin !!}').add(1, 'days').format('YYYY/MM/DD')),
        date_end: '{!! $apply->date_end !!}',
        showDateEndPicker: false,
        submitLoading: false,
    },
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
        },
        dateEndOnConfirm: function (date) {
            this.date_end = moment(date).format('YYYY/MM/DD');
            this.showDateEndPicker = false;
        },
        submit: function () {
            if (this.old_date_end == this.date_end){
                vant.Toast('离店时间未变更');
                return false;
            }
            if (this.date_end == ''){
                vant.Toast('离店时间不可为空');
                return false;
            }

            $.ajax({
                type: 'POST',
                url: '/apply/edit_end_date',
                data: {
                    _token: $('input[name="_token"]').val(),
                    date_end: this.date_end,
                    id: this.applyid,
                },
                beforeSend: function () {
                    this.submitLoading = true;
                },
                success: function (res) {
                    vant.Notify({ type: 'success', message: '修改离店时间成功' });
                    setTimeout( function() {
                        window.location.reload();
                    }, 1000);
                },
                error: function (res) {
                    var errors = res.responseJSON.errors;
                    var errors_text = '';
                    for(var i in  errors) {
                        var item = errors[i];
                        item.forEach(function (_item) { 
                            errors_text += _item;
                        });
                    }
                    vant.Notify({ type: 'danger', message: errors_text !== '' ? errors_text : '发布错误，请重试'});
                },
                complete: function () {
                    this.submitLoading = false;
                }
            });
        }
    }
});
</script>
@endsection