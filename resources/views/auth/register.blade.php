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
    <title>注册页——中国加油，武汉加油</title>
    <link rel="stylesheet" href="/css/basic.css">
    <link rel="stylesheet" href="/css/register.css">
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
<div class="wrap">
    <div class="register">
        <h3 class="statement">本系统为不涉及捐赠等事情，如果发现有人涉嫌利用虚假信息进行诈骗等活动，请及时举报。</h3>
        @if ($errors->any())
            <div class="alert alert-danger" style="font-size: 16px;text-align: center;color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="registerForm" class="registerForm" method="post" action="">
            @csrf
            <div class="formGroup">
                <input id="mobileInput" class="formInput" type="text" placeholder="手机号" name="phone">
                <p class="formTip">请输入手机号</p>
            </div>
            <div class="formGroup">
                <input id="passwordInput" class="formInput" type="password" placeholder="密码" name="password">
                <p class="formTip">请输入密码</p>
            </div>
            <div class="formGroup">
                <input id="repasswordInput" class="formInput" type="password" placeholder="确认密码" name="password_confirmation">
                <p class="formTip">请再次输入密码</p>
            </div>
            <div class="formGroup">
                <input id="userInput" class="formInput" type="text" placeholder="姓名" name="uname">
                <p class="formTip">请输入姓名</p>
            </div>
            <div class="formGroup">
                <input id="companyInput" class="formInput" type="text" placeholder="单位" name="company">
                <p class="formTip">请输入单位</p>
            </div>
            <div class="formGroup">
                <input id="jobtitleInput" class="formInput" type="text" placeholder="岗位" name="position">
                <p class="formTip">请输入岗位</p>
            </div>
            <button id="registerBtn" class="registerBtn" type="submit">注册</button>
        </form>
    </div>
    <p class="registerTip">请如实录入您真实信息，不要透漏个人隐私</p>
</div>
</body>
</html>