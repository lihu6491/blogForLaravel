
@extends('layouts._website')
@section('title', '一个PHP程序员的个人博客')
@section('content')
    <div class="blog-panel blog-column">
        <div class="layui-container">
            <div class="blog-column layui-hide-xs">
                <i class="layui-icon notify-icon ">&#xe645;</i>开张了...............
            </div>
        </div>
    </div>

    <div class="layui-container">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md8">
                <div class="blog-panel">
                    <div class="blog-panel-title blog-filter" style="height: 220px!important;">
                        <center>
                            <div class="layui-carousel" id="carousels" style="background: none !important ">
                                <div carousel-item="" >
                                    @for ($i = 1; $i < 5; $i++)
                                        <div class="no-background carousels_item"><img class="" src="/image/dnf_gif/{{rand(1,49)}}.jpg"></div>
                                    @endfor
                                </div>
                            </div>
                        </center>
                    </div>
                    <ul class="blog-list" id="postlist">

                    </ul>
                </div>

            </div>
            <div class="layui-col-md4">

                <div class="blog-panel">
                    <center><h3 class="blog-panel-title">「猿强，则国强。国强，则猿更强」</h3></center>
                </div>

                <div class="blog-panel">
                    <h3 class="blog-panel-title" style="text-align: center">博主介绍</h3>
                    <div class="layui-row blog-panel-main" style="padding: 15px;">

                        <fieldset class="layui-elem-field" style="text-align: center;">
                            <legend><img src="/admin/images/face.png" class="face"></legend>
                            <div class="layui-field-box">
                                <p> 90后PHP程序员一枚</p>
                                <br>
                                <p>爱生活·喜编程·善总结</p>
                                <br>
                                <p><i class="layui-icon">&#xe715;</i> 天朝·首都</p>
                                <br>
                                <a href="tencent://message/?uin=1187276773&Site=&Menu=yes" onclick="" ><i class="seraph icon-qq contact-way"></i></a>
                                <a href="https://github.com/lihu6491" target="_blank" ><i class="seraph icon-github contact-way"></i></a>
                                <a href="mailto:649136262@qq.com" onclick="" ><img src="/mail.png" class="contact-main"></a>
                            </div>
                        </fieldset>

                        <div class="layui-clear blog-list-quick tags layui-hide ">
                            <span class="layui-badge layui-bg-orange">PHP</span>
                            <span class="layui-badge layui-bg-green">LINUX</span>
                            <span class="layui-badge layui-bg-cyan">LARVAEL</span>
                            <span class="layui-badge layui-bg-blue">YII</span>
                            <span class="layui-badge layui-bg-cyan">LARVAEL</span>
                            <span class="layui-badge layui-bg-blue">YII</span>
                            <span class="layui-badge layui-bg-black">NGINX</span>
                            <span class="layui-badge layui-bg-gray">MYSQL</span>
                            <span class="layui-badge layui-bg-black">NGINX</span>
                            <span class="layui-badge layui-bg-gray">MYSQL</span>
                            <span class="layui-badge layui-bg-orange">PHP</span>
                            <span class="layui-badge layui-bg-green">LINUX</span>
                            <span class="layui-badge layui-bg-cyan">LARVAEL</span>
                            <span class="layui-badge layui-bg-blue">YII</span>
                            <span class="layui-badge layui-bg-black">NGINX</span>
                            <span class="layui-badge layui-bg-gray">MYSQL</span>
                            <span class="layui-badge layui-bg-cyan">LARVAEL</span>
                            <span class="layui-badge layui-bg-blue">YII</span>
                            <span class="layui-badge layui-bg-black">NGINX</span>
                            <span class="layui-badge layui-bg-gray">MYSQL</span>
                            <a name="signin"> </a>
                        </div>
                    </div>
                </div>

                <div class="blog-panel">
                    <h3 class="blog-panel-title">日历</h3>
                    <div class="layui-row blog-panel-main" style="padding: 15px;">
                        <div class="layui-clear blog-list-quick">
                            <div class="site-demo-laydate">
                                <div class="layui-inline" id="calendar"></div>
                            </div>
                            <a name="signin"> </a>
                        </div>
                    </div>
                </div>

                <div class="blog-panel">
                    <h3 class="blog-panel-title">最近分享</h3>
                    <div class="layui-row blog-panel-main" style="padding: 15px;">
                        <div class="layui-clear blog-list-quick">
                            <table class="layui-table" lay-skin="nob" id="blog_share_list" >
                                <tbody>
                                @foreach ($shareList['data'] as $share)
                                    <tr onclick="document.location.href='/share'">
                                        <td>
                                            <i class="layui-icon">&#xe756;</i>
                                            <span>「{{$share['title']}}」</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a name="signin"> </a>
                        </div>
                    </div>
                </div>

                <div class="blog-panel">
                    <h3 class="blog-panel-title">特别鸣谢</h3>
                    <div class="layui-row blog-panel-main" style="padding: 15px;">
                        <div class="layui-clear blog-list-quick tag">
                            <a href="https://www.layui.com/" target="_blank" ><span class="layui-badge layui-bg-black">Lay Ui</span></a>
                            <a href="https://laravel-china.org/" target="_blank" ><span class="layui-badge">laravel-china</span></a>
                            <a name="signin"> </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <input type="hidden" id="nav_flag" value="home" />
    <input type="hidden" id="tags"     value="all" />
    <input type="hidden" id="classify" value="all" />
    <br>
    <script type="text/javascript" src="/website/js/Particleground.js"></script>
    <script type="text/javascript" src="/website/js/index.js"></script>
@stop




