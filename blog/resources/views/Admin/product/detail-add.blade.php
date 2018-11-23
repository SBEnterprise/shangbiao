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
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/bootstrap-3.3.7/css/bootstrap.min.css')}}" id="skin"/>
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>商品详情</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 产品管理
	<span class="c-gray en">&gt;</span>
	商品管理
	<span class="c-gray en">&gt;</span>
	商品详情添加
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<form class="form form-horizontal" id="form-article-add" onsubmit="return false">
		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl">
				<span>商品详情添加</span>
			</div>
			<div class="tabCon">
				<div class="row cl">
                    <!-- <input type="hidden" name="gid" value="{{$id}}"> -->
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						商品ID：</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" name="gid" class="input-text" tit="{{$id}}" value="{{$id}}" disabled>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						款式：</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" name="style" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						系列：</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" name="series" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						表带:</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" name="watch_strap" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						表带颜色:</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" name="braceletColor" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						表扣</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" name="buckle" class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">表壳:</label>
					<div class="formControls col-xs-8 col-sm-6">
						<input type="text" name="watch_case" class="input-text">
					</div>
				</div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">机芯型号:</label>
                    <div class="formControls col-xs-8 col-sm-6">
                        <input type="text" name="movement_name" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">表盘尺寸:</label>
                    <div class="formControls col-xs-8 col-sm-6">
                        <input type="text" name="dial_size" class="input-text">单位：mm
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">表盘厚度:</label>
                    <div class="formControls col-xs-8 col-sm-6">
                        <input type="text" name="dial_thickness" class="input-text">单位：mm
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">手表重量:</label>
                    <div class="formControls col-xs-8 col-sm-6">
                        <input type="text" name="weight" class="input-text">单位：g
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">年份:</label>
                    <div class="formControls col-xs-8 col-sm-6">
                        <input type="text" name="year" class="input-text">
                    </div>
                </div>
			</div>
			</div>
			<div class="tabCon">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius mybtn"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
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
	var gid = $('input[name="gid"]').attr('tit');
    var style = $('input[name="style"]').val();
    var series = $('input[name="series"]').val();
    var watch_strap = $('input[name="watch_strap"]').val();
    var braceletColor = $('input[name="braceletColor"]').val();
    var buckle = $('input[name="buckle"]').val();
    var watch_case = $('input[name="watch_case"]').val();
    var movement_name = $('input[name="movement_name"]').val();
    var dial_size = $('input[name="dial_size"]').val();
    var dial_thickness = $('input[name="dial_thickness"]').val();
    var weight = $('input[name="weight"]').val();
    var year = $('input[name="year"]').val();
    if (style.length==0) {
        layer.msg('请填写手表款式', {icon: 6});       
        return false;
    }

    if (series.length==0) {
        layer.msg('请填写手表系列', {icon: 6});   
        return false;
    }

    if (watch_strap.length==0) {
        layer.msg('请填写表带材质', {icon: 6});   
        return false;
    }

    if (braceletColor.length==0) {
        layer.msg('请填写表带颜色', {icon: 6});   
        return false;
    }

    if (buckle.length==0) {
        layer.msg('请填写表扣', {icon: 6});   
        return false;
    }

    if (watch_case.length==0) {
        layer.msg('请填写表壳材质', {icon: 6});   
        return false;
    }

    if (movement_name.length==0) {
        layer.msg('请填写机芯型号', {icon: 6});   
        return false;
    }

     if (dial_size.length==0) {
        layer.msg('请填写表盘尺寸', {icon: 6});   
        return false;
    }

    if (dial_thickness.length==0) {
        layer.msg('请填写表盘厚度', {icon: 6});   
        return false;
    }

    if (weight.length==0) {
        layer.msg('请填写手表重量', {icon: 6});   
        return false;
    }

    if (year.length==0) {
        layer.msg('请填写手表推出年份', {icon: 6});   
        return false;
    }
    $.post(
        '{{url("/dinsert")}}',
        {gid: gid, style: style, series: series,
        watch_strap: watch_strap, braceletColor: braceletColor,
        buckle: buckle, watch_case: watch_case,
        movement_name: movement_name,
        dial_size: dial_size,
        dial_thickness: dial_thickness,
        weight: weight, year: year,
         _token: '{{csrf_token()}}'
        },
        function (data) {
            if (data.status==0) {
                layer.msg(data.msg, {icon: 6});
                setTimeout(function () {
                     window.parent.location.reload()
                }, 3000);
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
