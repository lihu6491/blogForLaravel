layui.use(['form','layer','laydate','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        laytpl = layui.laytpl,
        table = layui.table;

    //内容列表
    var tableIns = table.render({
        elem: '#shareList',
        url : '/admins/share/list',
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limit : 10,
        limits : [10,15,20,25],
        id : "shareListTable",
        cols : [[
            {type: "checkbox", fixed:"left", width:50},
            {field: 'id', title: 'ID', width:60, align:"center"},
            {field: 'classWord', title: '类别', align:'center',width:100},
            {field: 'cover', title: '封面', align:'center',width:100,templet:function(d){
                    return '<img src="'+d.cover+'" height="26" />';
                }},
            {field: 'title', title: '资源标题'},
            {field: 'abstracts', title: '资源说明', align:'center'},
            {field: 'urls', title: '资源链接', align:'center',templet:function(d){
                return '<a class="layui-blue" href="'+d.urls+'" target="_blank">'+d.urls+'</a>';
            }},
            {field: 'down_info', title: '网盘密码',  align:'center',width:100},
            {field: 'created_at', title: '分享时间', align:'center', width:120},
            {title: '操作', width:120, templet:'#shareBar',fixed:"right",align:"center"}
        ]]
    });

    //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    $(".search_btn").on("click",function(){
        table.reload("shareListTable",{
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                title: $(".searchVal").val()  //搜索的关键字
            }
        })

    });

    //添加文章
    function createShare(edit){
        var index = layui.layer.open({
            title : "添加分享资源",
            type : 2,
            content : "/admins/share/create",
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                if(edit){
                    body.find(".newsName").val(edit.newsName);
                    body.find(".abstract").val(edit.abstract);
                    body.find(".thumbImg").attr("src",edit.newsImg);
                    body.find("#news_content").val(edit.content);
                    body.find(".newsStatus select").val(edit.newsStatus);
                    body.find(".openness input[name='openness'][title='"+edit.newsLook+"']").prop("checked","checked");
                    body.find(".newsTop input[name='newsTop']").prop("checked",edit.newsTop);
                    form.render();
                }
                setTimeout(function(){
                    layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
        layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
    }

    //编辑文章
    function updateShare(id,edit){
        var index = layui.layer.open({
            title : "编辑",
            type : 2,
            content : "/admins/share/update?id="+id,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                if(edit){
                    body.find(".newsName").val(edit.newsName);
                    body.find(".abstract").val(edit.abstract);
                    body.find(".thumbImg").attr("src",edit.newsImg);
                    body.find("#news_content").val(edit.content);
                    body.find(".newsStatus select").val(edit.newsStatus);
                    body.find(".openness input[name='openness'][title='"+edit.newsLook+"']").prop("checked","checked");
                    body.find(".newsTop input[name='newsTop']").prop("checked",edit.newsTop);
                    form.render();
                }
                setTimeout(function(){
                    layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
        layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
    }

    $(".createShare_btn").click(function(){
        createShare();
    })

    //批量删除
    $(".delAll_btn").click(function(){
        var checkStatus = table.checkStatus('newsListTable'),
            data = checkStatus.data,
            newsId = [];
        if(data.length > 0) {
            for (var i in data) {
                newsId.push(data[i].newsId);
            }
            layer.confirm('确定删除选中的资源？', {icon: 3, title: '提示信息'}, function (index) {
                // $.get("删除文章接口",{
                //     newsId : newsId  //将需要删除的newsId作为参数传入
                // },function(data){
                tableIns.reload();
                layer.close(index);
                // })
            })
        }else{
            layer.msg("请选择需要删除的资源");
        }
    })

    //列表操作
    table.on('tool(shareList)', function(obj){
        var layEvent = obj.event,
            data = obj.data;

        if(layEvent === 'edit'){ //编辑
            updateShare(data.id);
        } else if(layEvent === 'del'){ //删除
            layer.confirm('确定删除此文章？',{icon:3, title:'提示信息'},function(index){

                $.ajax({
                    url: '/admins/share/delete',
                    type: 'post',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {id : data.id},
                })
                    .done(function(rest) {
                        layer.close(index);
                        if(rest.code == 400){
                            layer.msg("删除失败！");
                            return false;
                        }
                        layer.msg("删除成功！");
                        tableIns.reload();
                    });
            });
        }
    });

})