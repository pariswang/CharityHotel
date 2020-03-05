@extends('layouts.app')
@section('title', '个人中心')
@section('content')
<div class="page page--start" id="profile">
    <van-cell-group>
        <van-cell title="{{$user->uname}}" label="{{$user->phone}}" />
        {{--<van-icon name="edit" size="20"/>--}}
    </van-cell-group>
    @csrf
    <van-panel title="我的申请单" style="margin-top:1em;">
        <van-tabs @click="changeTab" color="#1e63cb">
            <van-tab title="已发布">
                @forelse($publishes as $apply)
                    <div class="item">
                        <a href="/apply_detail?id={{$apply->id}}">
                            <div class="item-hd">
                                <span>{{$apply->date_begin}}</span>
                                <span class="item__value" style="color:#999999">{{$apply->region ? $apply->region->region_name : ''}}</span>
                            </div>
                            <div class="item-bd">
                                @if ($apply->region_id)
                                    {{$apply->region->region_name}}{{$apply->hope_addr ?? ''}} ，
                                @elseif ($apply->hotel_id)
                                    {{$apply->hotel->region->region_name}}{{$apply->hotel->address}}附近，
                                @else
                                    &nbsp;
                                @endif
                                {{$apply->conn_company}} {{$apply->checkin_num}}名 {{$apply->conn_position}} 急需酒店。
                                联系人：{{$apply->conn_person}}
                            </div>
                        </a>
                            <div class="item-ft">
                                <van-button color="#1d63cb" style="margin-right: 10px;" size="small" round @click="cancelApply({{$apply->id}})">取消申请</van-button>  
                        <a href="/apply_detail?id={{$apply->id}}">
                                <van-button color="#1d63cb" size="small" round plain>查看详情</van-button></a>
                            </div>
                    </div>
                @empty
                    <div class="item-empty">
                        <p><van-icon name="bulb-o" size="60"/></p>
                        <p>暂无申请信息~</p>
                    </div>
                @endforelse
            </van-tab>
            <van-tab title="已接单">
                @forelse($acceptes as $apply)
                <div class="item">
                    <a href="/apply_detail?id={{$apply->id}}">
                        <div class="item-hd">
                            <span>{{$apply->date_begin}}</span>
                            <span class="item__value" style="color:#999999">{{$apply->region ? $apply->region->region_name : ''}}</span>
                        </div>
                        <div class="item-bd">
                            @if ($apply->region_id)
                                {{$apply->region->region_name}}{{$apply->hope_addr ?? ''}} ，
                            @elseif ($apply->hotel_id)
                                {{$apply->hotel->region->region_name}}{{$apply->hotel->address}}附近，
                            @else
                                &nbsp;
                            @endif
                            {{$apply->conn_company}} {{$apply->checkin_num}}名 {{$apply->conn_position}} 急需酒店。
                            联系人：{{$apply->conn_person}}
                        </div>
                        <div class="item-ft">
                            <van-button color="#1d63cb" size="small" round plain>查看详情</van-button>
                        </div>
                    </a>
                </div>
                @empty
                    <div class="item-empty">
                        <p><van-icon name="bulb-o" size="60"/></p>
                        <p>暂无申请信息~</p>
                    </div>
                @endforelse
            </van-tab>
        </van-tabs>
    </van-panel>
    <van-button class="submit-btn" plain type="default" round block url="/logout">退出</van-button>
    <van-tabbar v-model="tabbarActive" active-color="#1e63cb">
        <van-tabbar-item url="/hotel_list" icon="search">查找房源</van-tabbar-item>
        <van-tabbar-item url="/apply" icon="bullhorn-o">发布申请</van-tabbar-item>
        <van-tabbar-item url="/profile" icon="user-o">个人中心</van-tabbar-item>
    </van-tabbar>
</div>
@endsection
@section('js')
<script>
new Vue({
    el: '#app',
    data: {
        tabbarActive: 2,
    },
    methods: {
        changeTab: function (name, title) {
            console.log('title', title);
        }
        ,cancelApply: function (applyid) {
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
                            done();
                            window.location.href = '/profile';
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