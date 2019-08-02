<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"D:\phpstudy\PHPTutorial\WWW\git/application/admin\view\activity\set_code.html";i:1564650815;s:81:"D:\phpstudy\PHPTutorial\WWW\git\application\admin\view\public\head_resources.html";i:1563868278;s:83:"D:\phpstudy\PHPTutorial\WWW\git\application\admin\view\public\bottom_resources.html";i:1563266818;}*/ ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/public/layuiadmin/layui/css/layui.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/admin.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/template.css" media="all">
    <style>
        .left{
            float: left;
            padding: 20px;
            background:#fff;
            width:90%;
            line-height: 40px;
        }
        .left input{
            width:50px;
        }
        .right{
            float: right;
            padding: 20px;
            background:#fff;
            width:40%;
        }
        .storey{
            display: -webkit-flex;
            display: flex;
            border-bottom: 1px solid rgb(128,128,128);
            flex-wrap: wrap;
        }
        .storey>div{
            padding: 8px;
            cursor: pointer;
        }
        .area{
            display: -webkit-flex;
            display: flex;
            flex-wrap: wrap;

        }
        .area>div{
            padding: 8px 15px;
            cursor: pointer;
            background: lightgreen;
        }

        .area_color{
            display: -webkit-flex;
            display: flex;
        }
        .pai{
            display: -webkit-flex;
            display: flex;

        }
        .pai>div{

        }
        .pai_seat{
            display: -webkit-flex;
            display: flex;
            flex-wrap: wrap;
        }
        .pai_seat>div{
            padding-right: 10px;
        }
        .r_table{
            margin-top:20px;
        }
        .r_tr{
            display: -webkit-flex;
            display: flex;
            margin-bottom: 5px;
        }
        .r_td{
            display: -webkit-flex;
            display: flex;
            justify-content:center;
            align-items: center;
            color:#fff;
            width:40px;
            height: 25px;
            background:gray;
            border-radius: 5px;
            margin-right:5px;
        }
        .pai_bh{
            margin-right:15px;
            height: 25px;
            display: -webkit-flex;
            display: flex;
            justify-content:center;
            align-items: center;

            color:blue;
        }
    </style>
</head>
<body>




<div class="layui-fluid layadmin-maillist-fluid ">
    <form   class="layui-form"   method="post" id="form1">
        <blockquote class="layui-elem-quote">设置验证码</blockquote>
        <div class="layui-inline">
            <label class="layui-form-label">请选择活动</label>
            <div class="layui-input-inline">
                <select name="activity_id" lay-filter="activity" lay-verify="required" lay-search="">
                    <option value="">请选择</option>
                    <?php if(is_array($activity) || $activity instanceof \think\Collection || $activity instanceof \think\Paginator): $i = 0; $__LIST__ = $activity;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                        <option value="<?php echo $vo['id']; ?>" ><?php echo $vo['name']; ?></option>

                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
    </form>


    <div class="layui-row layui-col-space15" style="margin-top:20px;">

        <div  class="layui-form" >
            <div class="left" >
                <div class="storey">
                </div>
                <div class="area">
                </div>


                <div class="r_table" id="r_table">

                </div>
                <!--                <div>-->
                <!--                    <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>-->
                <!--                </div>-->
            </div>
        </div>

    </div>

</div>


<script src="/public/layuiadmin/layui/layui.js"></script>
<script src="/public/layuiadmin/js/jquery-3.1.1.min.js"></script>

<script>
    var activity_id = 0; //当前活动id
    var venue_id  = 0; //当前场馆id
    var storey_id = 0;//当前楼层id
    var c_area = ''; //当前区域 例如A
    var is_equal = false;//每排座位是否相同
    var mpzws = 0; //每排的座位数
    var selected = 'rgb(0,255,0)';
    var no_selected = 'rgb(128,128,128)';
    layui.config({
        base: '/public/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index','form','admin'],function(){
        layer.msg('请先选择活动');

        var $ = layui.$
            ,form = layui.form
            ,admin = layui.admin;

        form.on('submit(*)',function(data){

        })


        var aIdGetStoreyUrl = "<?php echo url('Seat/aIdGetStorey'); ?>";
        form.on('select(activity)', function(data){

            layer.load();
            activity_id = data.value; //修改当前场馆id
            admin.req({
                    url:aIdGetStoreyUrl,
                    data:{'activity_id':activity_id},
                    done:function (res) {
                        console.log(res.data);
                        addStorey(res.data.storey);
                        venue_id = res.data.venue_id;
                        $('.venue').html(res.data.venue_name);

                    }
                }
            )
            layer.closeAll('loading');

        });

        //向dom添加楼层
        function addStorey(data) {
            $('.storey').html('');
            var box =  '';
            data.forEach(function(item,index){
                if(item.pai_number > 0){
                    box +=  '<div tabindex="1" data-type="'+item.type +'" onclick="getArea(this)" data-id="' +item.id+ '">' + item.type + '楼</div>';
                }
            })
            $('.storey').append(box);
        }

    });

    var area = null;  //楼层对应的区域例如：['A','B']
    function getArea(obj) {
        storey_id = $(obj).attr('data-id');
        var getAreaUrl = "<?php echo url('Seat/getAreaList'); ?>";
        var data = {
            storey_id:$(obj).attr('data-id'),
            venue_id:venue_id,
            type:$(obj).attr('data-type')
        };

        $.post(getAreaUrl,data,function(res){
            var res= JSON.parse(res);
            $('.area').html('');  //清空
            area = res.data;
            console.log(res.data);
            addArea(res.data)
        });

    }
    function addArea(data) {
        var box = '';
        data.forEach(function(item,index){
            box +=   '<div data-area="'+ item +'" tabindex="1" onclick="getSeat(this)">'+ item +'</div>';
        })
        $('.area').append(box);
    }

    //点击区域
    function getSeat(obj) {
        layer.load();

        layer.closeAll('loading');
    }



</script>
</body>
</html>