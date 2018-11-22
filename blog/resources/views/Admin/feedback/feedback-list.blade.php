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

<title>意见反馈</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 评论管理 <span class="c-gray en">&gt;</span> 意见反馈 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<form action="{{url('admin/feedback/feedback-list')}}" method="get">
		<input type="hidden" name="title">
		<input type="text" class="input-text" style="width:250px" placeholder="按内容搜" name="content">
		<button type="submit" class="btn btn-success radius"><i class="Hui-iconfont">&#xe665;</i> 搜意见</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20">  <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="40">ID</th>
					<th width="70">用户头像</th>
					<th width="70">用户名</th>

					<th width="290">意见内容</th>
					<th width="70">留言时间</th>

					<th width="70">回复时间</th>
					<th width="30">操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($contentData as $v)
				<tr class="text-c">
					<td>{{$v->id}}</td>
					<td>
						<i class="avatar size-L radius"><img alt="" src="{{asset('admin/static/h-ui/images/ucnter/avatar-default-S.gif')}}"></i>
					</td>
					<td class="text-l">
						<div class="c-999 f-12">
							<u style="cursor:pointer" class="text-primary" >{{$v->username}}</u>

						</div>

					<td>
						<u style="cursor:pointer" class="text-primary" onclick="reply_show('查看回复', '{{url("admin/reply/reply-show", $v->id)}}', '10001', '500', '600')" title="查看回复">{{$v->content}}</u>
					</td>
					<td>{{$v->created_at}}</td>

					<td>{{$v->updated_at}}</td>
					<td class="td-manage"><a title="回复" href="javascript:;" onclick="reply_edit('回复意见', '{{url("admin/reply/reply-edit", $v->id)}}', '{{$v->id}}', '', '510')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="feedback_del(this, {{$v->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$contentData->appends(['title' => $title, 'content' => $content])->links()}}
	</div>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> <!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/laypage/1.2/laypage.js')}}"></script>
<script type="text/javascript">
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*意见回复-查看*/
function reply_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*意见-回复*/
function reply_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*意见-删除*/
function feedback_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'get',
			url: '{{url("/feedbackdel")}}/'+id,
			dataType: 'json',
			success: function(data){
				if (data.status==0) {
					$(obj).parents("tr").remove();
					layer.msg(data.msg+'!',{icon:1,time:1000});
				}
			},
			error:function(data) {
				console.log(data.msg);
			}
		});
	});
}
</script>
</body>
</html>
