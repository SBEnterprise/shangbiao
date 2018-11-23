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
<link rel="stylesheet" href="{{asset('admin/bootstrap-3.3.7/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>品牌管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 品牌管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	
	<div class="text-c">
			<form action="{{url('admin/product-brand')}}" method="get">
			<input type="text" name="keyword" id="" placeholder="品牌" style="width:250px" class="input-text">
			<button class="btn btn-primary " type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
			</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span> <span class="r">共有数据：<strong>{{count($brand)}}</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="40">ID</th>
					<!-- <th width="30">排序</th> -->
					<th width="100">品牌LOGO</th>
					<th width="100">品牌分类编号</th>				
					<th width="80">品牌编号</th>				
					<th width="80">品牌名称</th>
					<th width="110">网站地址</th>
					<!-- <th width="10">是否显示</th> -->
					<th>品牌说明</th>
					<th width="60">操作</th>
				</tr>
			</thead>
			<tbody>
			{{csrf_field()}}
			@foreach($brand as $value)
				<tr class="text-c">
					<td><input name="" type="checkbox" value=""></td>
					<td>{{$value->id}}</td>
					<!-- <td><input type="text" class="input-text text-c" value="1"></td> -->
					<td><img src="{{$value->brand_logo}}" width="100" height="80"></td>
					<td class="text-2">{{$value->p_id}}</td>
					<td class="text-2">{{$value->brand_id}}</td>
					<td>{{$value->brand_name}}</td>
					<!-- <td>1</td> -->
					<td>{{$value->site_url}}</td>
					<td class="text-2">{{$value->brand_desc}}</td>
					<td class="td-manage"><a title="编辑" href="javascript:;" onclick="member_edit('编辑','{{url("admin/product-brand-edit", $value->id)}}','','500','400')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>

					<!-- <a title="删除" href="javascript:;" onclick="member_del(this, {{$value->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> -->
					<a title="删除" href='{{url("admin/branddelete", $value->id)}}'  class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		{{$brand->appends(['keyword' => $keyword])->links()}}
	</div>
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
// $('.table-sort').dataTable({
// 	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
// 	"bStateSave": true,//状态保存
// 	"aoColumnDefs": [
// 	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
// 	  {"orderable":false,"aTargets":[0,6]}// 制定列不参与排序
// 	]
// });

/*品牌-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

</script>
</body>
</html>