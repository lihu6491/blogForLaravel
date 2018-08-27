@extends('layouts._gii')
@section('content')
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
            <li class="layui-this"><i class="layui-icon">&#xe633;</i> Controller Generator</li>
        </ul>
    </div>
    <form class="layui-form" action="/gii/generatorController" method="post">

        <div class="layui-form-item">
            <label class="layui-form-label">Controller Directory</label>
            <div class="layui-input-block">
                <input type="text" name="Controller_Directory" id="Controller_Directory" lay-verify="required" autocomplete="off" placeholder="请输入Controller Directory" value="app/Http/Controllers/" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">Controller Name</label>
            <div class="layui-input-block">
                <input type="text" name="Controller_Name" id="Controller_Name" lay-verify="required" autocomplete="off" placeholder="请输入Controller Name " class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">Action IDs</label>
            <div class="layui-input-block">
                <input type="text" name="Action_IDs" id="Action_IDs" lay-verify="required" autocomplete="off" placeholder="请输入Action IDs " value="index" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">Namespace</label>
            <div class="layui-input-block ">
                <blockquote class="layui-elem-quote" style="color: #FF5722" id="Namespace">namespace App\Http\Controllers</blockquote>
                <input type="hidden"name="Namespace" id="NamespaceVal" value="namespace App\Http\Controllers" />
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">Base Class</label>
            <div class="layui-input-block ">
                <blockquote class="layui-elem-quote" style="color: #FF5722">App\Http\Controllers\Controller</blockquote>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="controller_submit"><i class="layui-icon">&#x1005;</i>Generator</button>
                <button type="button" class="layui-btn layui-btn-normal" id="Preview"><i class="layui-icon">&#xe635;</i>Preview</button>
                <button type="reset" class="layui-btn layui-btn-danger"><i class="layui-icon">&#xe640;</i>Reset</button>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>
        </div>

        <div class="layui-form-item layui-hide" id="preview_area">
            <label class="layui-form-label">Preview</label>
            <div class="layui-input-block ">
                <table class="layui-table" lay-even="" lay-skin="nob">
                    <colgroup>
                        <col width="150">
                        <col width="150">
                        <col width="200">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>Code File</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td style="color: #01AAED;" id="preview_file"></td>
                        <td style="color: #FFB800;">overwrite</td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>

    </form>
    <input type="hidden" id="nav_flag" value="controller" />
    <script>
        layui.use(['form','layer','laydate','table','laytpl'],function(){

            var form = layui.form,
                layer = parent.layer === undefined ? layui.layer : top.layer,
                $ = layui.jquery,
                laydate = layui.laydate,
                laytpl = layui.laytpl,
                table = layui.table;

            form.on('submit(controller_submit)', function(data){
                var load = layer.load();
                console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
                console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
                console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
                //layer.close(load);
                //return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });

            $("#Controller_Directory").keyup(function(){
                var obj = $(this);
                var Namespace = $("#Namespace");
                var NamespaceText = obj.val().replace('app', "App");
                NamespaceText = NamespaceText.replace(/\//g, "\\");
                NamespaceText = NamespaceText.replace(/(\\*$)/g,"");
                Namespace.text("namespace "+NamespaceText);
                $("#NamespaceVal").val("namespace "+NamespaceText);
            });

            /**
             * 预览
             */
            $("#Preview").click(function(){

                var Controller_Directory = $("#Controller_Directory").val();
                var Controller_Name = $("#Controller_Name").val();
                var Action_IDs = $("#Action_IDs").val();


                if(!Action_IDs || !Controller_Name || !Controller_Directory) {
                    layer.msg("请先完善Controller的信息");
                    return false;
                }

                Controller_Directory = Controller_Directory.replace(/(\/*$)/g,"");

                $("#preview_file").text(Controller_Directory +"/"+ Controller_Name+".php");
                $("#preview_area").removeClass('layui-hide');

            });


        });
    </script>
@stop