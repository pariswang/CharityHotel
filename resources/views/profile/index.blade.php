@extends('layouts.app')
@section('title', '个人中心')
@section('content')
<div class="page page--start" id="profile">
    <van-cell-group>
        <van-cell title="用户名" label="13222222222" />
        <van-icon name="edit" size="20"/>
    </van-cell-group>
    <van-panel title="我的申请单" style="margin-top:1em;">
        <van-tabs @click="changeTab" color="#07c160">
            <van-tab title="已发布">
                @forelse($publishes as $apply)
                    <div class="item">
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
    <van-tabbar v-model="active" active-color="#07c160">
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
        active: 2,
    },
    methods: {
        changeTab: function (name, title) {
            console.log('title', title);
        }
    }
});
</script>
@endsection