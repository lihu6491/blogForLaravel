<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>网址导航</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/admin/css/public.css" media="all" />
</head>
<body class="childrenBody">
<blockquote class="layui-elem-quote quoteBox">
    <form class="layui-form">
        <div class="layui-inline">
            <div class="layui-input-inline">
                <input type="text" class="layui-input searchVal" placeholder="请输入搜索的内容" />
            </div>
            <a class="layui-btn search_btn" data-type="reload">搜索</a>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal addNav_btn">添加导航</a>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-danger layui-btn-normal delAll_btn">批量删除</a>
        </div>
    </form>
</blockquote>
<table id="navList" lay-filter="navList"></table>

<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/admin/js/webnav/index.js"></script>
</body>
</html>