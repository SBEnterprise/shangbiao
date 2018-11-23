<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/bootstrap-3.3.7/css/bootstrap.min.css')}}" id="skin"/>
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>意见反馈</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	意见管理
	<span class="c-gray en">&gt;</span>
	意见回复
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<form class="form form-horizontal" id="form-article-add" onsubmit="return false">

		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl">
				<span>意见回复</span>
			</div>
			<div class="tabCon">
				<div class="row cl">

                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <input type="hidden" name="sid" value="{{ $data->user_id }}">
                    <input type="hidden" name="username" value="{{ $data->username }}">

					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						回复：</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" id="website-title" name="reply" class="input-text" value="">
					</div>
				<div id="werror" class="formControls col-xs-4 col-sm-2" style="color: red;"></div>
				</div>
			</div>

			</div>
			<div class="tabCon">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius mybtn"><i class="Hui-iconfont">&#xe632;</i> 确认回复</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
    <div class="formControls col-xs-4 col-sm-2" style="height:20px;"></div>
    <div id="errorall" class="formControls col-xs-4 col-sm-5 btn btn-success" style="display:none;height:28px;"></div>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/jquery.validation/1.14.0/validate-methods.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/jquery.validation/1.14.0/messages_zh.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('admin/add/mystystem-base.js')}}"></script> -->
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$("#tab-system").Huitab({
		index:0
	});
});


$('button.mybtn').click(function () {
    var feedback_id = $('input[name="id"]').val();
    var user_id = $('input[name="sid"]').val();
    var username = $('input[name="username"]').val();
	var reply = $('input[name="reply"]').val();

    if (reply.length==0) {
        layer.msg('内容不能为空', {icon: 6});
        return false;
    }
    $('#werror').html('');
    $.post(
        '{{url("/replyaction")}}',
        {feedback_id: feedback_id,
        user_id: user_id, reply: reply,
        username: username, _token: '{{csrf_token()}}' },
        function (data) {
            if (data.status==0) {
                layer.msg(data.msg, {icon: 6});
                setTimeout(function () {
                    window.parent.location.reload();
                }, 3000);
            } else {
               layer.msg(data.msg, {icon: 6});
            }
        },
        'json'
    );
});

</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
