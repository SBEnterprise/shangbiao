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

<title>基本设置</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	系统管理
	<span class="c-gray en">&gt;</span>
	基本设置
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<form class="form form-horizontal" id="form-article-add" onsubmit="return false">
		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl">
				<span>基本设置</span>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						网站名称：</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" id="website-title" name="w_name" placeholder="控制在25个字、50个字节以内" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						关键词：</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" id="website-Keywords" name="keyword" placeholder="5个左右,8汉字以内,用英文,隔开" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						描述：</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" id="website-description" name="desc" placeholder="空制在80个汉字，160个字符以内" value="" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						css/js/images路径配置:</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" id="website-static" name="url" placeholder="不能为空，为相对路径" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						上传目录配置:</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" id="website-uploadfile" name="basename" placeholder="默认为uploadfile" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						底部版权信息：</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" id="website-copyright" name="cp" placeholder="例：&copy; 2016-2018" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">备案号：</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" id="website-icp" name="recnum" placeholder="例：京ICP备00000000号" class="input-text">
					</div>
				</div>
			</div>

			</div>
			<div class="tabCon">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button type="submit" class="btn btn-primary radius mybtn"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
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
	// alert(1);
    var name = $('input[name="w_name"]').val();
    var keyword = $('input[name="keyword"]').val();
    var desc = $('input[name="desc"]').val();
    var url = $('input[name="url"]').val();
    var basename = $('input[name="basename"]').val();
    var cp = $('input[name="cp"]').val();
    var recnum = $('input[name="recnum"]').val();
    if (name.length==0) {
        layer.msg('请填写网站名称', {icon: 6});
        return false;
    }
   
    if (keyword.length==0) {
    	layer.msg('请填写关键字', {icon: 6});
        return false;
    }
  
    if (desc.length==0) {
    	layer.msg('请填写描述内容', {icon: 6});
        return false;
    }

    if (url.length==0) {
        layer.msg('请填写css、js、images路径', {icon: 6});
        return false;
    }

    if (basename.length==0) {
    	layer.msg('请填写上传目录', {icon: 6});
        return false;
    }
 
    if (cp.length==0) {
    	layer.msg('请填写版权信息', {icon: 6});
        return false;
    }
   
    if (recnum.length==0) {
        layer.msg('请填写备案号', {icon: 6});
        return false;
    }
   
    $.post(
        '{{url("/action")}}',
        {name: name, keyword: keyword, desc: desc, url: url,
            basename: basename, cp: cp, recnum: recnum, _token: '{{csrf_token()}}' },
        function (data) {
            if (data.status==-1) {
                layer.msg(data.msg, {icon: 6});
            } else {
                layer.msg(data.msg, {icon: 6});
                setTimeout(function () {
                    window.parent.location.reload();
                }, 3000);
            }
        },
        'json'
    );
});

</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
