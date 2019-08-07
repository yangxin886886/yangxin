<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"D:\phpstudy\PHPTutorial\WWW\git/application/admin\view\user\index.html";i:1565063830;s:81:"D:\phpstudy\PHPTutorial\WWW\git\application\admin\view\public\head_resources.html";i:1563868278;s:83:"D:\phpstudy\PHPTutorial\WWW\git\application\admin\view\public\bottom_resources.html";i:1563266818;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>登入</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/public/layuiadmin/layui/css/layui.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/admin.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/template.css" media="all">
  <link rel="stylesheet" href="/public/layuiadmin/style/login.css" media="all">
</head>
<body>

  <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main">
      <div class="layadmin-user-login-box layadmin-user-login-header">
        <h2>后台管理系统</h2>
<!--        <p>layui 官方出品的单页面后台管理模板系统</p>-->
      </div>
      <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-cellphone" for="phone"></label>
          <input type="text" name="phone"  id="phone" lay-verify="required" placeholder="手机号" class="layui-input">
        </div>
          <input type="hidden" name="type" value="1">
          <div class="layui-form-item">
              <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-password"></label>
              <input type="text" name="phoneCode"   placeholder="验证码" class="layui-input">
              <div class="layui-input-inline">
                  <button class="layui-btn layui-btn-warm" onclick="getPhoneCode()">获取验证码</button>
              </div>
          </div>
        <div class="layui-form-item">
<!--          <div class="layui-row">-->
<!--            <div class="layui-col-xs7">-->
<!--              <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>-->
<!--              <input type="text" name="code" id="LAY-user-login-vercode" lay-verify="required" placeholder="图形验证码" class="layui-input">-->
<!--            </div>-->
<!--            <div class="layui-col-xs5">-->
<!--              <div style="margin-left: 10px;">-->
<!--                <img src="<?php echo url('User/getEntry'); ?>"  onclick="this.src='<?php echo url('User/getEntry'); ?>'" id="code" class="layadmin-user-login-codeimg" >-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
        </div>
<!--        <div class="layui-form-item" style="margin-bottom: 20px;">-->
<!--          <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">-->
<!--          <a href="forget.html" class="layadmin-user-jump-change layadmin-link" style="margin-top: 7px;">忘记密码？</a>-->
<!--        </div>-->
        <div class="layui-form-item">
          <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 入</button>
        </div>

        <div class="layui-form-item">
          <button class="layui-btn layui-btn-fluid" onclick="register()">去注册</button>
        </div>
<!--        <div class="layui-trans layui-form-item layadmin-user-login-other">-->
<!--          <label>社交账号登入</label>-->
<!--          <a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>-->
<!--          <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>-->
<!--          <a href="javascript:;"><i class="layui-icon layui-icon-login-weibo"></i></a>-->
<!--          -->
<!--          <a href="reg.html" class="layadmin-user-jump-change layadmin-link">注册帐号</a>-->
<!--        </div>-->
      </div>
    </div>
    

    
    <!--<div class="ladmin-user-login-theme">
      <script type="text/html" template>
        <ul>
          <li data-theme=""><img src="{{ layui.setter.base }}style/res/bg-none.jpg"></li>
          <li data-theme="#03152A" style="background-color: #03152A;"></li>
          <li data-theme="#2E241B" style="background-color: #2E241B;"></li>
          <li data-theme="#50314F" style="background-color: #50314F;"></li>
          <li data-theme="#344058" style="background-color: #344058;"></li>
          <li data-theme="#20222A" style="background-color: #20222A;"></li>
        </ul>
      </script>
    </div>-->
    
  </div>

  <script src="/public/layuiadmin/layui/layui.js"></script>
<script src="/public/layuiadmin/js/jquery-3.1.1.min.js"></script>

  <script>
  layui.config({
    base: '/public/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'user'], function(){
    var $ = layui.$
    ,setter = layui.setter
    ,admin = layui.admin
    ,form = layui.form
    ,router = layui.router()
    ,search = router.search;

    form.render();

    //提交
    form.on('submit(LAY-user-login-submit)', function(obj){

      var signUpUrl = "<?php echo url('User/singUp'); ?>";
      //请求登入接口
      admin.req({
        url: signUpUrl
        ,data: obj.field
        ,done: function(res){

          //登入成功的提示与跳转
          layer.msg('登入成功', {
            offset: '15px'
            ,icon: 1
            ,time: 1000
          }, function(){
            location.href = "<?php echo url('Index/index'); ?>"; //后台主页
          });
        },
          complete:function (res) {
            //更换验证码
            if(res.responseJSON.code > 0){
                $('#code').attr('src',"<?php echo url('User/getEntry'); ?>");
            }
        }
      });

      
    });

  });

  //获取验证码
  function getPhoneCode(){

      var phone = $('#phone').val(); //手机号
      var data = {phone:phone,type:1};//type:2 注册 1：登录

      $.post("<?php echo url('User/getPhoneCode'); ?>",data,function(res){
          res = JSON.parse(res);
          console.log(res);
          if(res.code != 0){
              layer.msg(res.msg);
          }
          if(res.code == 0){
              layer.msg('已发送');
          }
      });
  }
  
  function register() {
    window.location.href="<?php echo url('User/registerView'); ?>";
  }
  </script>
</body>
</html>