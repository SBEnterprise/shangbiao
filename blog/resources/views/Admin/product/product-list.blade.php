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
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin"/>
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/bootstrap-3.3.7/css/bootstrap.min.css')}}" id="skin"/>
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>商品列表</title>

</head>
<body class="pos-r">
<div>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>商品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
		<div class="text-c">
			<form action="{{url('admin/product/product-list')}}" method="get">
				<input type="text" name="brand_name" id="" placeholder="品牌" style="width:250px" class="input-text">
				<input type="text" name="goods_name" id="" placeholder="商品名" style="width:250px" class="input-text">
				<button type="submit" class="btn btn-success" ><i class="Hui-iconfont">&#xe665;</i> 搜吧</button>
			</form>
		</div>
		<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a class="btn btn-primary radius" onclick="product_add('添加商品信息', '{{url("admin/product/product-add")}}')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加</a></span> <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>
		<!-- 表格导入导出 -->
		<div class="cl   mt-20"> <a href="{{url("admin/product/product-excel")}}" class="btn btn-success" ><i class="Hui-iconfont">&#xe600;</i> 导出</a>
			 <a href="{{url("admin/product/product-returnexcel")}}" class="btn btn-success" ><i class="Hui-iconfont">&#xe600;</i> 导入Excel</a>
		</div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover ">
				<thead>
					<tr class="text-c">
						<th width="40" >商品ID</th>
						<th width="40">分类ID</th>
						<th width="40">品牌ID</th>
						<th width="60">品牌</th>
						<th width="90">商品图片</th>
						<th width="100">商品名</th>
						<th width="50">单价</th>
						<th width="50">现价</th>
						<th width="50">库存量</th>
						<th width="90">商品描述</th>
						<th width="40">是否热销</th>
						<th width="50">销量</th>
						<th width="50">商品状态</th>
						<th width="60">上架时间</th>
						<th width="60">修改时间</th>
						<th width="45">操作</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $v)
					<tr class="text-c va-m">
						<td class="gid">{{$v->id}}</td>
						<td>{{$v->p_id}}</td>
						<td>{{$v->brand_id}}</td>
						<td class="text-l">{{$v->brand_name}}</td>
						<td>
							<img width="60" class="product-thumb" src="{{$v->goods_pic}}" id="{{$v->id}}">
						</td>
						<td class="text-l">
							<a style="text-decoration:none" onClick="product_show('{{$v->goods_name}}', '{{url("admin/product/detail-list", $v->id)}}','10001')" href="javascript:;" tit="{{$v->id}}> <b class="text-success">{{$v->brand_name}}</b> {{$v->goods_name}}</a>
						</td>
						<td><span class="price">{{$v->price}}</span></td>
						<td><span class="price">{{$v->present_price}}</span></td>
						<td class="text-l">{{$v->store_count}}件</td>
						<td class="text-l">{{$v->goods_remark}}</td>
						<td class="text-l">
							<span class="label label-success radius">
								@if ($v->is_hot ==1)
									热销
								@else
									否
								@endif
							</span>
						</td>
						<td class="text-l">{{$v->sales_num}}</td>
						<td class="td-status" >
							<span class="stat">{{$v->status}}</span>
							<span class="label label-success radius">
								@if ($v->status ==1)
									在售
								@else
									下架
								@endif
							</span>
						</td>
						<td><span class="price">{{$v->created_at}}</span></td>
						<td><span class="price">{{$v->updated_at}}</span></td>
						<td class="td-manage" >
							<a style="text-decoration:none" sid="{{$v->id}}" stat="{{$v->status}}" href="javascript:viod(0);" title="修改状态" class="stop">
								<i class="Hui-iconfont">&#xe6de;</i>
							</a>
							<a style="text-decoration:none" class="ml-5" onClick="product_edit('商品信息修改', '{{url('admin/product/product-edit', $v->id)}}')" href="javascript:;" title="修改商品信息">
								<i class="Hui-iconfont edit">&#xe6df;</i>
							</a>
							<a style="text-decoration:none" onClick="product_del(this, {{$v->id}})" href="javascript:;" title="删除"><i class="Hui-iconfont" >&#xe6e2;</i></a>
							<a style="text-decoration:none" class="ml-5 add" href="javascript:;" title="新增商品属性">
								<i class="Hui-iconfont add" gid="{{$v->id}}">&#xe63e;</i>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$data->appends(['brand_name' => $brand_name, 'goods_name' => $goods_name])->links()}}
		</div>
			<div class="error btn btn-success" style="display:none"></div>
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

	//修改商品状态
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
                	window.location.reload();
                }, 100);
    			var status = $(this).attr('stat');
                if (status==0) {
               	 	$(this).attr('stat', 1);
                } else if (status==1) {
                	$(this).attr('stat', 0);
                }
            } else {
            	layer.msg(data.msg, {icon: 6});
            	setTimeout(function () {
                	window.location.reload();
                }, 100);
            }
        },
        'json'
    );
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
/*产品-查看*/
function product_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*产品-编辑*/
function product_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*商品属性-新增*/
/*function detail_add(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}*/

$('i.add').click(function () {
	var id = $(this).attr('gid');
	$.post(
		'{{url("/check")}}',
		{id: id, _token: '{{ csrf_token() }}'},
		function (data) {
			if (data.status==0) {
				//console.log(data);
				// $('div.error').html(data.msg).css('display', 'block');
				var index = layer.open({
					type: 2,
					title: '商品详情添加',
					content: '{{url("admin/product/detail-add")}}/'+data.data.id
				});
				layer.full(index);
			} else {
				$('div.error').html(data.msg).css('display', 'block');
				setTimeout(function () {
	            	window.location.reload();
	            }, 2000);
			}
		},
		'json'
	);
});


    function product_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'get',
                url: '{{url("/pdelete")}}',
                dataType: 'json',
                data: {id: id},
                success: function(data){
                    if (data.status==0) {
                        $(obj).parents("tr").remove();
                        layer.msg(data.msg+'!', {icon:1,time:2000});
                    }
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
</script>
</body>
</html>
