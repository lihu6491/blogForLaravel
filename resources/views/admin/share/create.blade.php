<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加分享资源</title>
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/admin/css/public.css" media="all" />
</head>
<body class="childrenBody">
<form class="layui-form layui-row layui-col-space10">
    <div class="layui-col-md11 layui-col-xs12">
        <div class="layui-row layui-col-space10">
            <div class="layui-col-md9 layui-col-xs7">

                <div class="layui-form-item magt3">
                    <label class="layui-form-label">资源类型</label>
                    <div class="layui-input-block">
                        <input type="radio" name="class_id"  value="1" title="网络资源" lay-skin="primary" checked />
                        <input type="radio" name="class_id"  value="2" title="网盘资源" lay-skin="primary" />
                    </div>
                </div>

                <div class="layui-form-item ">
                    <label class="layui-form-label">资源链接</label>
                    <div class="layui-input-inline">
                        <input type="text" name="urls" class="layui-input " lay-verify="required|url"  placeholder="请输入资源链接">
                    </div>

                    <label class="layui-form-label">网盘密码</label>
                    <div class="layui-input-inline">
                        <input type="text" name="down_info" class="layui-input " lay-verify=""  placeholder="请输入网盘密码">
                    </div>

                </div>

                <div class="layui-form-item ">
                    <label class="layui-form-label">资源标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" class="layui-input" lay-verify="required" placeholder="请输入资源标题">
                    </div>
                </div>

            </div>

            <div class="layui-col-md3 layui-col-xs5">
                <div class="layui-upload-list thumbBox mag0 magt3">
                    <img class="layui-upload-img thumbImg " src="http://localhost/uploads/default.jpg">
                    <input class="layui-hide" name="cover" id="cover" value="http://localhost/uploads/default.jpg">
                </div>
            </div>

            <div class="layui-col-md12 layui-col-xs12">
                <div class="layui-form-item">
                    <label class="layui-form-label">内容摘要</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容摘要" lay-verify="required" name="abstracts" class="layui-textarea abstract"></textarea>
                    </div>
                </div>
            </div>

        </div>

        <center>
            <a class="layui-btn layui-btn-sm" lay-filter="addshare" lay-submit><i class="layui-icon">&#xe609;</i>添加</a>
            <button class="layui-btn layui-btn-primary layui-btn-sm" type="reset" >重置</button>
        </center>

    </div>

</form>
<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/admin/js/share/create.js"></script>
</body>
</html>