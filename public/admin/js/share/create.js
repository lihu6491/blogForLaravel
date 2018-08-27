layui.use(['form','layer','layedit','laydate','upload'],function(){
    var form = layui.form
    layer = parent.layer === undefined ? layui.layer : top.layer,
        laypage = layui.laypage,
        upload = layui.upload,
        layedit = layui.layedit,
        laydate = layui.laydate,
        $ = layui.jquery;

    //上传缩略图
    upload.render({
        elem: '.thumbBox',
        url: '/admins/attachmenuploads',
        method : "post",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        done: function(res, index, upload){
            var num = parseInt(4*Math.random());  //生成0-4的随机数，随机显示一个头像信息
            $('.thumbImg').attr('src',res.Msg.url);
            $('.thumbBox').css("background","#fff");
            $('#slightly').attr('value',res.Msg.url);
        }
    });

    function procAddData(data){
        if(data)
            return data == 'on' ? 1 : 0;
    }
    //新增
    form.on("submit(addshare)",function(data){
        //弹出loading

        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        var dataField = data.field;

        // 实际使用时的提交信息
        $.ajax({
            url: '/admins/share/add',
            type: 'post',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:data.field
        })
            .done(function(rest) {
                if(rest.code = 200){
                    setTimeout(function(){
                        top.layer.close(index);
                        top.layer.msg("文章添加成功！");
                        layer.closeAll("iframe");
                        //刷新父页面
                        parent.location.reload();
                    },500);
                }else{
                    top.layer.close(index);
                    top.layer.msg("文章添加失败！");
                }

            })


        return false;
    })

    //编辑
    form.on("submit(editshare)",function(data){
        //弹出loading

        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        var dataField = data.field;

        // 实际使用时的提交信息
        $.ajax({
            url: '/admins/share/edit',
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
                        parent.location.reload();
                    },500);
                }else{
                    top.layer.close(index);
                    top.layer.msg("编辑失败！");
                }

            })


        return false;
    })

})