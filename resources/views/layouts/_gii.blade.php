
<!--------------------------------------------
──────────────────────────────────────────────
─██████████████─██████──██████─██████████████─
─██░░░░░░░░░░██─██░░██──██░░██─██░░░░░░░░░░██─
─██░░██████░░██─██░░██──██░░██─██░░██████░░██─
─██░░██──██░░██─██░░██──██░░██─██░░██──██░░██─
─██░░██████░░██─██░░██████░░██─██░░██████░░██─
─██░░░░░░░░░░██─██░░░░░░░░░░██─██░░░░░░░░░░██─
─██░░██████████─██░░██████░░██─██░░██████████─
─██░░██─────────██░░██──██░░██─██░░██─────────
─██░░██─────────██░░██──██░░██─██░░██─────────
─██░░██─────────██░░██──██░░██─██░░██─────────
─██████─────────██████──██████─██████─────────
──────────────────────────────────────────────

        嫁人要嫁程序员,呆萌单纯可爱多!

---------------------------------------------->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gii For Laravel</title>
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{ URL::asset('layui/css/layui.css') }}" media="all" />
    <script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
</head>

<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo"><a href="/gii" style="color: #009688"><i class="layui-icon">&#xe857;</i> Gii For Laravel</a></div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="/gii"><i class="layui-icon">&#xe663;</i> Code Generator</a></li>
            <li class="layui-nav-item"><a href="/admins"><i class="layui-icon">&#xe653;</i> Blog For Admin</a></li>
            <li class="layui-nav-item"><a href="/"><i class="layui-icon">&#xe7ae;</i> Blog For WebSite</a></li>
            <li class="layui-nav-item"><a href="/"><i class="layui-icon">&#xe656;</i> DB Manage</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="layui-icon">&#xe674;</i> Ddefault </a></a>
                <dl class="layui-nav-child">
                    <dd><a href=""><i class="layui-icon">&#xe667;</i> 消息管理</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="/image/header.jpg" class="layui-nav-img">
                    Coder
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">菜单1</a></dd>
                    <dd><a href="">菜单2</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="">注销</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="nav" id="layui_nav">
                <li class="layui-nav-item" id="home" >
                    <a class="" href="/gii"><i class="layui-icon">&#xe68e;</i> Home</a>
                </li>
                <li class="layui-nav-item" id = "model" >
                    <a class="" href="/gii/model"><i class="layui-icon">&#xe609;</i> Model Generator</a>
                </li>
                <li class="layui-nav-item " id="service">
                    <a href="/gii/service"><i class="layui-icon">&#xe62e;</i> Service Generator</a>
                </li>
                <li class="layui-nav-item" id="controller">
                    <a href="/gii/controller"><i class="layui-icon">&#xe633;</i> Controller Generator</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="padding: 15px;">
            @yield('content')
        </div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        <center>Copyright&copy;@php echo date('Y',time())@endphp  skyrimblog.com All Rights Reserved. 备案号：京ICP备18012066号-1</center>
    </div>
</div>

<script>
    //JavaScript代码区域
    layui.use('element', function(){
        var element = layui.element,
        $ = layui.jquery

        var nav_flag = $("#nav_flag").val();
        $("#layui_nav").find("li").removeClass('layui-this');
        $("#"+nav_flag).addClass('layui-this');

    });
</script>
</body>
</html>