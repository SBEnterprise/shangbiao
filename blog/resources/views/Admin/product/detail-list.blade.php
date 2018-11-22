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
<link rel="stylesheet" type="text/css" href="{{asset('admin/bootstrap-3.3.7/css/bootstrap.min.css')}}" id="skin"/>
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>商品详情列表</title>
<link rel="stylesheet" type="text/css" href="{{asset('admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css')}}" >
</head>
<body class="pos-r">
<!-- <div class="pos-a" style="width:200px;left:0;top:0; bottom:0; height:100%; border-right:1px solid #e5e5e5; background-color:#f5f5f5; overflow:auto;">
	<ul id="treeDemo" class="ztree"></ul>
</div> -->
<div>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> <a href="{{url('admin/product/product-list')}}">产品管理 </a><span class="c-gray en">&gt;</span> 商品详情 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover ">
				<thead>
					<tr class="text-c">
						<th width="40">商品ID</th>
						<th width="40">款式</th>
						<th width="70">系列</th>
						<th width="50">表带</th>
						<th width="60">表带颜色</th>
						<th width="50">表扣</th>
						<th width="65">表壳</th>
						<th width="85">机芯型号</th>
						<th width="52">表盘尺寸</th>
						<th width="52">表盘厚度</th>
						<th width="52">重量</th>
						<th width="40">年份</th>
						<th width="35">添加时间</th>
						<th width="35">修改时间</th>
						<th width="30">操作</th>
					</tr>
				</thead>
				<tbody>

					<tr class="text-c va-m">
						<td class="gid">{{$data->gid}}</td>
						<td>{{$data->style}}</td>
						<td>{{$data->series}}</td>
						<td>{{$data->watch_strap}}</td>
						<td>{{$data->braceletColor}}</td>
						<td>{{$data->buckle}}</td>
						<td>{{$data->watch_case}}</td>
						<td>{{$data->movement_name}}</td>
						<td>{{$data->dial_size}}mm</td>
						<td class="text-l">{{$data->dial_thickness}}mm</td>
						<td class="text-l">{{$data->weight}}mm</td>
						<td>{{$data->year}}</td>
						<td><span class="price">{{$data->created_at}}</span></td>
						<td><span class="price">{{$data->updated_at}}</span></td>
						<td class="td-manage" >
							<a style="text-decoration:none" class="ml-5" onClick="detail_edit('产品编辑', '{{url('admin/product/detail-edit', $data->gid)}}')" href="javascript:;" title="编辑">
								<i class="Hui-iconfont edit">&#xe6df;</i>
							</a>
						</td>
					</tr>

				</tbody>
			</table>

			<div class="error btn btn-success" style="display:none"></div>
		</div>
	</div>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/laypage/1.2/laypage.js')}}"></script>
<script type="text/javascript">
	//修改商品详情
	$('a.stop').on('click', function () {
	    var id = $(this).attr('sid');
	    var status = $(this).attr('stat');
	    $.post(
	        '{{url("/pupdate")}}',
	        {id: id, status: status, _token: '{{csrf_token()}}' },
	        function (data) {
	            if (data.status==0) {
	                layer.msg(data.msg, {icon: 6});
	                setTimeout(function () {
	                	window.parent.location.reload();
	                }, 1000);
	    			var status = $(this).attr('stat');
	                if (status==0) {
	               	 	$(this).attr('stat', 1);
	                } else if (status==1) {
	                	$(this).attr('stat', 0);
	                }
	            } else {
	            	layer.msg(data.msg, {icon: 6});
	            	setTimeout(function () {
	                	window.parent.location.reload();
	                }, 1000);
	            }
	        },
	        'json'
	    );
	});




$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
	]
});
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}


/*商品详情-编辑*/
function detail_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

</script>
</body>
</html>