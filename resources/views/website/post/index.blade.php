
@extends('layouts._website')
@section('title', '一个PHP程序员的个人博客')
@section('content')
    <div class="blog-panel blog-column">


        </div>
    </div>

    <div class="layui-container">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md8">
                <div class="blog-panel">
                    <div class="blog-panel-title blog-filter">
                        <span class="layui-breadcrumb" lay-separator="|" classify="classify">
                          <a href="javascript:" classify_flag = 'all' style="@php echo $params['classify'] == 'all' ? 'color: #009688!important;' :'' @endphp">全部</a>
                          <a href="javascript:" classify_flag = 'base' style="@php echo $params['classify'] == 'base' ? 'color: #009688!important;' :'' @endphp">基础</a>
                          <a href="javascript:" classify_flag = 'example' style="@php echo $params['classify'] == 'example' ? 'color: #009688!important;' :'' @endphp">案例</a>
                          <a href="javascript:" classify_flag = 'frame' style="@php echo $params['classify'] == 'frame' ? 'color: #009688!important;' :'' @endphp">框架</a>
                          <a href="javascript:" classify_flag = 'tool' style="@php echo $params['classify'] == 'tool' ? 'color: #009688!important;' :'' @endphp">工具</a>
                          <a href="javascript:" classify_flag = 'default' style="@php echo $params['classify'] == 'default' ? 'color: #009688!important;' :'' @endphp">其他</a>
                        </span>
                    </div>
                    <ul class="blog-list" id="postlist" >
                    </ul>
                </div>

            </div>
            <div class="layui-col-md4">

                <div class="blog-panel">
                    <center><h3 class="blog-panel-title">「猿强，则国强。国强，则猿更强」</h3></center>
                </div>

                <div class="blog-panel">
                    <h3 class="blog-panel-title">搜索</h3>
                    <div class="layui-row blog-panel-main" style="padding: 15px;">
                        <div class="layui-clear blog-list-quick">

                            <form class="layui-form" action="">
                                <input type="text" name="wd"  placeholder="请输入搜索内容" value="{{$params['title']}}" class="layui-input">
                            </form>

                            <a name="signin"> </a>
                        </div>
                    </div>
                </div>

                <div class="blog-panel">
                    <h3 class="blog-panel-title">标签云</h3>
                    <div class="layui-row blog-panel-main" style="padding: 15px;">
                        <div class="layui-clear blog-list-quick tags" tags ='tags'>
                            @foreach ($tagsList as $tags)
                                <span class="layui-badge {{$tags['style']}}" tags="{{$tags['name']}}">{{$tags['name']}}</span>
                            @endforeach
                            <a name="signin"> </a>
                        </div>
                    </div>
                </div>


                <div class="blog-panel">
                    <h3 class="blog-panel-title">近期文章</h3>
                    <div class="layui-row blog-panel-main" style="padding: 15px;">
                        <div class="layui-clear blog-list-quick">
                            <table class="layui-table" lay-skin="nob" id="blog_share_list" >
                                <tbody>
                                @foreach ($postlist['data'] as $post)
                                    <tr onclick="window.open('/post/show/'+{{$post['id']}}+'')">
                                        <td>
                                            <i class="layui-icon">&#xe756;</i>
                                            <span>「{{$post['title']}}」</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a name="signin"> </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <input type="hidden" id="nav_flag" value="post" />
    <input type="hidden" id="tags"     value="{{$params['tags']}}" />
    <input type="hidden" id="classify" value="{{$params['classify']}}" />
    <input type="hidden" id="post_title"    value="{{$params['title']}}" />

    <br>
    <script src="/editor-md/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/website/js/underscore-min.js"></script>
    <script type="text/javascript" src="/website/js/Particleground.js"></script>
    <script type="text/javascript" src="/website/js/index.js"></script>
@stop




