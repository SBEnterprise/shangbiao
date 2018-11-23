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
<link rel="stylesheet" type="text/css" href="{{asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/bootstrap-3.3.7/css/bootstrap.min.css')}}" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>系统设置管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 系统设置管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="info_add('添加网站信息', '{{url("admin/system/system-base")}}','900','600')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加网站信息</a></span> <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="40">ID</th>
				<th width="70">网站名称</th>
				<th width="120">关键词</th>
				<th width="200">描述</th>
				<th width="130">css/js/images路径配置</th>
				<th width="130">上传目录配置</th>
				<th width="130">底部版权信息</th>
				<th width="100">备案号</th>
				<th width="75">添加时间</th>
				<th width="75">修改时间</th>
				<th width="40">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($info as $v)
			<tr class="text-c">
				<td>{{$v['id']}}</td>
				<td>{{$v['site_name']}}</td>
				<td>{{$v['keyword']}}</td>
				<td>{{$v['description']}}</td>
				<td>{{$v['url']}}</td>
				<td class="text-l">{{$v['basename']}}</td>
				<td>{{$v['copyright']}}</td>
				<td>{{$v['record_num']}}</td>
				<td>{{$v['created_at']}}</td>
				<td>{{$v['updated_at']}}</td>
				<td class="td-manage">
					<a title="编辑" href="javascript:;" onclick="system_edit('编辑','{{url("admin/system/system-edit", $v["id"])}}', '','900','600')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a>
					<a title="删除" href="javascript:;" class="ml-5 del" uid="{{$v['id']}}" style="text-decoration:none;" >
					@if($v['id'] == 2)					
					 	<i class="Hui-iconfont" style="display:none">&#xe6e2;</i>
					@else
					 	<i class="Hui-iconfont">&#xe6e2;</i>
					@endif
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	</div>
	{{$info->appends(['id'=>$v['id']])->links()}}
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/laypage/1.2/laypage.js')}}"></script>
<script type="text/javascript">
/*用户-添加*/
function info_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*信息-编辑*/
function system_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*信息-删除*/
$('a.del').on('click', function () {
	var id = $(this).attr('uid');
	// console.log(id);
	$.post(
		'{{url("/udel")}}',
		{id: id, _token: '{{ csrf_token() }}'},
		function (data) {
			if (data.status==0) {
				layer.msg(data.msg, {icon: 6});
				setTimeout(function () {
	            	window.location.reload();
	            }, 2000);
			} else {
				layer.msg(data.msg, {icon: 6});
				setTimeout(function () {
	            	window.location.reload();
	            }, 2000);
			}
		},
		'json'
	);
});
</script>
</body>
</html>
