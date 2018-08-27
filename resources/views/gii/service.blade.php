@extends('layouts._gii')
@section('content')
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
            <li class="layui-this"><i class="layui-icon">&#xe62e;</i> Service Generator</li>
        </ul>
    </div>
    <form class="layui-form" action="/gii/generatorService" method="post">

        <div class="layui-form-item">
            <label class="layui-form-label">Model Class</label>
            <div class="layui-input-block">
                <select name="Model_Class" id="Model_Class" lay-filter="Model_Class" lay-verify="required" lay-search="">
                    <option value="">直接选择或搜索选择</option>
                    @foreach ($models as $modelsClass)
                        <option value="{{$modelsClass}}">{{$modelsClass}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">Service Directory</label>
            <div class="layui-input-block">
                <input type="text" id="Service_Directory" name="Service_Directory" lay-verify="required" autocomplete="off" placeholder="请输入Service Directory" value="app/Service/" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">Service Name</label>
            <div class="layui-input-block">
                <input type="text" name="Service_Name" id="Service_Name" lay-verify="required" autocomplete="off" placeholder="请输入Service Name " class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">Namespace</label>
            <div class="layui-input-block ">
                <blockquote class="layui-elem-quote" style="color: #FF5722" id="Namespace">namespace App\Service</blockquote>
                <input type="hidden" name="NamespaceVal" id="NamespaceVal" value="namespace App\Service" >
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">Default</label>
                <div class="layui-input-inline">
                    <input type="checkbox" lay-filter='defaultop' lay-verify="required" name="Generate_Abstract_Service" title="Generate Abstract Service " checked>
                    <input type="hidden" name="AbstractPath" id="AbstractPath" value="">
                </div>

                <label class="layui-form-label"> </label>
                <div class="layui-input-inline">
                    <input type="checkbox" lay-filter='defaultop' name="Generate_Interface_Service" title="Generate Interface Service" >
                    <input type="hidden" name="InterfacePath" id="InterfacePath" value="">
                </div>

                <label class="layui-form-label"> </label>
                <div class="layui-input-inline">
                    <input type="checkbox" lay-filter='defaultop' name="Generate_Query_Service"  title="Generate Query Service">
                    <input type="hidden" name="QueryPath" id="QueryPath" value="">
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label"></label>
                <div class="layui-input-inline">
                    <input type="checkbox" lay-filter='defaultop' name="Generate_CRUD" checked title="Generate CRUD" >
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="service_submit"><i class="layui-icon">&#x1005;</i>Generator</button>
                <button type="button" class="layui-btn layui-btn-normal" id="Preview"><i class="layui-icon">&#xe635;</i>Preview</button>
                <button type="reset" class="layui-btn layui-btn-danger"><i class="layui-icon">&#xe640;</i>Reset</button>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>
        </div>

        <div class="layui-form-item layui-hide " id="preview_area">
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
                    <tbody id="preview_item">
                    </tbody>
                </table>

            </div>
        </div>

    </form>
    <input type="hidden" id="nav_flag" value="service" />
    <script>
        layui.use(['form','layer','laydate','table','laytpl'],function(){
            var form = layui.form,
                layer = parent.layer === undefined ? layui.layer : top.layer,
                $ = layui.jquery,
                laydate = layui.laydate,
                laytpl = layui.laytpl,
                table = layui.table;


            $("#Service_Directory").keyup(function(){
                var obj = $(this);
                var Namespace = $("#Namespace");
                var NamespaceText = obj.val().replace('app', "App");
                NamespaceText = NamespaceText.replace(/\//g, "\\");
                NamespaceText = NamespaceText.replace(/(\\*$)/g,"");
                Namespace.text("namespace "+NamespaceText);
                $("#NamespaceVal").val("namespace "+NamespaceText);
            });

            form.on('select(Model_Class)', function(data){
                var Service_Name = '';
                Service_Name = data.value.replace('App\\Model\\','');
                Service_Name = Service_Name.replace('Model','Service');
                $("#Service_Name").val(Service_Name);

            });

            form.on('submit(service_submit)', function(data){
                var load = layer.load();
                if(!data.field.Generate_Abstract_Service) {
                    layer.msg("Generate_Abstract_Service 必选");
                    layer.close(load);
                    return false;
                }
                $("#Preview").click();
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

                var Model_Class = $("#Model_Class").val();
                var Service_Directory = $("#Service_Directory").val();
                var Service_Name = $("#Service_Name").val();

                if(!Model_Class || !Service_Directory || !Service_Name) {
                    layer.msg("请先完善Service的信息");
                    return false;
                }
                var preview_item = $("#preview_item");
                preview_item.children().remove();
                var file_path = Service_Directory + Service_Name+'.php';

                var preview_item_content = '<tr>' +
                    '<td style="color: #01AAED;">'+file_path+'</td>' +
                    '<td style="color: #FFB800;">overwrite</td>' +
                    '</tr>';
                preview_item.append(preview_item_content);

                var preview_Service_Name = Service_Name.replace('Service','');
                $(".layui-unselect.layui-form-checkbox.layui-form-checked").find('span').each(function(e){
                    var checkOp = $(this);
                    var fileType = '';
                    switch (checkOp.text()){
                        case 'Generate Abstract Service ' :
                            file_path = Service_Directory + '/' + preview_Service_Name+'AbstractService.php';
                            fileType  = 'Abstract';
                            break;
                        case 'Generate Interface Service' :
                            file_path = Service_Directory + '/' + preview_Service_Name+'InterfaceService.php';
                            fileType  = 'Interface';
                            break;
                        case 'Generate Query Service' :
                            file_path = Service_Directory + '/' + preview_Service_Name+'QueryService.php';
                            fileType  = 'Query';
                            break;
                    }

                    if(checkOp.text() != 'Generate CRUD'){
                         preview_item_content = '<tr>' +
                            '<td style="color: #01AAED;">'+file_path+'></td>' +
                            '<td style="color: #FFB800;">overwrite</td>' +
                            '</tr>';
                         $("#"+fileType+"Path").val(file_path);
                        preview_item.append(preview_item_content);
                    }

                });

                $("#preview_area").removeClass('layui-hide');

            });


        });
    </script>
@stop