@extends('layouts._gii')
@section('content')
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
            <li class="layui-this"><i class="layui-icon">&#xe609;</i> Model Generator</li>
        </ul>
    </div>
    <form class="layui-form" action="/gii/generatorModel" method="post">

        <div class="layui-form-item">
            <label class="layui-form-label">DB Database</label>
            <div class="layui-input-block">
                <blockquote class="layui-elem-quote">@php echo env('DB_HOST', 'forge')."@".env('DB_DATABASE', 'forge'); @endphp</blockquote>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">DB Prefix</label>
            <div class="layui-input-block">
                <blockquote class="layui-elem-quote" id="DB_PREFIX">@php echo env('DB_PREFIX', 'null');@endphp</blockquote>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">Table Name</label>
            <div class="layui-input-block">
                <select name="table_name" id="table_name" lay-verify="required" lay-search="" lay-filter="table_name">
                    <option value="">直接选择或搜索选择</option>
                    @foreach ($tables as $tableName)
                        <option value="{{$tableName}}">{{$tableName}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">Model Name</label>
            <div class="layui-input-block">
                <input type="text" name="model_name" id="model_name" lay-verify="title" autocomplete="off" placeholder="请输入模型名" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">Namespace</label>
            <div class="layui-input-block ">
                <blockquote class="layui-elem-quote" style="color: #FF5722">namespace App\Model</blockquote>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">Default</label>
                <div class="layui-input-inline">
                    <input type="checkbox" name="Generate_GetAttribute" title="Generate GetAttribute( )" checked>
                </div>
            </div>

            <div class="layui-inline">
                <label class="layui-form-label"></label>
                <div class="layui-input-inline">
                    <input type="checkbox" name="Close_timestamps" title="Close timestamps" checked>
                </div>
            </div>

        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="model_submit"><i class="layui-icon">&#x1005;</i>Generator</button>
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
                        <td style="color: #01AAED;" id="preview_file">app/Model/</td>
                        <td style="color: #FFB800;">overwrite</td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>

    </form>
    <input type="hidden" id="nav_flag" value="model" />
    <script>
        layui.use(['form','layer','laydate','table','laytpl'],function(){
            var form = layui.form,
                layer = parent.layer === undefined ? layui.layer : top.layer,
                $ = layui.jquery,
                laydate = layui.laydate,
                laytpl = layui.laytpl,
                table = layui.table;

            form.on('select(table_name)', function(data){
                //console.log(data.elem); //得到select原始DOM对象
                //console.log(data.value); //得到被选中的值
                var selectVal = data.value.split('_');
                console.log(selectVal.length);
                var modelName = '';

                selectVal.forEach(function(k,e) {
                    if($("#DB_PREFIX").text() =='null'){
                        modelName += k.substring(0,1).toUpperCase()+k.substring(1);
                    }else{
                        if(e > 0)
                            modelName += k.substring(0,1).toUpperCase()+k.substring(1);
                    }

                })
                $("#model_name").val(modelName+'Model');


  //
    //
                //console.log(data.othis); //得到美化后的DOM对象
            });

            /**
             * 提交
             * */

            form.on('submit(model_submit)', function(data){
                var load = layer.load();
                console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
                console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
                console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
                //layer.close(load);
                //return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });

            /**
             * 预览
             */
            $("#Preview").click(function(){

                var model_name = $("#model_name").val();
                var table_name = $("#table_name").val();


                if(!model_name || !table_name) {
                    layer.msg("请输入模型名及表名");
                    return false;
                }

                $("#preview_file").text("app/Model/"+model_name+".php");
                $("#preview_area").removeClass('layui-hide');

            });

        });
    </script>
@stop