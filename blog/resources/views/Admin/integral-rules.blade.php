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
	<nav class="breadcrumb" style="margin-bottom: 10px"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 积分管理 <span class="c-gray en">&gt;</span> 积分列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
		<div class="cl pd-5 bg-1 bk-gray mt-20" style="margin-top: 0"> <span class="l"><a class="btn btn-primary radius" onclick="product_add('添加积分规则','{{url("admin/integral-rules-add")}}')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加</a></span> 
		<span class="r">共有数据：<strong>{{count($integralres)}}</strong> 条</span> </div>

		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover ">
				<thead>
					<tr class="text-c">
						<th width="8">ID</th>
						<th width="100">积分获取</th>
						<th width="100">积分项目</th>
						<th width="100">积分说明</th>
						<th width="60">积分兑换</th>
						<th width="50">积分特权</th>
						<th width="50">积分兑现金</th>
						<th width="45">操作</th>
					</tr>
				</thead>
				<tbody>
				@foreach($integralres as $value)
					<tr class="text-c va-m" id="tr" bg="">
						<td>{{$value->id}}</td>					
						<td>{{$value->obtain}}</td>
						<td>{{$value->object}}</td>
						<td>{{$value->integralexplain}}</td>
						<td>{{$value->integralconvert}}</td>
						<td>{{$value->privilege}}</td>
						<td>{{$value->cash}}</td>
						<td class="td-manage" >						
							<!-- <a style="text-decoration:none" class="ml-5" onClick="product_edit('订单详情', '')"  href="javascript:;" title="查看">
								<i class="Hui-iconfont edit">&#xe6df;</i>
							</a> -->
							<!-- <a style="text-decoration:none" class="ml-5"  onClick="product_edit('订单详情', '')" href="javascript:;" title="修改">
								<i class="Hui-iconfont add">&#xe63e;</i> 
							</a>-->
							<a style="text-decoration:none" class="ml-5" onClick="product_edit('积分规则信息修改', '{{url('admin/integral-rules-edit', $value->id)}}')" href="javascript:;" title="修改规则">
								<i class="Hui-iconfont edit">&#xe6df;</i>
							</a>
							
							<a title="删除" href="javascript:;" onclick="member_del(this, {{$value->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$integralres->links()}}
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

function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'get',
			url: '{{url("admin/integraldelete")}}',
			dataType: 'json',
			data:{id:id},
			success: function(data){
				if (data.status == 0) {
					$(obj).parents("tr").remove();
					layer.msg(data.msg,{icon:1,time:3000});
				} else{
					layer.msg(data.msg,{icon:1,time:3000});					
				}				
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

// function product_del(obj,id){
//         layer.confirm('确认要删除吗？',function(index){
//             $.ajax({
//                 type: 'get',
//                 url: '{{url("admin/integraldelete")}}',
//                 dataType: 'json',
//                 data: {id: id},
//                 success: function(data){
//                     if (data.status==0) {
//                         $(obj).parents("tr").remove();
//                         layer.msg(data.msg+'!', {icon:1,time:2000});
//                     }
//                 },
//                 error:function(data) {
//                     console.log(data.msg);
//                 },
//             });
//         });
//     }
</script>
</body>
</html>