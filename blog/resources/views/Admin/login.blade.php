<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link href="{{asset('admin/static/h-ui/css/H-ui.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/static/h-ui.admin/css/H-ui.login.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/static/h-ui.admin/css/style.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>腕表商城-后台登录</title>
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" onsubmit="return false">
      {{ csrf_field() }}
      <div class="row cl">
        <label class="form-label col-xs-2"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input type="text" name="user_name" placeholder="账户" class="input-text size-L">
        </div>
        <div class="username-error" style="color:red;line-height:40px;"></div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-2"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input type="password" name="password" placeholder="密码" class="input-text size-L">
        </div>
        <div class="password-error" style="color:red;line-height:40px;"></div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-2">
          <input class="input-text size-L" type="text" name="code" placeholder="验证码" style="width:150px;">
          <img id="codePic" src="{{url('/makecode')}}"><br><a id="newPic" onclick="getPic();" href="javascript:;">看不清，换一张</a>
        </div>
        <div class="code-error" style="color:red;line-height:40px;display:inline-block"></div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-2">
          <label for="online">
            <input type="checkbox" name="online" id="online" value="">
            使我保持登录状态</label>
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-5 col-xs-offset-2">
          <button class="btn btn-success radius size-L login"> &nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;</button>
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
        <div class="error" style="color:red;line-height:40px;display:inline-block"></div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright 你的公司名称 by H-ui.admin v3.1</div>
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/2.4/layer.js')}}"></script>
<!--此乃百度统计代码，请自行删除-->
<script>
//局部刷新验证码
function getPic(){
  $("#codePic").attr("src","{{url('/makecode')}}"+'?flag='+Math.random());
};

//ajax提交登录
$('button.login').click(function () {
  var username = $('input[name="user_name"]').val();
  if (username.length==0) {
    layer.msg('请输入用户名', {icon: 6});
    return false;
  }
  var password = $('input[name="password"]').val();
  if (password.length==0) {
    layer.msg('请输入密码', {icon: 6});
    return false;
  }

  var code = $('input[name="code"]').val();
  if (code.length==0) {
    layer.msg('请输入密码', {icon: 6});
    return false;
  }

  $.post(
    '{{url("admin/doLogin")}}',
    {user_name: username, password: password, code: code, _token: '{{ csrf_token() }}'},
    function (data) {
      if (data.status==0) {
        layer.msg(data.msg, {icon: 6});
        setTimeout(function () {
          window.location.href = "{{url('admin/index')}}";

        }, 2000);
      } else {
        layer.msg(data.msg, {icon: 6});
        // setTimeout(function () {
        //   window.location.href = "{{url('admin/403')}}";

        // }, 0);
      }
    },
    'json'
  );
});
</script>
<!--/此乃百度统计代码，请自行删除-->
</body>
</html>
