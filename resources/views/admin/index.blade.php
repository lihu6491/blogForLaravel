<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Blog For Admin</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/admin/css/index.css" media="all" />
</head>
<body class="main_body">
<div class="layui-layout layui-layout-admin">
    <!-- 顶部 -->
    <div class="layui-header header">
        <div class="layui-main mag0">
            <a href="/admins" class="logo" style="font-size: 18px;"><i class="layui-icon">&#xe653;</i> Blog For Admin</a>
            <!-- 显示/隐藏菜单 -->
            <a href="javascript:;" class="seraph hideMenu icon-caidan"></a>
            <!-- 顶级菜单 -->
            <ul class="layui-nav mobileTopLevelMenus" mobile>
                <li class="layui-nav-item" data-menu="contentManagement">
                    <a href="javascript:;"><i class="seraph icon-caidan"></i><cite>Blog For Admin</cite></a>
                    <dl class="layui-nav-child">
                        <dd class="layui-this" data-menu="contentManagement"><a href="javascript:;"><i class="layui-icon" data-icon="&#xe63c;">&#xe63c;</i><cite>Content Management</cite></a></dd>
                        <dd data-menu="gii"><a href="javascript:;"><i class="layui-icon">&#xe857;</i><cite>Gii For Laravel</cite></a></dd>
                        <dd data-menu="website"><a href="/"><i class="layui-icon">xe7ae</i> Blog For WebSite</a></dd>
                        <dd data-menu="systemeSttings"><a href="javascript:;"><i class="layui-icon" data-icon="&#xe620;">&#xe620;</i><cite>Settings</cite></a></dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav topLevelMenus" pc>
                <li class="layui-nav-item layui-this" data-menu="contentManagement">
                    <a href="javascript:;"><i class="layui-icon" data-icon="&#xe63c;">&#xe63c;</i><cite>Content Management</cite></a>
                </li>
                <li class="layui-nav-item" data-menu="gii" pc>
                    <a href="javascript:;"><i class="layui-icon">&#xe857;</i><cite>Gii For Laravel</cite></a>
                </li>
                <li class="layui-nav-item" data-menu="website" pc>
                    <a href="/"><i class="layui-icon">&#xe7ae;</i> Blog For WebSite</a>
                </li>
                <li class="layui-nav-item" data-menu="systemeSttings" pc>
                    <a href="javascript:;"><i class="layui-icon" data-icon="&#xe620;">&#xe620;</i><cite>Settings</cite></a>
                </li>

            </ul>
            <!-- 顶部右侧菜单 -->
            <ul class="layui-nav top_menu">
                <li class="layui-nav-item" pc>
                    <a href="javascript:;" class="clearCache"><i class="layui-icon" data-icon="&#xe640;">&#xe640;</i><cite>清除缓存</cite><span class="layui-badge-dot"></span></a>
                </li>
                <li class="layui-nav-item lockcms" pc>
                    <a href="javascript:;"><i class="seraph icon-lock"></i><cite>锁屏</cite></a>
                </li>
                <li class="layui-nav-item" id="userInfo">
                    <a href="javascript:;"><img src="/image/header.jpg" class="layui-nav-img userAvatar" width="35" height="35"><cite class="adminName">@php echo session('user_name');@endphp</cite></a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="page/user/userInfo.html"><i class="seraph icon-ziliao" data-icon="icon-ziliao"></i><cite>个人资料</cite></a></dd>
                        <dd><a href="javascript:;" data-url="page/user/changePwd.html"><i class="seraph icon-xiugai" data-icon="icon-xiugai"></i><cite>修改密码</cite></a></dd>
                        <dd><a href="javascript:;" class="showNotice"><i class="layui-icon">&#xe645;</i><cite>系统公告</cite><span class="layui-badge-dot"></span></a></dd>
                        <dd pc><a href="javascript:;" class="functionSetting"><i class="layui-icon">&#xe620;</i><cite>功能设定</cite><span class="layui-badge-dot"></span></a></dd>
                        <dd pc><a href="javascript:;" class="changeSkin"><i class="layui-icon">&#xe61b;</i><cite>更换皮肤</cite></a></dd>
                        <dd><a href="/admins/loginout" class="signOut"><i class="seraph icon-tuichu"></i><cite>退出</cite></a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <!-- 左侧导航 -->
    <div class="layui-side layui-bg-black">
        <div class="user-photo">
            <a class="img" title="我的头像" ><img src="/image/header.jpg" class="userAvatar"></a>
            <p>你好！<span class="userName">@php echo session('user_name');@endphp</span> 欢迎登录</p>
        </div>
        <!-- 搜索 -->
        <div class="layui-form component">
            <select name="search" id="search" lay-search lay-filter="searchPage">
                <option value="">搜索页面或功能</option>
                <option value="1">layer</option>
                <option value="2">form</option>
            </select>
            <i class="layui-icon">&#xe615;</i>
        </div>
        <div class="navBar layui-side-scroll" id="navBar">
            <ul class="layui-nav layui-nav-tree">
                <li class="layui-nav-item layui-this">
                    <a href="javascript:;" data-url="page/main.html"><i class="layui-icon" data-icon=""></i><cite>后台首页</cite></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- 右侧内容 -->
    <div class="layui-body layui-form">
        <div class="layui-tab mag0" lay-filter="bodyTab" id="top_tabs_box">
            <ul class="layui-tab-title top_tab" id="top_tabs">
                <li class="layui-this" lay-id=""><i class="layui-icon">&#xe68e;</i> <cite>后台首页</cite></li>
            </ul>
            <ul class="layui-nav closeBox">
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon caozuo">&#xe643;</i> 页面操作</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" class="refresh refreshThis"><i class="layui-icon">&#x1002;</i> 刷新当前</a></dd>
                        <dd><a href="javascript:;" class="closePageOther"><i class="seraph icon-prohibit"></i> 关闭其他</a></dd>
                        <dd><a href="javascript:;" class="closePageAll"><i class="seraph icon-guanbi"></i> 关闭全部</a></dd>
                    </dl>
                </li>
            </ul>
            <div class="layui-tab-content clildFrame">
                <div class="layui-tab-item layui-show">
                    <iframe src="/admins/main"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <div class="layui-footer footer">
        <span>Copyright&copy;@php echo date('Y',time())@endphp  skyrimblog.com  备案号：京ICP备18012066号-1 </span>
    </div>
</div>

<!-- 移动导航 -->
<div class="site-tree-mobile"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>

<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/admin/js/index.js"></script>
<script type="text/javascript" src="/admin/js/cache.js"></script>
</body>
</html>