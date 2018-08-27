layui.use(['form','util', 'layer','layedit', 'laydate','element','jquery'], function() {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        laytpl = layui.laytpl,
        util = layui.util,
        layer = layui.layer,
        table = layui.table;

    //回到顶部
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

});
