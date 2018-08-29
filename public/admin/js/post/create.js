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

    //格式化时间
    function filterTime(val){
        if(val < 10){
            return "0" + val;
        }else{
            return val;
        }
    }

    //定时发布
    var time = new Date();
    var submitTime = time.getFullYear()+'-'+filterTime(time.getMonth()+1)+'-'+filterTime(time.getDate())+' '+filterTime(time.getHours())+':'+filterTime(time.getMinutes())+':'+filterTime(time.getSeconds());
    laydate.render({
        elem: '#release',
        type: 'datetime',
        trigger : "click",
        done : function(value, date, endDate){
            submitTime = value;
        }
    });
    form.on("radio(release)",function(data){
        if(data.elem.title == "定时发布"){
            $(".releaseDate").removeClass("layui-hide");
            $(".releaseDate #release").attr("lay-verify","required");
        }else{
            $(".releaseDate").addClass("layui-hide");
            $(".releaseDate #release").removeAttr("lay-verify");
            submitTime = time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate()+' '+time.getHours()+':'+time.getMinutes()+':'+time.getSeconds();
        }
    });

    form.verify({
        newsName : function(val){
            if(val == ''){
                return "文章标题不能为空";
            }
        },
        content : function(val){
            if(val == ''){
                return "文章内容不能为空";
            }
        }
    })

    function procAddData(data){
        if(data)
            return data == 'on' ? 1 : 0;
    }
    //新增
    form.on("submit(addpost)",function(data){
        var post_content = $("[name='post_content_markdown_doc']").val();
        var reg = /\S/;

        if(!reg.test(post_content)){
            layer.msg('文章内容不能为空');
            return false;
        }

        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        var dataField = data.field;

        // 实际使用时的提交信息
        $.ajax({
                url: '/admins/post/add',
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
    form.on("submit(editpost)",function(data){

        var post_content = $("[name='post_content_markdown_doc']").val();
        var reg = /\S/;

        if(!reg.test(post_content)){
            layer.msg('文章内容不能为空');
            return false;
        }

        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        var dataField = data.field;

        // 实际使用时的提交信息
        $.ajax({
            url: '/admins/post/edit',
            type: 'post',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:data.field
        })
            .done(function(rest) {
                if(rest.code = 200){
                    setTimeout(function(){
                        top.layer.close(index);
                        top.layer.msg("文章编辑成功！");
                        layer.closeAll("iframe");
                        //刷新父页面
                        parent.location.reload();
                    },500);
                }else{
                    top.layer.close(index);
                    top.layer.msg("文章编辑失败！");
                }

            })


        return false;
    })

    //编辑器全屏优化

    $("[name='fullscreen']").parent().click(function(){
        $("#post_option_area").hide();
    });

    $(document).keydown(function(event){
    　　　　if(event.keyCode == 27){
            $("#post_option_area").show();
    　　　　}
    　　});
})