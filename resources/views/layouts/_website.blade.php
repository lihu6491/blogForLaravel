<!--
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

-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>加菲的梦-@yield('title')</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/website/css/index.css" media="all" />
    <script type="text/javascript" src="/website/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/layui/layui.js"></script>
</head>
<body>

<div class="blog-header layui-bg-black">
    <div class="layui-container">
        <a class="blog-logo" href="/"> <img src="/image/logo.png" style="width: 135px;height: 37px;" alt="layui" /> </a>
        <ul class="layui-nav blog-nav layui-hide-xs">
            <li class="layui-nav-item " id='home'> <a href="/"><i class="layui-icon iconfont ">&#xe68e;</i>首页</a> </li>
            <li class="layui-nav-item " id='post'> <a href="/post"><i class="layui-icon iconfont ">&#xe609;</i>文章专栏</a> </li>
            <li class="layui-nav-item " id='share'> <a href="/share"><i class="layui-icon iconfont ">&#xe641;</i>资源分享</a> </li>
            <li class="layui-nav-item " id='webnav'> <a href="/webnav"><i class="layui-icon iconfont ">&#xe609;</i>网址导航</a> </li>
            <li class="layui-nav-item " id='about'> <a href="/about"><i class="layui-icon iconfont ">&#xe60b;</i>关于</a> </li>
            <span class="layui-nav-bar" style="left: 0px; top: 55px; width: 0px; opacity: 0;"></span>
        </ul>
        <ul class="layui-nav blog-nav-user">
        </ul>
    </div>
</div>

@yield('content')

<div class="layui-footer layui-bg-black  footer">
    <span>Copyright&copy;@php echo date('Y',time())@endphp  skyrimblog.com  备案号：京ICP备18012066号-1 </span>
</div>



</body>
</html>