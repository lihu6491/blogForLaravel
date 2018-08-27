<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>预览文章</title>
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/admin/css/public.css" media="all" />
    <link href="/editor-md/css/editormd.preview.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/css/post/show.css" media="all" />

</head>
<body class="childrenBody">
<div class="layui-container">
    <div class="layui-row">
        <div class="layui-col-md8">
            <h1>{{$PostInfo['title']}}</h1>
            <div class="fly-detail-info">
                <span class="layui-badge layui-bg-green fly-detail-column"> 发布时间：{{$PostInfo['created_at']}} </span>
                <span class="layui-badge layui-bg-black fly-detail-column"> 分类：{{$PostInfo['tags']}} </span>
                <div class="fly-admin-box" data-id="31616"> </div>
                <span class="fly-list-nums">
                    <i class="seraph icon-look"></i>121121
                    <i class="layui-icon">&#xe63a;</i>4252
                </span>
            </div>
            <div id="post_content_area">
                <textarea id="post_content_html" class="layui-hide" >{{$postContentInfo['post_content_markdown_doc']}}</textarea>
            </div>
        </div>
        <div class="layui-col-md4">
            <div id="sidebar">
                <h1>目录</h1>
                <div class="markdown-body editormd-preview-container" id="custom-toc-container">#custom-toc-container</div>
            </div>
        </div>
    </div>
</div>


<div style="margin-left: 10px" >

</div>
<div>

</div>


<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
    <div class="layui-tab-item layui-show">
    </div>
</div>

</body>
</html>
<script src="/editor-md/jquery-3.2.1.min.js"></script>
<script src="/editor-md/lib/marked.min.js"></script>
<script src="/editor-md/lib/prettify.min.js"></script>

<script src="/editor-md/lib/raphael.min.js"></script>
<script src="/editor-md/lib/underscore.min.js"></script>
<script src="/editor-md/lib/sequence-diagram.min.js"></script>
<script src="/editor-md/lib/flowchart.min.js"></script>
<script src="/editor-md/lib/jquery.flowchart.min.js"></script>
<script src="/editor-md/editormd.min.js"></script>
<script type="text/javascript" src="/layui/layui.js"></script>
<script>

    layui.use(['form', 'layedit', 'laydate','element','jquery'], function() {
        var form = layui.form,
            layer = parent.layer === undefined ? layui.layer : top.layer,
            $ = layui.jquery,
            laydate = layui.laydate,
            laytpl = layui.laytpl,
            table = layui.table;

        post_content_html = editormd.markdownToHTML("post_content_area", {
            markdown        :  $("#post_content_html").text(),
            //htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
            htmlDecode      : "style,script,iframe",  // you can filter tags decode
            //toc             : false,
            tocm            : true,    // Using [TOCM]
            tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
            //gfm             : false,
            //tocDropdown     : true,
            // markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
            emoji           : true,
            taskList        : true,
            tex             : true,  // 默认不解析
            flowChart       : true,  // 默认不解析
            sequenceDiagram : true,  // 默认不解析
        });
    });

</script>