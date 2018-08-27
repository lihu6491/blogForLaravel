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

    //下载
    var active = {
        notice: function(){
            //示范一个公告层
            layer.open({
                type: 1
                ,title: false //不显示标题栏
                ,closeBtn: false
                ,area: '300px;'
                ,shade: 0.8
                ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                ,btn: ['下载', '关闭']
                ,btnAlign: 'c'
                ,moveType: 1 //拖拽模式，0或者1
                ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">百度网盘密码：'+$(this).attr('down_info')+'</div>'
                ,success: function(layero){
                    console.log($(this).attr('urls'));
                    var btn = layero.find('.layui-layer-btn');
                    btn.find('.layui-layer-btn0').attr({
                        href:$("[op_check='check_this']").attr('urls')
                        ,target: '_blank'
                    });
                }
            });
        }
    };
    //查看
    $("[name='share_op']").on('click', function(){
        $("[op_check='check_this']").attr('op_check','');
        var othis = $(this), method = othis.data('method');
        var urls = othis.attr('urls');
        var down_info = othis.attr('down_info');
        othis.attr('op_check','check_this');
        if(down_info)
            active[method] ? active[method].call(this, othis) : '';
        else
            window.open(urls);
    });

    var nav_flag = $("#nav_flag").val();
    $("#layui_nav").find("li").removeClass('layui-this');
    $("#"+nav_flag).addClass('layui-this');

});
