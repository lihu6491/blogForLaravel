var $,tab,dataStr,layer;

(function(T,h,i,n,k,P,a,g,e){g=function(){P=h.createElement(i);a=h.getElementsByTagName(i)[0];P.src=k;P.charset="utf-8";P.async=1;a.parentNode.insertBefore(P,a)};T["ThinkPageWeatherWidgetObject"]=n;T[n]||(T[n]=function(){(T[n].q=T[n].q||[]).push(arguments)});T[n].l=+new Date();if(T.attachEvent){T.attachEvent("onload",g)}else{T.addEventListener("load",g,false)}}(window,document,"script","tpwidget","//widget.seniverse.com/widget/chameleon.js"))

tpwidget("init", {
    "flavor": "bubble",
    "location": "WX4FBXXFKE4F",
    "geolocation": "enabled",
    "position": "top-right",
    "margin": "5px 50px",
    "language": "auto",
    "unit": "c",
    "theme": "chameleon",
    "uid": "UCD735FFA6",
    "hash": "8fd7ab56fbce85a4571bd181b4edebe0"
});
tpwidget("show");


layui.config({
    base : "/admin/js/"
}).extend({
    "bodyTab" : "bodyTab"
})

layui.use(['bodyTab','form','carousel','util','laydate','element','layer','jquery','flow'],function() {
    var form = layui.form,
        laydate = layui.laydate,
        util = layui.util,
        carousel = layui.carousel,
        flow = layui.flow,
        element = layui.element;
    $ = layui.$;
    layer = parent.layer === undefined ? layui.layer : top.layer;

    //轮播
    carousel.render({
        elem: '#carousels',
        autoplay:true,
        interval:1700,
        arrow:'none',
        indicator:'none',
        height :'210px',
        width:'100%'


    });

    //日历
    laydate.render({
        elem: '#calendar'
        ,position: 'static'
        ,showBottom: false
    });

    //粒子背景特效
    $('body').particleground({
        dotColor: '#5FB878',
        lineColor: '#009688'
    });

    util.fixbar({
        bar1: false,
        bgcolor: '#009688',
        css: {right: 50, bottom: 50}
        ,click: function(type){
        }
    });


    //选中头部导航
    var nav_flag = $("#nav_flag").val();
    $("#layui_nav").find("li").removeClass('layui-this');
    $("#"+nav_flag).addClass('layui-this');

    //文章流加载
    flow.load({
        elem: '#postlist'
        ,done: function(page, next){
            var lis = [];
            $.ajax({
                url: '/post/list',
                type: 'get',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    "page":page,
                    "classify" : $("#classify").val(),
                    "tags" : $("#tags").val(),
                    "title" : $("#post_title").val()
                },
            })
            .done(function(rest) {
                layui.each(rest.data, function(index, item){
                    lis.push(getpostItemStr(item));
                });

                next(lis.join(''), page < rest.last_page);
                //查看文章
                $('.blog-list').find('li').click(function(){
                    window.open('/post/show/'+$(this).attr('post_id'));
                });
            });
        }
    });

    //构造每条文章的数据
    function getpostItemStr(post)
    {
        var postStr = '';
        postStr += '<li post_id="'+post.id+'" >';
        postStr += '<div class="layui-row layui-col-space12">';
        postStr += '<div class="layui-col-md11">';
        postStr += '<div class="grid-demo grid-demo-bg1 blog-list-title"><h2>'+post.title+'</h2></div>';
        postStr += '</div>';
        postStr += '<div class="layui-col-md1">';
        postStr += '<div class="grid-demo">';
        postStr += '<div class="fly-list-badge">';
        postStr += '<span class="layui-badge layui-bg-red">精</span>';
        postStr += '</div>';
        postStr += '</div>';
        postStr += '</div>';
        postStr += '</div>';

        postStr += '<div class="layui-row layui-col-space10">';
        postStr += '<div class="layui-col-md3">';
        postStr += '<div class="grid-demo grid-demo-bg1">';
        if(!post.slightly){
            postStr += '<img src="/uploads/default.jpg">';
        }else{
            postStr += '<img src="'+post.slightly+'">';
        }
        postStr += '</div>';
        postStr += '</div>';
        postStr += '<div class="layui-col-md9">';
        postStr += '<div class="grid-demo ">';
        postStr += '<div class="blog-list-content" >';
        postStr += ''+post.abstracts+'';
        postStr += '</div>';
        postStr += '<div class="blog-list-info" >';
        postStr += '<dd>';
        postStr += '<i class="layui-icon iconfont ">&#xe612;</i>';
        postStr += '<span>skyrim</span>';
        postStr += '</dd>';
        postStr += '<dd>';
        postStr += '<i class="layui-icon iconfont ">&#xe66e;</i>';
        postStr += '<span>'+post.tags+'</span>';
        postStr += '</dd>';
        postStr += '<dd>';
        postStr += '<i class="layui-icon iconfont ">&#xe60e;</i>';
        postStr += '<span>'+post.updated_at+'</span>';
        postStr += '</dd>';
        postStr += '</div>';
        postStr += '</div>';
        postStr += '</div>';
        postStr += '</div>';
        postStr += '</li>';

        return postStr;
    }

    /**
     * 分类筛选
     */

    $("[classify='classify']").find('a').click(function(){
        document.location.href = '/post/classify/'+$(this).attr('classify_flag');
    });

    /**
     * 标签筛选
     */
    $("[tags='tags']").find('span').click(function(){
        document.location.href = '/post/tags/'+$(this).attr('tags');
    });



});