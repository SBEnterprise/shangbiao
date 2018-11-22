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
<title>友情链接管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 后台管理 <span class="c-gray en">&gt;</span> 友情链接管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">

		<form class="Huiform" target="_self" enctype="multipart/formdata">
		{{csrf_field() }}
			<div class="sucess"></div>
			<input type="text" placeholder="友情编号" value="" name="friendnumber" class="input-text box" style="width:200px">
			<input type="text" placeholder="网站名" value="" name="website" class="input-text box" style="width:200px">
			<input type="text" placeholder="友情链接地址" value="" name="webaddress" class="input-text box2" style="width:200px">
			<button type="button" class="btn btn-success btn-add" id=""><i class="Hui-iconfont">&#xe600;</i> 添加</button>
		</form>
		
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span> <!-- <span class="r">共有数据：<strong>54</strong> 条</span> --> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="70">ID</th>
					<th width="80">排序</th>
					<th width="100">友情编号</th>
					<th width="100">友情网站名称</th>
					<th>友情链接地址</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			
			<tbody>
			@foreach($friend as $v)
				<tr class="text-c">
					<td><input name="" type="checkbox" value=""></td>
					<td>{{$v->id}}</td>
					<td><input type="text" class="input-text text-c" value="1"></td>
					<td class="text-2">{{$v->friendlink_id}}</td>
					<td class="text-2"><img title="" src=""> {{$v->friendlink_name}}</td>
					<td class="text-2">{{$v->friendlink_url}}</td>
					<td class="td-manage"><a title="编辑" href="javascript:;" onclick="member_edit('编辑','{{url("admin/friend-add", $v->id)}}','','800')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>

					<a title="删除" href="javascript:;" onclick="member_del(this, {{$v->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
		{{$friend->links()}}
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
//这个Jquery是统计条数，排序圣序的
//  $('.table-sort').dataTable({
// 	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
// 	"bStateSave": true,//状态保存
// 	"aoColumnDefs": [
// 	  // {"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
// 	  {"orderable":false,"aTargets":[0,6]}// 制定列不参与排序
// 	]
// });

/*友链-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*友链-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'get',
			url: '{{url("/frienddelete")}}',
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
</script>
<script>
	$('button.btn-add').on('click', function () {
		// alert(1);
		// 获取到input标签输入的内容
		var website = $('input[name="website"]').val();
		var webaddress = $('input[name="webaddress"]').val();
		var friendnumber = $('input[name="friendnumber"]').val();
		// console.log(uploadfile);
		if (friendnumber.length == 0) {

				$('input[name="friendnumber"]').attr('placeholder', '请输入友情编号');
				return false;
			}
		if (website.length == 0) {

				$('input[name="website"]').attr('placeholder', '不能为空');
				return false;
			}
		if (webaddress.length == 0) {

				$('input[name="webaddress"]').attr('placeholder', '不能为空');
				return false;
			}

		$.ajax({
			type: 'get',
			dataType:'json',
	        url: '{{url("/friendaction")}}',
	        data: 'wname='+website+'&waddress='+webaddress+'&friendnumber='+friendnumber+'&_token={{csrf_token()}}',
	        success:function (data) {
			//接收修改方法返回来的信息
			if(data.status == 1) {

					//添加成功
					layer.msg(data.msg,{icon:1,time:4000});
					location.href ='{{ url("admin/article-list") }}';
			} else if (data.status == 0) {
					//添加失败
					layer.msg(data.msg,{icon:1,time:4000});
			}
		},
			error:function(data) {
				console.log(data.msg);
	        },
	        
		});	

	});
</script>

</body>
</html>