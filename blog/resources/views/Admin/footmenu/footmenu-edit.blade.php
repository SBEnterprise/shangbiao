<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>

<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />

<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>修改尾部菜单</title>
</head>
<body>
<div class="page-container">
	<form  onsubmit="return false" class="form form-horizontal" id="form-user-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">
				<span class="c-red">*</span>
				分类名称：</label>
			<div class="formControls col-xs-6 col-sm-6">
				<input type="text" class="input-text" value="{{$data->type_name}}" typeid="{{$data->id}}" name="type-name">
				<input type="hidden" class="input-text" value="{{$data->parent_id}}" name="parent_id">
			</div>
		</div>
	@if($data->parent_id==0)
		<div class="row cl"></div>
	@else
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">
				<span class="c-red">*</span>
				分类内容：</label>
			<div class="formControls col-xs-6 col-sm-6">
				<input type="text" name="content" value="{{$data->content}}">
			</div>
		</div>
	@endif
		<div class="row cl">
			<div class="col-9 col-offset-2">
				<button class="btn btn-primary radius tbtn"> 提交</button>
			</div>
		</div>
	</form>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin/lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/jquery.validation/1.14.0/validate-methods.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/jquery.validation/1.14.0/messages_zh.js')}}"></script>
<script type="text/javascript">
	$('button.tbtn').click(function () {
		var id = $('input[name="type-name"]').attr('typeid');
		var name = $('input[name="type-name"]').val();
		var parent_id = $('input[name="parent_id"]').val();
	    if (parent_id != 0) {
	    	var content = $('input[name="content"]').val();
		    if (content.length == 0) {
		        layer.msg('分类内容不能为空！', {icon: 6});
		        return false;
		    }
		} else{
			var content = '';	
		}
	    if (name.length == 0) {
	        layer.msg('分类名不能为空！', {icon: 6});
	        return false;
	    }
		
		$.post(
			'{{ url("admin/footmenu/update") }}',
			{id :id, type_name: name, content: content, _token: '{{csrf_token()}}' },
			function (data) {
				if(data.status == 1) {
					//修改成功
					layer.msg(data.msg,{icon:1,time:3000});
					window.parent.location.reload();
				} else {
					//修改失败
					layer.msg(data.msg,{icon:1,time:3000});
				}
			},
			'json',
		);
	});
</script>
</body>
</html>
