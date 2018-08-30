
@extends('layouts._website')
@section('title', '资源分享')
@section('content')
    <link href="/editor-md/css/editormd.preview.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/website/css/share/index.css" media="all" />

    <div class="layui-main share-main">

        <div class="layui-row layui-col-space30">
            @foreach ($ShareList as $share)
            <div class="layui-col-md3">
                <div class="grid-demo grid-demo-bg1 share_item">
                    <img src="/image/loading.gif"  data-src="{{$share['cover']}}" />
                    <div class="share-info">
                        <h3>{{$share['title']}}</h3>
                       <div class="share-abstracts" title="{{$share['abstracts']}}">
                           <span>{{$share['abstracts']}}</span>
                       </div>
                        <hr class="layui-bg-green">
                        @if ($share['down_info']!='')
                            <button class="layui-btn layui-btn-sm " data-method="notice" down_info="{{$share['down_info']}}" name="share_op" urls="{{$share['urls']}}"><i class="layui-icon">&#xe64c;</i>   下载</button>
                        @else
                            <button class="layui-btn layui-btn-sm " name="share_op"  urls="{{$share['urls']}}"><i class="layui-icon">&#xe638;</i>   查看</button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <input type="hidden" id="nav_flag" value="share" />
    <script src="/editor-md/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/website/js/underscore-min.js"></script>
    <script type="text/javascript" src="/website/js/share/index.js"></script>

@stop


