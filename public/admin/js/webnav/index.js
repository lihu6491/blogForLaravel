layui.use(['form','layer','laydate','table','upload'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        upload = layui.upload,
        table = layui.table;

    //列表
    var tableIns = table.render({
        elem: '#navList',
        url : '/admins/webnav/list',
        page : true,
        cellMinWidth : 95,
        height : "full-104",
        limit : 20,
        limits : [10,15,20,25],
        id : "navListTab",
        cols : [[
            {type: "checkbox", fixed:"left", width:50},
            {field: 'classifyWord', title: '类别', align:'center'},
            {field: 'name', title: '网站名称', minWidth:240},
            {field: 'urls', title: '网站地址',width:300,templet:function(d){
                    return '<a class="layui-blue" href="'+d.urls+'" target="_blank">'+d.urls+'</a>';
                }},
            {title: '操作', width:130,fixed:"right",align:"center", templet:function(){
                    return '<a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a><a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>';
                }}
        ]]
    });

    //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    $(".search_btn").on("click",function(){
        table.reload("navListTab",{
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                name: $(".searchVal").val()  //搜索的关键字
            }
        })
    });

    //添加
    function addNav(edit){
        var index = layer.open({
            title : "添加导航",
            type : 2,
            area : ["300px","350px"],
            content : "/admins/webnav/create",
            success : function(layero, index){
                var body = $($(".layui-layer-iframe",parent.document).find("iframe")[0].contentWindow.document.body);
                if(edit){
                    body.find(".linkLogo").css("background","#fff");
                    body.find(".linkLogoImg").attr("src",edit.logo);
                    body.find(".linkName").val(edit.websiteName);
                    body.find(".linkUrl").val(edit.websiteUrl);
                    body.find(".masterEmail").val(edit.masterEmail);
                    body.find(".showAddress").prop("checked",edit.showAddress);
                    form.render();
                }
                setTimeout(function(){
                    layui.layer.tips('点击此处返回导航列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
    }
    //编辑
    function editNav(id,dedit){
        var index = layer.open({
            title : "编辑导航",
            type : 2,
            area : ["300px","350px"],
            content : "/admins/webnav/update?id="+id,
            success : function(layero, index){
                var body = $($(".layui-layer-iframe",parent.document).find("iframe")[0].contentWindow.document.body);
                if(edit){
                    body.find(".linkLogo").css("background","#fff");
                    body.find(".linkLogoImg").attr("src",edit.logo);
                    body.find(".linkName").val(edit.websiteName);
                    body.find(".linkUrl").val(edit.websiteUrl);
                    body.find(".masterEmail").val(edit.masterEmail);
                    body.find(".showAddress").prop("checked",edit.showAddress);
                    form.render();
                }
                setTimeout(function(){
                    layui.layer.tips('点击此处返回导航列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
    }



    $(".addNav_btn").click(function(){
        addNav();
    })

    //批量删除
    $(".delAll_btn").click(function(){
        var checkStatus = table.checkStatus('navListTab'),
            data = checkStatus.data,
            linkId = [];
        if(data.length > 0) {
            for (var i in data) {
                linkId.push(data[i].newsId);
            }
            layer.confirm('确定删除选中的导航？', {icon: 3, title: '提示信息'}, function (index) {
                // $.get("删除友链接口",{
                //     linkId : linkId  //将需要删除的linkId作为参数传入
                // },function(data){
                tableIns.reload();
                layer.close(index);
                // })
            })
        }else{
            layer.msg("请选择需要删除的导航");
        }
    })

    //列表操作
    table.on('tool(navList)', function(obj){
        var layEvent = obj.event,
            data = obj.data;

        if(layEvent === 'edit'){ //编辑
            editNav(data.id);
        } else if(layEvent === 'del'){ //删除
            layer.confirm('确定删除此导航？',{icon:3, title:'提示信息'},function(index){
                $.ajax({
                    url: '/admins/webnav/delete',
                    type: 'post',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{'id':data.id}
                })
                .done(function(rest) {
                    tableIns.reload();
                    layer.close(index);
                });
            });
        }
    });

    form.on("submit(addNav)",function(data){
        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        // 实际使用时的提交信息
        $.ajax({
            url: '/admins/webnav/add',
            type: 'post',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:data.field
        })
            .done(function(rest) {
                if(rest.code = 200){
                    setTimeout(function(){
                        top.layer.close(index);
                        top.layer.msg("添加成功！");
                        layer.closeAll("iframe");
                        //刷新父页面
                        $(".layui-tab-item.layui-show",parent.document).find("iframe")[0].contentWindow.location.reload();
                    },500);
                }else{
                    top.layer.close(index);
                    top.layer.msg("失败！");
                }
            })

        return false;
    })

    //编辑
    form.on("submit(editNav)",function(data){
        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        // 实际使用时的提交信息
        $.ajax({
            url: '/admins/webnav/edit',
            type: 'post',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:data.field
        })
            .done(function(rest) {
                if(rest.code = 200){
                    setTimeout(function(){
                        top.layer.close(index);
                        top.layer.msg("编辑成功！");
                        layer.closeAll("iframe");
                        //刷新父页面
                        $(".layui-tab-item.layui-show",parent.document).find("iframe")[0].contentWindow.location.reload();
                    },500);
                }else{
                    top.layer.close(index);
                    top.layer.msg("失败！");
                }
            })

        return false;
    })

})