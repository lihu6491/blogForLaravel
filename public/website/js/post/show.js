layui.use(['form','util', 'layer','layedit', 'laydate','element','jquery'], function() {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        laytpl = layui.laytpl,
        util = layui.util,
        layer = layui.layer,
        table = layui.table;

    //上一篇 先一篇
    $("[name='order_post']").hover(function(){
        var orderPost = $(this);
        var PosyTitle = orderPost.attr('post_title');
        var className = orderPost.prop('class').split(" ");

        layer.tips(PosyTitle, '.'+className[0], {
            tips: 1,
        });
        return false;
    });

    $("[name='order_post']").click(function(){
        var orderPost = $(this);
        var post_id = orderPost.attr('post_id');
        if(post_id == 0 ){
            layer.msg('没有找到对应的文章');
            return false;
        }

       document.location.href = '/post/show/'+post_id;

    });

    //回到顶部
    util.fixbar({
        bar1: false,
        bgcolor: '#009688',
        css: {right: 50, bottom: 50}
        ,click: function(type){
        }
    });


    //监测滚动条
    $(window).scroll(function(event){
        var winPos = $(window).scrollTop();

        if(winPos >500){
            // $("#sidebar").addClass('sidebar_position');
        }else{
            //$("#sidebar").removeClass('sidebar_position');
        }

    });
    //显示markdiwn
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

    var nav_flag = $("#nav_flag").val();
    $("#layui_nav").find("li").removeClass('layui-this');
    $("#"+nav_flag).addClass('layui-this');

});