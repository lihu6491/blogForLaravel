layui.use(['form','layer','jquery'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer
    $ = layui.jquery;

    $(".loginBody .seraph").click(function(){
        layer.msg("开发中....",{
            time:5000
        });
    })

    //登录按钮
    form.on("submit(login)",function(data){
        $(this).text("登录中...").attr("disabled","disabled").addClass("layui-disabled");

        $.ajax({
            url: "/admins/dologin",
            type:"post",
            dataType:"json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                'userName' : data.field.userName,
                'password' : data.field.password
            },
            beforeSend:function(xhr){

            },
            success: function(rest){
                if(rest.code == 200)
                    document.location.href = '/admins/';
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){

            },
            complete:function(XMLHttpRequest, textStatus) {
            },

        });


        return false;
    })

    //表单输入效果
    $(".loginBody .input-item").click(function(e){
        e.stopPropagation();
        $(this).addClass("layui-input-focus").find(".layui-input").focus();
    })
    $(".loginBody .layui-form-item .layui-input").focus(function(){
        $(this).parent().addClass("layui-input-focus");
    })
    $(".loginBody .layui-form-item .layui-input").blur(function(){
        $(this).parent().removeClass("layui-input-focus");
        if($(this).val() != ''){
            $(this).parent().addClass("layui-input-active");
        }else{
            $(this).parent().removeClass("layui-input-active");
        }
    })
})
