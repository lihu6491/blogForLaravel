layui.use(['form','layer','laydate','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        laytpl = layui.laytpl,
        table = layui.table;

    //内容列表
    var tableIns = table.render({
        elem: '#postList',
        url : '/admins/post/list',
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limit : 10,
        limits : [10,15,20,25],
        id : "postListTable",
        cols : [[
            {type: "checkbox", fixed:"left", width:50},
            {field: 'id', title: 'ID', width:60, align:"center"},
            {field: 'title', title: '文章标题', width:350},
            {field: 'zan_num', title: '点赞数', align:'center'},
            {field: 'read_num', title: '阅读数', align:'center'},
            {field: 'status_word', title: '发布状态',  align:'center',templet:"#newsStatus"},
            {field: 'is_top', title: '是否置顶', align:'center', templet:function(d){
                if(d.is_top == 1)
                return '<input post_id = "'+ d.id+'" is_top = "'+ d.is_top_val+'" type="checkbox" name="postTop" lay-filter="postTop" lay-skin="switch" lay-text="是|否" checked >'

                return '<input post_id = "'+ d.id+'" is_top = "'+ d.is_top_val+'" type="checkbox" name="postTop" lay-filter="postTop" lay-skin="switch" lay-text="是|否"  >'
            }},
            {field: 'created_at', title: '发布时间', align:'center', minWidth:110},
            {title: '操作', width:170, templet:'#postBar',fixed:"right",align:"center"}
        ]]
    });

    //是否置顶
    form.on('switch(postTop)', function(data){
        var index = layer.msg('修改中，请稍候',{icon: 16,time:false,shade:0.8});
        var switchObj = $(this);
        $.ajax({
                url: '/admins/post/top',
                type: 'post',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {id : switchObj.attr('post_id'), is_top : switchObj.attr('is_top')},
            })
            .done(function(rest) {
                layer.close(index);
                if(rest.code == 400){
                    layer.msg("操作失败！");
                    return false;
                }

                if(data.elem.checked){
                    layer.msg("置顶成功！");
                }else{
                    layer.msg("取消置顶成功！");
                }
            });
    })

    //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    $(".search_btn").on("click",function(){
        table.reload("postListTable",{
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                title: $(".searchVal").val()  //搜索的关键字
            }
        })

    });

    //添加文章
    function createPost(edit){
        var index = layui.layer.open({
            title : "添加文章",
            type : 2,
            content : "/admins/post/create",
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
                    layui.layer.tips('点击此处返回文章列表', '.layui-layer-setwin .layui-layer-close', {
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

    //预览文章
    function showPost(id,edit){
        var index = layui.layer.open({
            title : "预览文章",
            type : 2,
            content : "/admins/post/show?id="+id,
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
                    layui.layer.tips('点击此处返回文章列表', '.layui-layer-setwin .layui-layer-close', {
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
    function updatePost(id,edit){
        var index = layui.layer.open({
            title : "编辑文章",
            type : 2,
            content : "/admins/post/update?id="+id,
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
                    layui.layer.tips('点击此处返回文章列表', '.layui-layer-setwin .layui-layer-close', {
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

    $(".createPost_btn").click(function(){
        createPost();
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
            layer.confirm('确定删除选中的文章？', {icon: 3, title: '提示信息'}, function (index) {
                // $.get("删除文章接口",{
                //     newsId : newsId  //将需要删除的newsId作为参数传入
                // },function(data){
                tableIns.reload();
                layer.close(index);
                // })
            })
        }else{
            layer.msg("请选择需要删除的文章");
        }
    })

    //列表操作
    table.on('tool(postList)', function(obj){
        var layEvent = obj.event,
            data = obj.data;

        if(layEvent === 'edit'){ //编辑
            updatePost(data.id);
        } else if(layEvent === 'del'){ //删除
            layer.confirm('确定删除此文章？',{icon:3, title:'提示信息'},function(index){

                $.ajax({
                    url: '/admins/post/delete',
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
        } else if(layEvent === 'look'){ //预览
            showPost(data.id);
        }
    });

})