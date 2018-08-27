<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>编辑导航</title>
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
<form class="layui-form linksAdd">
    <div class="layui-form-item">
        <label class="layui-form-label">导航分类</label>
        <div class="layui-input-block">

            <select name="class_id" lay-verify="required" lay-search="">
                <option value="1" @if ($WebNavInfo['class_id'] == 1) selected @endif>官方网站</option>
                <option value="2" @if ($WebNavInfo['class_id'] == 2) selected @endif>在线工具</option>
                <option value="3" @if ($WebNavInfo['class_id'] == 3) selected @endif>视频学习</option>
                <option value="4" @if ($WebNavInfo['class_id'] == 4) selected @endif>开发文档</option>
                <option value="5" @if ($WebNavInfo['class_id'] == 5) selected @endif>静态资源库</option>
                <option value="6" @if ($WebNavInfo['class_id'] == 6) selected @endif>综合</option>
            </select>

        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">导航名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" id="name" class="layui-input masterEmail" lay-verify="required" placeholder="请输入导航名称" value="{{$WebNavInfo['name']}}" />
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">导航地址</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" name="urls" id="urls" lay-verify="required|url" placeholder="请输入导航地址" value="{{$WebNavInfo['urls']}}" />
        </div>
    </div>
    <div class="layui-form-item">
        <button class="layui-btn layui-block" lay-filter="editNav" lay-submit>提交</button>
        <input type="hidden" name="id" id="id" value="{{$WebNavInfo['id']}}" />
    </div>
</form>
<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/admin/js/webnav/index.js"></script>
</body>
</html>