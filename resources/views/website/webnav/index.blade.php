@extends('layouts._website')
@section('title', '网址导航')
@section('content')
    <link href="/editor-md/css/editormd.preview.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/website/css/webnav/index.css" media="all" />

    <div class="layui-main layui-bg-white" style="padding-top: 100px;padding-bottom: 50px">

        <div class="layui-row layui-col-space10 webnav-item">
            <blockquote class="layui-elem-quote webnav-flag">官方网站</blockquote>
            @foreach ($NavList['gfwz'] as $Nav)
                <div class="layui-col-md2">
                    <div class="grid-demo grid-demo-bg1 share_item">
                        <button class="layui-btn layui-btn-fluid" onclick="window.open('{{$Nav['urls']}}')">{{$Nav['name']}}</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="layui-row layui-col-space10 webnav-item">
            <blockquote class="layui-elem-quote webnav-flag">在线工具</blockquote>
            @foreach ($NavList['zxgj'] as $Nav)
                <div class="layui-col-md2">
                    <div class="grid-demo grid-demo-bg1 share_item">
                        <button class="layui-btn layui-btn-fluid" onclick="window.open('{{$Nav['urls']}}')">{{$Nav['name']}}</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="layui-row layui-col-space10 webnav-item">
            <blockquote class="layui-elem-quote webnav-flag">视频学习</blockquote>
            @foreach ($NavList['gspxxw'] as $Nav)
                <div class="layui-col-md2">
                    <div class="grid-demo grid-demo-bg1 share_item">
                        <button class="layui-btn layui-btn-fluid" onclick="window.open('{{$Nav['urls']}}')">{{$Nav['name']}}</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="layui-row layui-col-space10 webnav-item">
            <blockquote class="layui-elem-quote webnav-flag">开发文档</blockquote>
            @foreach ($NavList['kfwd'] as $Nav)
                <div class="layui-col-md2">
                    <div class="grid-demo grid-demo-bg1 share_item">
                        <button class="layui-btn layui-btn-fluid" onclick="window.open('{{$Nav['urls']}}')">{{$Nav['name']}}</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="layui-row layui-col-space10 webnav-item">
            <blockquote class="layui-elem-quote webnav-flag">静态资源库</blockquote>
            @foreach ($NavList['zyk'] as $Nav)
                <div class="layui-col-md2">
                    <div class="grid-demo grid-demo-bg1 share_item">
                        <button class="layui-btn layui-btn-fluid" onclick="window.open('{{$Nav['urls']}}')">{{$Nav['name']}}</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="layui-row layui-col-space10 webnav-item">
            <blockquote class="layui-elem-quote webnav-flag">综合</blockquote>
            @foreach ($NavList['zh'] as $Nav)
                <div class="layui-col-md2">
                    <div class="grid-demo grid-demo-bg1 share_item">
                        <button class="layui-btn layui-btn-fluid" onclick="window.open('{{$Nav['urls']}}')">{{$Nav['name']}}</button>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <input type="hidden" id="nav_flag" value="webnav" />

    <script type="text/javascript" src="/website/js/webnav/index.js"></script>
@stop
