@extends('layouts._website')
@section('title', '关于')
@section('content')
    <link href="/editor-md/css/editormd.preview.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/website/css/webnav/index.css" media="all" />

    <div class="layui-main layui-bg-white" style="padding-top: 100px;padding-bottom: 50px">
        <div style="height: 800px;text-align: center" >
            <img style="width: 100%;height: 300px" src="/image/load/1-1.jpg">
            <br/>

            <img style="width: 50%;height: 300px" src="/image/load/1-3.jpeg">
        </div>
    </div>
    <input type="hidden" id="nav_flag" value="about" />

    <script>
        layui.use(['form','util', 'layer','layedit', 'laydate','element','jquery'], function() {
            var form = layui.form,
                layer = parent.layer === undefined ? layui.layer : top.layer,
                $ = layui.jquery,
                laydate = layui.laydate,
                laytpl = layui.laytpl,
                util = layui.util,
                layer = layui.layer,
                table = layui.table;

            lay
            util.fixbar({
                bar1: false,
                bgcolor: '#009688',
                css: {right: 50, bottom: 50}
                ,click: function(type){
                }
            });

            var nav_flag = $("#nav_flag").val();
            $("#layui_nav").find("li").removeClass('layui-this');
            $("#"+nav_flag).addClass('layui-this');
            layer.msg('页面建设中........');
        });
    </script>
@stop
