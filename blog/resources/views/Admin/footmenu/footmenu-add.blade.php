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
<link rel="stylesheet" type="text/css" href="{{asset('admin/bootstrap-3.3.7/css/bootstrap.min.css')}}" id="skin"/>
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />

<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加产品分类及内容</title>
</head>
<body>
<div class="page-container">
	<form class="form form-horizontal" id="form-user-add" onsubmit="return false">
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-1 col-offset-2">
				父类名称：</label>
			<div class="formControls col-xs-6 col-sm-6">
				<select name="parent_id" id="id">
					<option value="0">顶级分类</option>
					@php

					foreach($data as $v) {
						$nbsp = str_repeat("&nbsp;", substr_count($v->path, ",")*6);
						echo '<option value="'.$v->id.'">' . $nbsp . $v->type_name . '</option>';
					}
					@endphp
				</select>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-1 col-offset-2">分类名称：</label>
			<div class="formControls col-xs-6 col-sm-6">
				<input name="cat_name" placeholder="最少输入分类名称">
				<span id="error-category-name" style="display:block; margin-top: 10px;color: red"></span>
				<!-- <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p> -->
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-2 col-sm-1 col-offset-2">分类内容：</label>
			<div class="formControls col-xs-6 col-sm-6">
				<input name="cat_content" placeholder="最少输入分类内容">
				<span id="error-content" style="display:block; margin-top: 10px;color: red"></span>
				<!-- <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p> -->
			</div>
		</div>
		<div class="row cl">
			<div class="col-9 col-offset-3">
				<!-- <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;"> -->
				<button class="btn btn-primary radius tbtn" id="butt"> 提交</button>
			</div>
		</div>
	<!-- </form> -->
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
$('#butt').click(function () {
	var id  =$('select#id').find('option:selected').val();
	var name = $('input[name="cat_name"]').val();
    var content = $('input[name="cat_content"]').val();
    if (name.length==0) {
    	layer.msg('分类名不能为空！', {icon: 6});
        return false;
    }
    if (content.length==0) {
    	layer.msg('分类内容不能为空！', {icon: 6});
        return false;
    }
	$.post(
		'{{ url("admin/footmenu/save") }}',
		{parent_id: id, type_name: name, content: content, _token: '{{csrf_token()}}' },
		function (data) {
			if(data.status == 1) {
					//添加成功
					layer.msg(data.msg,{icon:1,time:3000});
					window.parent.location.reload();
			} else if (data.status == 0) {
					//添加失败
					layer.msg(data.msg,{icon:1,time:3000});
			} else {
					//分类名已存在
					layer.msg(data.msg,{icon:1,time:3000});
					return false;
			}
		},
		'json',
	);

});
</script>
</body>
</html>
