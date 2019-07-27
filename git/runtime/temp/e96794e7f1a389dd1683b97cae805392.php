<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:70:"D:\phpstudy\PHPTutorial\WWW\git/application/admin\view\menu\index.html";i:1562832065;s:81:"D:\phpstudy\PHPTutorial\WWW\git\application\admin\view\public\head_resources.html";i:1563868278;s:83:"D:\phpstudy\PHPTutorial\WWW\git\application\admin\view\public\bottom_resources.html";i:1563266818;s:78:"D:\phpstudy\PHPTutorial\WWW\git\application\admin\view\modules\menu\index.html";i:1562836669;}*/ ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>后台管理员</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/public/layuiadmin/layui/css/layui.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/admin.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/template.css" media="all">
</head>
<body>

  <div class="layui-fluid">   
    <div class="layui-card">
      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
          <button class="layui-btn layuiadmin-btn-admin" data-type="add">添加</button>
        </div>

        <table id="menuIndex" lay-filter="menuIndex"></table>

        <script type="text/html" id="table_curd">
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
          <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
        </script>
      </div>
    </div>
  </div>

  <script src="/public/layuiadmin/layui/layui.js"></script>
<script src="/public/layuiadmin/js/jquery-3.1.1.min.js"></script>

  <script>
layui.config({
    base: '/public/layuiadmin/' //静态资源所在路径
}).extend({
    index: 'lib/index' //主入口模块
}).use(['index', 'useradmin', 'table'], function(){
    var $ = layui.$
        ,form = layui.form
        ,table = layui.table
        ,admin = layui.admin;

    var data_url = "<?php echo url('Menu/getMenuList'); ?>";
    table.render({
        elem: '#menuIndex'
        ,height:500
        ,url: data_url //数据接口
        ,page: true //开启分页
        ,cols: [[ //表头
            {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left'}
            ,{field: 'fid', title: 'fid', width:80}
            ,{field: 'level', title: '等级', width:80, sort: true}
            ,{field: 'name', title: '菜单名称', width:160}
            ,{field: 'ctl', title: '控制器', width: 177}
            ,{field: 'act', title: '动作', width: 80, sort: true}
            ,{field: 'sort', title: '排序', width: 135, sort: true}
            ,{ title: '操作',  sort: true, templet: '#table_curd'}
        ]]
    });

    //监听工具条
    table.on('tool(menuIndex)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var tr = obj.tr; //获得当前行 tr 的DOM对象

        if(layEvent === 'detail'){ //查看
            //do somehing
        } else if(layEvent === 'del'){ //删除
            var del_url = "<?php echo url('Menu/menuDel'); ?>";
            layer.confirm('真的删除行么', function(index){
                admin.req({
                    url:del_url,
                    data:{id:data.id},
                    done: function (res) {
                        layer.msg('成功')
                    }
                })
            });
        } else if(layEvent === 'edit'){ //编辑
            layer.open({
                type: 2
                ,title: '编辑'
                ,content: "<?php echo url('Menu/menuEditView'); ?>?id="+data.id
                ,area: ['550px', '550px']
                ,btn: ['确定', '取消']
                ,yes: function(index, layero){
                    var iframeWindow = window['layui-layer-iframe'+ index]
                        ,submitID = 'LAY-user-back-submit'
                        ,submit = layero.find('iframe').contents().find('#'+ submitID);

                    //监听提交
                    iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
                        var field = data.field; //获取提交的字段

                        //提交 Ajax 成功后，静态更新表格中的数据
                        //$.ajax({});
                        table.reload('LAY-user-front-submit'); //数据刷新
                        layer.close(index); //关闭弹层
                    });

                    submit.trigger('click');
                }
            });

        }
    });

    //监听搜索
    form.on('submit(LAY-user-back-search)', function(data){
        var field = data.field;

        //执行重载
        table.reload('LAY-user-back-manage', {
            where: field
        });
    });

    //事件
    var active = {
        edit: function(){
            alert(1);
            var checkStatus = table.checkStatus('LAY-user-back-manage')
                ,checkData = checkStatus.data; //得到选中的数据
            console.log(checkData);
        },
        batchdel: function(){
            var checkStatus = table.checkStatus('LAY-user-back-manage')
                ,checkData = checkStatus.data; //得到选中的数据

            if(checkData.length === 0){
                return layer.msg('请选择数据');
            }

            layer.prompt({
                formType: 1
                ,title: '敏感操作，请验证口令'
            }, function(value, index){
                layer.close(index);

                layer.confirm('确定删除吗？', function(index) {

                    //执行 Ajax 后重载
                    /*
                    admin.req({
                      url: 'xxx'
                      //,……
                    });
                    */
                    table.reload('LAY-user-back-manage');
                    layer.msg('已删除');
                });
            });
        }
        ,add: function(){
            layer.open({
                type: 2
                ,title: '添加'
                ,content: "<?php echo url('Menu/menuAddView'); ?>"
                ,area: ['550px', '550px']
                ,btn: ['确定', '取消']
                ,yes: function(index, layero){
                    var iframeWindow = window['layui-layer-iframe'+ index]
                        ,submitID = 'LAY-user-back-submit'
                        ,submit = layero.find('iframe').contents().find('#'+ submitID);

                    //监听提交
                    iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
                        var field = data.field; //获取提交的字段

                        //提交 Ajax 成功后，静态更新表格中的数据
                        //$.ajax({});
                        table.reload('LAY-user-front-submit'); //数据刷新
                        layer.close(index); //关闭弹层
                    });

                    submit.trigger('click');
                }
            });
        }
    }
    $('.layui-btn.layuiadmin-btn-admin').on('click', function(){
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });
});
</script>
</body>
</html>
