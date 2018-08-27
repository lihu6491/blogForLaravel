<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>编辑文章</title>
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/admin/css/public.css" media="all" />
    <link href="/editor-md/css/editormd.css" rel="stylesheet">
</head>
<body class="childrenBody">

<script src="/editor-md/jquery-3.2.1.min.js"></script>
<script src="/editor-md/editormd.min.js"></script>
<script type="text/javascript">
    var postEditor;
    $(function() {
        postEditor = editormd("post_content", {
            width   : "100%",
            height  : 800,
            syncScrolling : "single",
            path    : "/editor-md/lib/",
            saveHTMLToTextarea : true,    // 保存 HTML 到 Textarea
            onload : function() {
                this.setMarkdown($("#post_content_text").val());
            }
        });

    });
</script>

<form class="layui-form layui-row layui-col-space10">
    <div class="layui-col-md9 layui-col-xs12" id="post_info_area">
        <div class="layui-row layui-col-space10">
            <div class="layui-col-md9 layui-col-xs7">
                <div class="layui-form-item magt3">
                    <label class="layui-form-label">文章标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" class="layui-input newsName" lay-verify="newsName" placeholder="请输入文章标题" value="{{$PostInfo['title']}}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">内容摘要</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容摘要" name="abstracts" class="layui-textarea abstract">{{$PostInfo['abstracts']}}</textarea>
                    </div>
                </div>
            </div>
            <div class="layui-col-md3 layui-col-xs5">
                <div class="layui-upload-list thumbBox mag0 magt3">
                    <img class="layui-upload-img thumbImg " src="{{$PostInfo['slightly']}}">
                    <input class="layui-hide" name="slightly" id="slightly" value="{{$PostInfo['slightly']}}">
                </div>
            </div>
        </div>
        <div class="layui-form-item magb0">
            <label class="layui-form-label">文章内容</label>
            <div class="layui-input-block">
                <div id="post_content" name="post_content" class="editormd editormd-vertical" style="width: 90%; height: 640px;"></div>
                <textarea id="post_content_text" style="display: none">{{$postContentInfo['post_content_markdown_doc']}}</textarea>
            </div>
        </div>
    </div>
    <div class="layui-col-md3 layui-col-xs12" id="post_option_area">
        <blockquote class="layui-elem-quote title"><i class="seraph icon-caidan"></i> 分类目录</blockquote>
        <div class="border category">
            <div class="">
                <p><input type="radio" name="classify"  value="1" title="基础" lay-skin="primary" @if ($PostInfo['classify'] == 1) checked @endif /></p>
                <p><input type="radio" name="classify"  value="2" title="案例" lay-skin="primary" @if ($PostInfo['classify'] == 2) checked @endif /></p>
                <p><input type="radio" name="classify"  value="3" title="框架" lay-skin="primary" @if ($PostInfo['classify'] == 3) checked @endif /></p>
                <p><input type="radio" name="classify"  value="4" title="工具" lay-skin="primary" @if ($PostInfo['classify'] == 4) checked @endif /></p>
                <p><input type="radio" name="classify"  value="5" title="其他" lay-skin="primary" @if ($PostInfo['classify'] == 5) checked @endif  /></p>
            </div>
        </div>

        <blockquote class="layui-elem-quote title magt10"><i class="layui-icon">&#xe66a;</i> 标签</blockquote>
        <div class="border ">
            <div class="layui-input-block mag0">
                <textarea id="tags" name="tags"  placeholder="请输入标签，以（,）分割" class="layui-textarea" >{{$PostInfo['tags']}}</textarea>
            </div>
        </div>
        <blockquote class="layui-elem-quote title magt10"><i class="layui-icon">&#xe609;</i> 发布</blockquote>
        <div class="border">
            <div class="layui-form-item">
                <label class="layui-form-label"><i class="layui-icon">&#xe60e;</i> 状　态</label>
                <div class="layui-input-block newsStatus">
                    <select name="status" lay-verify="required">
                        <option value="1" @if ($PostInfo['status'] == 1) selected @endif >保存草稿</option>
                        <option value="2" @if ($PostInfo['status'] == 2) selected @endif >已发布</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item layui-hide">
                <label class="layui-form-label"><i class="layui-icon">&#xe609;</i> 发　布</label>
                <div class="layui-input-block">
                    <input type="radio" name="" title="立即发布" lay-skin="primary" lay-filter="release"  />
                    <input type="radio" name="" title="定时发布" lay-skin="primary" lay-filter="release"  />
                </div>
            </div>
            <div class="layui-form-item openness">
                <label class="layui-form-label"><i class="seraph icon-look"></i> 公开度</label>
                <div class="layui-input-block">
                    <input type="radio" name="is_hide" value="0" title="开放浏览" lay-skin="primary" @if ($PostInfo['is_hide'] == 0) checked @endif />
                    <input type="radio" name="is_hide" value="1" title="私密浏览" lay-skin="primary" @if ($PostInfo['is_hide'] == 1) checked @endif />
                </div>
            </div>
            <div class="layui-form-item newsTop">
                <label class="layui-form-label"><i class="seraph icon-zhiding"></i> 置　顶</label>
                <div class="layui-input-block">
                    <input type="checkbox" name="is_top" value="1" lay-skin="switch" lay-text="是|否" @if ($PostInfo['is_top'] == 1) checked @endif />
                </div>
            </div>
            <div class="layui-form-item post_type">
                <label class="layui-form-label"><i class="layui-icon">&#xe60b;</i> 出　处</label>
                <div class="layui-input-block">
                    <input type="radio" name="is_original" value="1" title="原创" lay-skin="primary" @if ($PostInfo['is_original'] == 1) checked @endif />
                    <input type="radio" name="is_original" value="0" title="转载" lay-skin="primary" @if ($PostInfo['is_original'] == 0) checked @endif />
                </div>
            </div>
            <hr class="layui-bg-gray" />
            <div class="layui-right">
                <a class="layui-btn layui-btn-sm" lay-filter="editpost" lay-submit><i class="layui-icon">&#xe609;</i>发布</a>
                <button class="layui-btn layui-btn-primary layui-btn-sm" type="reset" >重置</button>
                <input type="hidden" name="post_id" id="post_id" value="{{$PostInfo['id']}}" />
            </div>
        </div>
    </div>
</form>
<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/admin/js/post/create.js"></script>
</body>
</html>