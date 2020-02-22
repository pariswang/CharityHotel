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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>@yield('title')中国加油，武汉加油</title>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="{{asset('/vendor/vant/index.css')}}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
</head>
<body>
    <div id="app">
        <header id="header">中国加油，武汉加油</header>
        <div class="container">
            @yield('content')
        </div>
        <footer id="footer">技术支持 <a href="https://dragontrail.cn/">龙途互动</a></footer>
    </div>
    <script src="{{asset('/vendor/jquery3.2.1.min.js')}}"></script>
    <!-- 引入 Vue 和 Vant 的 JS 文件 -->
    <script src="{{asset('/vendor/vant/vue.min.js')}}"></script>
    <script src="{{asset('/vendor/vant/vant.min.js')}}"></script>
    @section('js')
    @show
</body>
</html>