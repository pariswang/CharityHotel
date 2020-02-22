<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="email=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="screen-orientation" content="portrait">
    <meta name="full-screen" content="yes">
    <meta name="browsermode" content="application">
    <meta name="x5-orientation" content="portrait">
    <meta name="x5-fullscreen" content="true">
    <meta name="x5-page-mode" content="app">
    <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <title>登录页——中国加油，武汉加油</title>
    <link rel="stylesheet" href="/css/basic.css">
    <link rel="stylesheet" href="/css/login.css">
    <script>
        function resize() {
            if (document.documentElement.clientWidth > 750) {
                // document.documentElement.removeAttribute("style");
                document.documentElement.style.fontSize = "50px";
                return;
            }
            document.documentElement.style.fontSize = document.documentElement.clientWidth / 7.5 + "px";
        }
        resize();
        window.onresize = resize;
    </script>
</head>
<body>
<nav class="nav">
    中国加油，武汉加油
</nav>
@if ($errors->any())
    <div class="alert alert-danger" style="font-size: 16px;text-align: center;color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="wrap">
    <h3 class="formTitle">中国加油，武汉加油</h3>
    <form id="loginForm" class="loginForm" method="post" action="">
        <div class="formGroup">
            <input class="formInput" type="text" placeholder="手机号" name="phone">
            <p class="formTip">请输入手机号</p>
        </div>
        <div class="formGroup">
            <input class="formInput" type="password" placeholder="密码" name="password">
            <p class="formTip">请输入密码</p>
            @csrf
        </div>
        <button class="loginBtn" type="submit">登录</button>
    </form>
    <a class="loginBtn" href="/register" style="margin-top:20px;">注册</a>
</div>
</body>
</html>