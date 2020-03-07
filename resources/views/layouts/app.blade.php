<!DOCTYPE html>
<html>
<head>
    <meta name="apple-touch-fullscreen" content="YES" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta http-equiv="Expires" content="-1" />
    <meta http-equiv="pragram" content="no-cache" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache" />
    <link rel="icon" href="/dragontrail.ico" type="image/x-icon">
    <!-- 在 head 标签中添加 meta 标签，并设置 viewport-fit=cover 值 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <!-- 开启 safe-area-inset-bottom 属性 -->
    <van-number-keyboard safe-area-inset-bottom />
    <title>@yield('title')中国加油，武汉加油</title>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="{{asset('/vendor/vant/index.css')}}">
    <link rel="stylesheet" href="{{asset('/css/app.css?v').time()}}">
    @section('css')
    @show
</head>
<body>
    <div id="app">
        <header id="header">
            <a href="/" class="logo __imgbox"><img src="{{asset('/imgs/logo.png')}}" alt=""></a>
            <button class="menu-btn __imgbox"></button>
            <div class="menu-cover" id="menuCover">
                <a href="/apply_list" class="menu__item">查看申请</a>
                <a href="/hotel_list" class="menu__item">查找房源</a>
                <a href="/login" class="menu__item">医护人员入口</a>
                <a href="/admin/auth/login" class="menu__item">酒店人员入口</a>
                <a href="/hotel_staff" class="menu__item">酒店使用说明</a>
                <a href="/help_seeker_staff" class="menu__item">医护使用说明</a>
                <a href="/it_staff" class="menu__item">关于本平台</a>
                <a href="/volunteer" class="menu__item">志愿者招募</a>
                <a href="/notice" class="menu__item">公告</a>
                <a href="/10_question_and_answer" class="menu__item">关于联盟的十个问答</a>
            </div>
        </header>
        @yield('content')
    </div>
    <script src="{{asset('/vendor/ppo.min.js')}}"></script>
    <script src="{{asset('/vendor/underscore-min.js')}}"></script>
    <script src="{{asset('/vendor/moment.min.js')}}"></script>
    <script src="{{asset('/vendor/jquery3.2.1.min.js')}}"></script>
    <!-- 引入 Vue 和 Vant 的 JS 文件 -->
    <script src="{{asset('/vendor/vant/vue.min.js')}}"></script>
    <script src="{{asset('/vendor/vant/vant.min.js')}}"></script>
    <!-- <script src="https://cdn.bootcss.com/vConsole/3.3.4/vconsole.min.js"></script>
    <script>var vConsole = new VConsole();</script> -->
    <script>
        $(function() {
            $('.menu-btn').click(function(){
                $(this).toggleClass('active');
                $('#menuCover').toggleClass('open');
            });
        });
        console.info("项目开源地址：https://github.com/pariswang/CharityHotel");
        console.info("欢迎更多研发人员加入！");
    </script>
    @section('js')
    @show
</body>
</html>