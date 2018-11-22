<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" href="{{asset('common/bootstrap-3.3.7/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>商品列表</title>
<link rel="stylesheet" type="text/css" href="{{asset('admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css')}}" >
</head>
<body class="pos-r">
<!-- <div class="pos-a" style="width:200px;left:0;top:0; bottom:0; height:100%; border-right:1px solid #e5e5e5; background-color:#f5f5f5; overflow:auto;">
	<ul id="treeDemo" class="ztree"></ul>
</div> -->
<div>
	<nav class="breadcrumb" style="margin-bottom: 10px"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 订单列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
		<div class="cl pd-5 bg-1 bk-gray mt-20" style="margin-top: 0"> <!-- <span class="l"><a class="btn btn-primary radius" onclick="product_add('添加商品属性','{{asset("admin/product/product-add")}}')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加</a></span>  -->
		<span class="r">共有数据：<strong></strong> 条</span> </div>

		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover ">
				<thead>
					<tr class="text-c">
						<th width="40">订单ID</th>
						<th width="40">订单号</th>
						<th width="40">用户id</th>
						<th width="60">订单状态</th>
						<!-- <th width="50">物流状态</th> -->
						<th width="50">支付状态</th>
						<th width="50">收货人</th>
						<th width="50">收货地址</th>
						<th width="40">联系方式</th>
						<th width="40">使用积分</th>
						<th width="50">订单总额</th>
						<th width="40">邮费</th>
						<th width="50">下单时间</th>
						<!-- <th width="60">支付时间</th> -->
						<th width="60">用户备注</th>
						<th width="45">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php $arr = ['未确定', '已确定', '等待买家确定收货', '交易成功', '无效订单', '退货', '交易成功'];?>
					<?php $payarr = ['未付款', '已付款'];?>
					<?php $shipping = ['未发货', '已发货', '已收货'];?>
					@foreach($order as $v)
					<tr class="text-c va-m" id="tr" bg="{{$v->order_status}}">
						<td class="gid">{{$v->order_id}}</td>
						<td class="text-l">{{$v->order_sn}}</td>
						<td style="text-align: center;">{{$v->user_id}}</td>
						<!-- <td class="text-l">{{$v->order_status}}</td> -->
						<td class="td-status" >{{$arr[$v->order_status]}}</td>
						<!-- <td class="td-status" >{{$shipping[$v->shipping_status]}}</td> -->
						<td><span class="price">{{ $payarr[$v->pay_status] }}</span></td>					
						<td>{{$v->consignee}}</td>
						<td>{{$v->address}}</td>
						<td>{{$v->phone}}</td>
						<td>{{$v->integral}}</td>
						<td>{{$v->total_amount}}</td>
						<td>{{$v->shipping_price}}</td>
						<td><span class="price">{{$v->add_time}}</span></td>
						<!-- <td><span class="price">{{$v->pay_time}}</span></td> -->
						<td>{{$v->user_note}}</td>
						<td class="td-manage" >
							<!-- <a style="text-decoration:none"  href="javascript:viod(0);" title="下架" class="stop">
								<i class="Hui-iconfont">&#xe6de;</i>
							</a> -->
							@if($v->order_status==1)
								<a href="javascript:;" id="shipping" oid="{{$v->order_id}}">发货</a>
							@endif
							<a style="text-decoration:none" class="ml-5" onClick="product_edit('订单详情', '{{url('admin/orderdetailview?oid='.$v->order_id)}}')"  href="javascript:;" title="查看">
								<i class="Hui-iconfont edit">&#xe6df;</i>
							</a>

							<!-- <a style="text-decoration:none" class="del" href="javascript:;" title="删除"><i class="Hui-iconfont" >&#xe6e2;</i></a> -->

							<a style="text-decoration:none" class="ml-5"  onClick="product_edit('订单详情', '{{url('admin/ordereditview?oid='.$v->order_id)}}')" href="javascript:;" title="修改">
								<i class="Hui-iconfont add">&#xe63e;</i>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $order->links() }}
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

	//执行发货
	$('a#shipping').on('click', function () {
	    var oid = $(this).attr('oid');
	    console.log(oid);
	     $.ajax({
	            type:'post',
	            url: "{{url('/admin/ordershipping')}}",
	            data: 'oid='+oid+'&_token={{csrf_token()}}',
	            success:function (data) {
	                console.log(data);
	                if (data==200) {
	                    alert('发货成功！');
	                    location.href = '{{url("/admin/orderview")}}';
	                }
	            },
	            dataType:'json'

	     })
	});
	// if($('tr#tr').attr('bg') == 4) {
	// 	$('tr#tr').css('background', '#ccc');
	// 	// console.log($(this));
	// }



/*$(document).ready(function(){
	var t = $("#treeDemo");
	t = $.fn.zTree.init(t, setting, zNodes);
	//demoIframe = $("#testIframe");
	//demoIframe.on("load", loadReady);
	var zTree = $.fn.zTree.getZTreeObj("tree");
	//zTree.selectNode(zTree.getNodeByParam("id",'11'));
});*/

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
				console.log(data);
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

/*产品-删除*/
$('a.del').on('click', function () {
	var id = $(this).attr('did');
	// console.log(id);
	$.post(
		'{{url("/pdelete")}}',
		{id: id, _token: '{{ csrf_token() }}'},
		function (data) {
			if (data.status==0) {
				$('div.error').html(data.msg).css('display', 'block');
				setTimeout(function () {
	                $('div.error').html('').css('display', 'none');
	            window.location.reload();
	            }, 3000);
			} else {
				$('div.error').html(data.msg);
			}
		},
		'json'
	);
});
</script>
</body>
</html>