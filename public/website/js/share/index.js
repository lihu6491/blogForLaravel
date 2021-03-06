$(function() {
// 获取window的引用:
var $window = $(window);
// 获取包含data-src属性的img，并以jQuery对象存入数组:
var lazyImgs = _.map($('img[data-src]').get(), function (i) {
    return $(i);
});
// 定义事件函数:
var onScroll = function () {
    // 获取页面滚动的高度:
    var wtop = $window.scrollTop();
    // 判断是否还有未加载的img:
    if (lazyImgs.length > 0) {
        // 获取可视区域高度:
        var wheight = $window.height();
        // 存放待删除的索引:
        var loadedIndex = [];
        // 循环处理数组的每个img元素:
        _.each(lazyImgs, function ($i, index) {
            // 判断是否在可视范围内:
            if ($i.offset().top - wtop < wheight) {
                // 设置src属性:
                $i.attr('src', $i.attr('data-src'));
                // 添加到待删除数组:
                loadedIndex.unshift(index);
            }
        });
        // 删除已处理的对象:
        _.each(loadedIndex, function (index) {
            lazyImgs.splice(index, 1);
        });
    }
};
// 绑定事件:
$window.scroll(onScroll);
// 手动触发一次:
onScroll();

});

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
