<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>首页--layui后台管理模板 2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/admin/css/public.css" media="all" />
</head>

<body class="childrenBody">
<blockquote class="layui-elem-quote layui-bg-green">
    <div id="nowTime"></div>
</blockquote>
<div class="layui-row layui-col-space10 panel_box">
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;" data-url="/admins/post/create" target="_blank">
            <div class="panel_icon layui-bg-green">
                <i class="layui-anim layui-icon" data-icon="&#xe6b2;">&#xe6b2;</i>
            </div>
            <div class="panel_word">
                <span>发布文章</span>
            </div>
        </a>
    </div>

    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;" data-url="/gii" target="_blank">
            <div class="panel_icon layui-bg-cyan">
                <i class="layui-anim layui-icon" data-icon="&#xe857;">&#xe857;</i>
            </div>
            <div class="panel_word outIcons">
                <span>GII</span>
            </div>
        </a>
    </div>
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;" data-url="/admins/share" target="_blank">
            <div class="panel_icon layui-bg-orange">
                <i class="layui-anim layui-icon" data-icon="&#xe641;">&#xe641;</i>
            </div>
            <div class="panel_word userAll">
                <span>资源分享</span>
            </div>
        </a>
    </div>
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;" data-url="/admins/webnav" target="_blank" >
            <div class="panel_icon layui-bg-blue">
                <i class="layui-anim layui-icon" data-icon="&#xe609;">&#xe609;</i>
            </div>
            <div class="panel_word">
                <span>网址导航</span>
            </div>
        </a>
    </div>
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;" data-url="https://github.com/lihu6491" target="_blank">
            <div class="panel_icon layui-bg-black">
                <i class="layui-anim seraph icon-github"></i>
            </div>
            <div class="panel_word">
                <span>Git</span>
            </div>
        </a>
    </div>
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;" data-url="" target="_blank">
            <div class="panel_icon layui-bg-red">
                <i class="layui-anim layui-icon" data-icon="&#xe60e;">&#xe60e;</i>
            </div>
            <div class="panel_word">
                <span>系统日志</span>
            </div>
        </a>
    </div>

</div>

<a  href = "mailto:649136262@qq.com">发邮件接口</a>
<a href="tencent://message/?uin=1187276773&Site=&Menu=yes">QQ会话接口</a>

<div id="ECharts_main" style="height:400px;"></div>
<br/>

<div id="ECharts_default" style="height:400px;"></div>
<br/>

<div class="layui-row layui-col-space10">
    <div class="layui-col-lg6 layui-col-md12">
        <blockquote class="layui-elem-quote title">最新文章 <i class="layui-icon layui-red">&#xe756;</i></blockquote>
        <table class="layui-table mag0" lay-skin="line">
            <colgroup>
                <col>
                <col width="110">
            </colgroup>
            <tbody class="hot_news"></tbody>
        </table>
        <blockquote class="layui-elem-quote title">系统基本参数</blockquote>
        <table class="layui-table magt0">
            <colgroup>
                <col width="150">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <td>当前版本</td>
                <td class="version"></td>
            </tr>
            <tr>
                <td>开发作者</td>
                <td class="author"></td>
            </tr>
            <tr>
                <td>网站首页</td>
                <td class="homePage"></td>
            </tr>
            <tr>
                <td>服务器环境</td>
                <td class="server"></td>
            </tr>
            <tr>
                <td>数据库版本</td>
                <td class="dataBase"></td>
            </tr>
            <tr>
                <td>最大上传限制</td>
                <td class="maxUpload"></td>
            </tr>
            <tr>
                <td>当前用户权限</td>
                <td class="userRights"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="layui-col-lg6 layui-col-md12">
        <blockquote class="layui-elem-quote title">待办事项</blockquote>
        <div class="layui-elem-quote layui-quote-nm history_box magb0">
            <ul class="layui-timeline">

                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis">&#xe756;</i>
                    <div class="layui-timeline-content layui-text">
                        <h3 class="layui-inline">
                            QQ登陆，微信登陆，微博登陆
                        </h3>
                    </div>
                </li>

                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis">&#xe756;</i>
                    <div class="layui-timeline-content layui-text">
                        <h3 class="layui-inline">
                            前端用户管理
                        </h3>
                    </div>
                </li>

                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis">&#xe756;</i>
                    <div class="layui-timeline-content layui-text">
                        <h3 class="layui-inline">
                            资源管理
                        </h3>
                    </div>
                </li>

                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis">&#xe756;</i>
                    <div class="layui-timeline-content layui-text">
                        <h3 class="layui-inline">
                        文章检索 + 文章统计
                        </h3>
                    </div>
                </li>

                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis">&#xe756;</i>
                    <div class="layui-timeline-content layui-text">
                        <h3 class="layui-inline">
                            系统日志
                        </h3>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>

<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/admin/js/main.js"></script>
<script type="text/javascript" src="/echarts/echarts.js"></script>
<script type="text/javascript">

    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('ECharts_main'));

    // 指定图表的配置项和数据
    var option = {
        title : {
            text: '文章统计',
            subtext: '共计「100」篇文章',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            x : 'center',
            y : 'bottom',
            data:['基础','案例','框架','工具','其他']
        },
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : {
                    show: true,
                    type: ['pie', 'funnel']
                },
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        series : [
            {
                name:'半径模式',
                type:'pie',
                radius : [20, 110],
                center : ['25%', '50%'],
                roseType : 'radius',
                label: {
                    normal: {
                        show: false
                    },
                    emphasis: {
                        show: true
                    }
                },
                lableLine: {
                    normal: {
                        show: false
                    },
                    emphasis: {
                        show: true
                    }
                },
                data:[
                    {value:10, name:'基础'},
                    {value:25, name:'案例'},
                    {value:15, name:'框架'},
                    {value:25, name:'工具'},
                    {value:20, name:'其他'},
                ]
            },
            {
                name:'面积模式',
                type:'pie',
                radius : [30, 110],
                center : ['75%', '50%'],
                roseType : 'area',
                data:[
                    {value:10, name:'基础'},
                    {value:25, name:'案例'},
                    {value:15, name:'框架'},
                    {value:25, name:'工具'},
                    {value:20, name:'其他'},
                ]
            }
        ]
    };


    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);



    var defaultChart = echarts.init(document.getElementById('ECharts_default'));



    var default_option = {
        title : {
            text: '访问统计',
            subtext: '',
            x:'center'
        },
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        legend: {
            x : 'center',
            y : 'bottom',
            data:['访问','阅读','点赞','评论','下载']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '10%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                data : ['周一','周二','周三','周四','周五','周六','周日']
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'访问',
                type:'bar',
                data:[320, 332, 301, 334, 1500, 330, 320],
                markLine : {
                    lineStyle: {
                        normal: {
                            type: 'dashed'
                        }
                    },
                    data : [
                        [{type : 'min'}, {type : 'max'}]
                    ]
                }
            },
            {
                name:'阅读',
                type:'bar',
                stack: '广告',
                data:[120, 132, 101, 134, 90, 230, 210]
            },
            {
                name:'点赞',
                type:'bar',
                stack: '广告',
                data:[220, 182, 191, 234, 290, 330, 310]
            },
            {
                name:'评论',
                type:'bar',
                stack: '广告',
                data:[150, 232, 201, 154, 190, 330, 410]
            },
            {
                name:'下载',
                type:'bar',
                stack: '广告',
                data:[222, 232, 201, 154, 190, 330, 410]
            },

        ]
    };


    defaultChart.setOption(default_option);

</script>

</body>
</html>