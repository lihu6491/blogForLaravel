
@extends('layouts._website')
@section('title', '查看文章')
@section('content')
    <link href="/editor-md/css/editormd.preview.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/website/css/post/show.css" media="all" />

    <div class="layui-main " style="padding-top: 100px;padding-bottom: 50px">
        <div class="layui-container ">
            <div class="layui-row ">
                <div class="layui-col-md9 post-area layui-bg-white">
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
                    <button style="float: left!important;" class="last_post layui-btn" name="order_post"  post_id ='{{$OrderPost['last']['post_id']}}'  post_title ='{{$OrderPost['last']['title']}}'  @if ($OrderPost['last']['post_id'] == 0 ) disabled @endif title="{{$OrderPost['last']['title']}}" ><i class="layui-icon">&#xe65a;</i>   上一篇</button>
                    <button style="float: right!important;" class="next_post layui-btn" name="order_post"  post_id ='{{$OrderPost['next']['post_id']}}'  post_title ='{{$OrderPost['next']['title']}}'  @if ($OrderPost['next']['post_id'] == 0 ) disabled @endif title="{{$OrderPost['next']['title']}}" >下一篇  <i class="layui-icon">&#xe65b;</i> </button>
                </div>

                <div class="layui-col-md3">
                    <div id="segment">
                        <div class="layui-btn-group layui-btn-fluid">
                            <button style="float: left!important;" class="last_post_bottom layui-btn "  post_id ='{{$OrderPost['last']['post_id']}}' name="order_post" post_title ='{{$OrderPost['last']['title']}}'  @if ($OrderPost['last']['post_id'] == 0 ) disabled @endif title="{{$OrderPost['last']['title']}}" ><i class="layui-icon">&#xe65a;</i>   上一篇</button>
                            <button style="float: right!important;" class="next_post_bottom layui-btn "  post_id ='{{$OrderPost['next']['post_id']}}' name="order_post" post_title ='{{$OrderPost['next']['title']}}'  @if ($OrderPost['next']['post_id'] == 0 ) disabled @endif title="{{$OrderPost['next']['title']}}" >下一篇  <i class="layui-icon">&#xe65b;</i> </button>
                        </div>
                    </div>
                </div>

                <div class="layui-col-md3">
                    <div id="sidebar">
                        <center><h4>目录</h4></center>
                        <hr class="layui-bg-green">
                        <div class="markdown-body editormd-preview-container" id="custom-toc-container">#custom-toc-container</div>
                    </div>
                </div>
            </div>

            <div class="layui-row" style="padding-top: 20px">
                <div class="layui-col-md9 layui-bg-white" style="color: black">
                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;text-align: center">
                        <legend><i class="layui-icon">&#xe63a;</i>     留言区</legend>
                    </fieldset>
                    <!--PC版-->
                    <div id="SOHUCS" sid="{{$PostInfo['id']}}"></div>
                    <script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
                    <script type="text/javascript">
                        window.changyan.api.config({
                            appid: 'cytEkXAVF',
                            conf: 'prod_815a6ea6445503c41f9ccc8374118080'
                        });
                    </script>
                </div>
            </div>

        </div>
    </div>
    <input type="hidden" id="nav_flag" value="post" />

    <script src="/editor-md/jquery-3.2.1.min.js"></script>
    <script src="/editor-md/lib/marked.min.js"></script>
    <script src="/editor-md/lib/prettify.min.js"></script>

    <script src="/editor-md/lib/raphael.min.js"></script>
    <script src="/editor-md/lib/underscore.min.js"></script>
    <script src="/editor-md/lib/sequence-diagram.min.js"></script>
    <script src="/editor-md/lib/flowchart.min.js"></script>
    <script src="/editor-md/lib/jquery.flowchart.min.js"></script>
    <script src="/editor-md/editormd.min.js"></script>
    <script type="text/javascript" src="/website/js/post/show.js"></script>
@stop
