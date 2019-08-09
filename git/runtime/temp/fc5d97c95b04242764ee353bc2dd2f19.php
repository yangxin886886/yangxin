<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"D:\phpstudy\PHPTutorial\wwww\git/application/admin\view\seat\reserve_view.html";i:1564823195;s:82:"D:\phpstudy\PHPTutorial\wwww\git\application\admin\view\public\head_resources.html";i:1563868278;s:84:"D:\phpstudy\PHPTutorial\wwww\git\application\admin\view\public\bottom_resources.html";i:1563266818;}*/ ?>


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
        .set_vip_area{
            display: -webkit-flex;
            display: flex;
        }
        .set_vip_area>div{
           margin-top:15px;
           margin-right:15px;
        }
        .vip_count{
            display: -webkit-flex;
            display: flex;
        }
    </style>
</head>
<body>




<div class="layui-fluid layadmin-maillist-fluid ">
    <form   class="layui-form"   method="post" id="form1">
        <blockquote class="layui-elem-quote">预留座位和验证码</blockquote>
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
        <div style="margin-left:25px">场馆:<span class="venue"></span></div>
        <div   >
            <div class="left" >
                <div class="storey">
                </div>
                <div class="area">
                </div>

                <div>座位：点击座位即可预留--绿色代表预留的座位</div>
                <div class="r_table" id="r_table">
                </div>
                <div class="reserve">当前预留座位：</div>

                <div class="set_vip_area layui-form" >
                    <div class="layui-form-item">
                        <label class="layui-form-label">当前区域是否为VIP区域</label>
                        <div class="layui-input-block" onclick="setVipArea(this)" id="is_vip">

                        </div>
                    </div>
                    <input type="hidden" value="2" name="level">
                    <div  class="vip_weishu">
                        <input type="radio" name="vweishu" value="4" title="4位数" data-val="4">
                        <input type="radio" name="vweishu" value="5" title="5位数" data-val="5">
                        <input type="radio" name="vweishu" value="6" title="6位数" data-val="6">
                    </div>

                    <div class="vip_count">
                        <div><input type="text" class="layui-input" name="code_count" id="vip_code_count"></div><div>验证码总数量</div>
                    </div>
                    <div><button class="layui-btn" lay-submit lay-filter="*">提交</button></div>
                </div>


                <div class="set_vip_area layui-form" >
                    <div class="layui-form-item">
                        <label class="layui-form-label">普通用户验证码</label>
                    </div>
                    <input type="hidden" value="1" name="level">
                    <div class="weishu">
                        <input type="radio" name="weishu" value="4" title="4位数">
                        <input type="radio" name="weishu" value="5" title="5位数">
                        <input type="radio" name="weishu" value="6" title="6位数">
                    </div>
                    <div class="vip_count">
                        <div><input type="text" class="layui-input" name="code_count" id="code_count"></div><div>验证码总数量</div>
                    </div>
                    <div><button class="layui-btn" lay-submit lay-filter="*">提交</button></div>
                </div>
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
            var obj = data.field;
            obj.activity_id = activity_id;
            admin.req({
                url:"<?php echo url('Seat/setActivityCode'); ?>",
                data:obj,
                done:function(res){
                    layer.msg('成功')
                }
            });
        })


        var aIdGetStoreyUrl = "<?php echo url('Seat/aIdGetStorey'); ?>";
        form.on('select(activity)', function(data){
            console.log('-----');
            console.log($('.vip_weishu input'));
            console.log('-----');
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
            });
            //获取VIP区域验证码信息
            admin.req({
                url:"<?php echo url('Seat/getActivityCode'); ?>",
                data:{'activity_id':activity_id,level:2},
                done:function (res) {
                    if(res.data.code_count != 0){
                        $('#vip_code_count').val(res.data.code_count);
                    }
                    if(res.data.weishu && res.data.weishu != null ){
                        var weishu = res.data.weishu;
                        $('.vip_weishu').append('<span>当前位数：'+ weishu +'</span>');
                        // var vip_weishu = $('.vip_weishu input');
                        // vip_weishu.each(function(){
                        //     // var val = $(this).val();
                        //     if(weishu == val){
                        //
                        //     }
                        // })
                    }
                }
            })

            //获取普通区域对应的验证码
            admin.req({
                url:"<?php echo url('Seat/getActivityCode'); ?>",
                data:{'activity_id':activity_id,level:1},
                done:function (res) {


                    if(res.data.code_count != 0){
                        $('#code_count').val(res.data.code_count);
                    }
                    if(res.data.weishu && res.data.weishu != null ){
                        var weishu = res.data.weishu;
                        $('.weishu').append('<span>当前位数：'+ weishu +'</span>');
                    }
                }
            })
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
        $('.r_table').html('');
        c_area = $(obj).attr('data-area');

        var getAreaColorPaiUrl = "<?php echo url('Seat/getAreaColorPai'); ?>";
        var data = {
            activity_id:activity_id,
            venue_id:venue_id,
            storey_id:storey_id,
            area:c_area
        };
        $.post(getAreaColorPaiUrl,data,function(res){
            $('.r_table').html('');
            var res= JSON.parse(res);
            console.log(res.data);
            var pai_seat = res.data.pai_seat; //pai_seat:[1,3]代表1排有1个座位 2排有3个座位
            if(res.code == 0){
                var box = '';
                if(!pai_seat){
                    return false;
                }
                var p_jishu = 1;//座位从1开始计数
                pai_seat.forEach(function (item,index) {
                    if(item){
                        index++; //排号
                        box += '<div class="r_tr">';
                        box += '<div class="pai_bh">第'+ index +'排</div>'
                        for(var i=1;i<=parseInt(item);i++){
                            box += '<div class="r_td"   onclick="setReserveSeat(this)" data-pai="'+ index +'" data-selected="0"  data-seat-num="'+ p_jishu +'">'+ p_jishu +'</div>';
                            p_jishu++;//座位号
                        }
                        box += '</div>';
                    }
                })
                $('.r_table').append(box);

                //显示预留座位
                if(res.data.reserve.length > 0){
                    res.data.reserve.forEach(function(item,index){
                        $('[data-seat-num='+ item.seat_num+']').css('background',selected);
                        $('[data-seat-num='+ item.seat_num+']').attr('data-selected','1');
                    });
                }
            }
        });

        //当前区域是否是vip区域
        var is_vip_url = "<?php echo url('Seat/isVip'); ?>";
        var data = {activity_id:activity_id,area:c_area};
        $.post(is_vip_url,data,function(res){
            var res= JSON.parse(res);
            $('#is_vip').html('');
            console.log(res);
            if(res.data.is_vip == 1){
                var box = '<button class="layui-btn" id="is_vip_area" data-status="1"  name="open">是</button>';
                $('#is_vip').append(box);
            }else{
                var box = '<button class="layui-btn" id="is_vip_area" data-status="0" name="open">否</button>';
                $('#is_vip').append(box);
            }
        });



        layer.closeAll('loading');
    }
    
    function setReserveSeat(obj) {
        var pai = $(obj).attr('data-pai'); //排
        var seat_num = $(obj).attr('data-seat-num'); //座位号
        var curr_sel = $(obj).attr('data-selected');
        if(curr_sel == 0){
            $(obj).css('background',selected);
            $(obj).attr('data-selected','1');
        }
        else if(curr_sel == 1){
            $(obj).css('background',no_selected);
            $(obj).attr('data-selected','0');
        }

        $.post(
            "<?php echo url('Seat/reserveSeat'); ?>",
            {
                activity_id:activity_id,
                venue_id:venue_id,
                area:c_area,
                pai: pai,
                seat_num:seat_num
            },
            function(res){
                var res= JSON.parse(res);
                //成功
                if(res.code == 0){
                    layer.msg('成功');
                }else{
                    layer.msg('失败');
                }
            });
    }


    //设置VIP区域
    function setVipArea(obj){

        $.post(
            "<?php echo url('Seat/setVipArea'); ?>",
            {
                activity_id:activity_id,
                area:c_area
            },
            function(res){
                var status =   $('#is_vip_area').attr('data-status');
                var res= JSON.parse(res);
                //成功
                if(res.code == 0){
                    layer.msg('成功');
                    if(status == 1){
                        $('#is_vip').html('');
                        var box = '<button class="layui-btn" id="is_vip_area" data-status="0"  name="open">否</button>';
                        $('#is_vip').append(box);
                    }
                    if(status == 0){
                        $('#is_vip').html('');
                        var box = '<button class="layui-btn" id="is_vip_area" data-status="1"  name="open">是</button>';
                        $('#is_vip').append(box);
                    }
                }else{
                    layer.msg('失败');
                }
            });
    }

</script>
</body>
</html>