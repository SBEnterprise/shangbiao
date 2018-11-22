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
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加产品分类</title>
</head>
<body>
<div class="page-container">
<!-- 	<form class="form form-horizontal" id="form-user-add"> -->
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">
				<span class="c-red">*</span>
				父类名称：</label>
			<div class="formControls col-xs-6 col-sm-6">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<select name="parent_id" id="id">
						<option value="0">顶级分类</option>
						@php
						
						foreach($data as $v) {
							$nbsp = str_repeat("&nbsp;",substr_count($v->path,",")*6);
							echo '<option value="'.$v->id.'">' . $nbsp . $v->type_name . '</option>';
						}
						@endphp			
				</select>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">分类名称：</label>
			<div class="formControls col-xs-6 col-sm-6">
				<textarea name="cat_name" cols="" rows="" class="textarea"  placeholder="最少输入分类名称" onKeyUp="$.Huitextarealength(this,100)"></textarea>
				<span id="error-category-name" style="display:block; margin-top: 10px;color: red"></span>
				<!-- <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p> -->
			</div>
		</div>
		<div class="row cl">
			<div class="col-9 col-offset-2">
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

	// var name =$('select#id').find('option:selected').text();
	var id  =$('select#id').find('option:selected').val();
	console.log(id);
	// console.log(name);
	var name = $('textarea[name="cat_name"]').val();
	console.log(name);
    if (!$('textarea[name="cat_name"]').val()) {
        $('#error-category-name').html('分类名不能为空！');
        return false;
    }
	$.ajax({
		url:'{{ url("admin/category/save") }}',
		type:'post',
		dataType:'json',
		data:'parent_id='+id+'&type_name='+name+'&_token={{csrf_token()}}',
		success:function (data) {
			if(data.status == 1) {

					//添加成功
					layer.msg(data.msg,{icon:1,time:3000});
					location.href ='{{ url("admin/category/index") }}';
			} else if (data.status == 0) {
					//添加失败
					layer.msg(data.msg,{icon:1,time:3000});
			} else {
					//分类名已存在
					// layer.msg(data.msg,{icon:1,time:3000});
					$('#error-category-name').html('');
					$('#error-category-name').html(data.msg).css('color', 'red');
					return false;
			}		
		},

	});

});
</script>
</body>
</html>