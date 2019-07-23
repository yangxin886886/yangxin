<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"D:\phpstudy\PHPTutorial\WWW/application/admin\view\activity\index.html";i:1563532810;s:77:"D:\phpstudy\PHPTutorial\WWW\application\admin\view\public\head_resources.html";i:1561965611;s:79:"D:\phpstudy\PHPTutorial\WWW\application\admin\view\public\bottom_resources.html";i:1563266818;}*/ ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/public/layuiadmin/layui/css/layui.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/admin.css" media="all">
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-card">
<!--      <div class="layui-form layui-card-header layuiadmin-card-header-auto">-->
<!--        <div class="layui-form-item">-->
<!--          <div class="layui-inline">-->
<!--            <label class="layui-form-label">文章ID</label>-->
<!--            <div class="layui-input-inline">-->
<!--              <input type="text" name="id" placeholder="请输入" autocomplete="off" class="layui-input">-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="layui-inline">-->
<!--            <label class="layui-form-label">作者</label>-->
<!--            <div class="layui-input-inline">-->
<!--              <input type="text" name="author" placeholder="请输入" autocomplete="off" class="layui-input">-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="layui-inline">-->
<!--            <label class="layui-form-label">标题</label>-->
<!--            <div class="layui-input-inline">-->
<!--              <input type="text" name="title" placeholder="请输入" autocomplete="off" class="layui-input">-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="layui-inline">-->
<!--            <label class="layui-form-label">文章标签</label>-->
<!--            <div class="layui-input-inline">-->
<!--              <select name="label">-->
<!--                <option value="">请选择标签</option>-->
<!--                <option value="0">美食</option>-->
<!--                <option value="1">新闻</option>-->
<!--                <option value="2">八卦</option>-->
<!--                <option value="3">体育</option>-->
<!--                <option value="4">音乐</option>-->
<!--              </select>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="layui-inline">-->
<!--            <button class="layui-btn layuiadmin-btn-list" lay-submit lay-filter="LAY-app-contlist-search">-->
<!--              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>-->
<!--            </button>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->

      <div class="layui-card-body">
<!--        <div style="padding-bottom: 10px;">-->
<!--          <button class="layui-btn layuiadmin-btn-list" data-type="batchdel">删除</button>-->
<!--          <button class="layui-btn layuiadmin-btn-list" data-type="add">添加</button>-->
<!--        </div>-->
        <table id="table" lay-filter="table"></table>
          <script type="text/html" id="fb_status">
              {{#  if(d.fb_status == 1){ }}
              <button class="layui-btn layui-btn-xs" lay-event="activityFb">已发布</button>
              {{#  } else { }}
              <button class="layui-btn layui-btn-primary layui-btn-xs" lay-event="activityFb">未发布</button>
              {{#  } }}
          </script>
        <script type="text/html" id="is_sq">
          {{#  if(d.is_sq == 1){ }}
            <button class="layui-btn layui-btn-xs" lay-event="activitySq">启用</button>
          {{#  } else { }}
            <button class="layui-btn layui-btn-primary layui-btn-xs" lay-event="activitySq">禁用</button>
          {{#  } }}
        </script>
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
  }).use(['index', 'contlist', 'table','form','admin'], function(){
    var table = layui.table
    ,form = layui.form
    ,admin = layui.admin
    
    //监听搜索
    form.on('submit(LAY-app-contlist-search)', function(data){
      var field = data.field;
      
      //执行重载
      table.reload('LAY-app-content-list', {
        where: field
      });
    });

    //第一个实例
    table.render({
      elem: '#table'
      ,height: 700
      ,url: "<?php echo url('Activity/getActivityList'); ?>" //数据接口
      ,page: true //开启分页
      ,cols: [[ //表头
        {field: 'id', title: 'ID', sort: true, fixed: 'left'}
        ,{field: 'name', title: '活动名称'}
        ,{field: 'cg_name', title: '场馆名称'}
        ,{field: 'a_start_time', title: '活动开始时间'}
        ,{field: 'a_end_time', title: '活动结束时间'}
        ,{field: 'x_start_time', title: '选座开始时间'}
        ,{field: 'x_end_time', title: '选座结束时间'}
        ,{field: '', title: '发布状态',templet:'#fb_status'}
        ,{field: '', title: '启用上墙',templet:'#is_sq'}
        ,{field: '', title: '操作',templet:'#table_curd',width:150}
      ]]
    });


    //监听工具条
    table.on('tool(table)', function(obj){
      var data = obj.data; //获得当前行数据
      var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）


      if(layEvent === 'detail'){ //查看
        //do somehing
      }

      else if(layEvent === 'activityFb'){ //发布或暂停发布

          var activityFb = "<?php echo url('Activity/activityFb'); ?>";
          admin.req({
              url:activityFb,
              data:{id:data.id,fb_status:data.fb_status},
              done: function (res) {
                  layer.msg('成功')
                  window.location.reload();
              }
          })
      }
      else if(layEvent === 'activitySq'){ //启用上墙
          var enable_sq = "<?php echo url('Activity/activitySq'); ?>";
          admin.req({
              url:enable_sq,
              data:{id:data.id,is_sq:data.is_sq},
              done: function (res) {
                  layer.msg('成功');
                  window.location.reload();
              }
          })
      }

      else if(layEvent === 'del'){ //删除
        var del_url = "<?php echo url('Activity/activityDel'); ?>";
        layer.confirm('真的删除行么', function(index){
          admin.req({
            url:del_url,
            data:{id:data.id},
            done: function (res) {
              layer.msg('成功')
            }
          })
        });
      }
      else if(layEvent === 'edit'){ //编辑
        layer.open({
          type: 2
          ,title: '编辑'
          ,content: "<?php echo url('Activity/activityEditView'); ?>?id="+data.id
          ,area: ['90%', '90%']
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

    
    var $ = layui.$, active = {
      batchdel: function(){
        var checkStatus = table.checkStatus('LAY-app-content-list')
        ,checkData = checkStatus.data; //得到选中的数据

        if(checkData.length === 0){
          return layer.msg('请选择数据');
        }
      
        layer.confirm('确定删除吗？', function(index) {
          
          //执行 Ajax 后重载
          /*
          admin.req({
            url: 'xxx'
            //,……
          });
          */
          table.reload('LAY-app-content-list');
          layer.msg('已删除');
        });
      },
      add: function(){
        layer.open({
          type: 2
          ,title: '添加文章'
          ,content: 'listform.html'
          ,maxmin: true
          ,area: ['550px', '550px']
          ,btn: ['确定', '取消']
          ,yes: function(index, layero){
            //点击确认触发 iframe 内容中的按钮提交
            var submit = layero.find('iframe').contents().find("#layuiadmin-app-form-submit");
            submit.click();
          }
        }); 
      }
    }; 

    $('.layui-btn.layuiadmin-btn-list').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });

  });
  </script>
</body>
</html>
