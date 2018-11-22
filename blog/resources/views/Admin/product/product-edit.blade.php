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

<title>基本设置</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	<a href="javascript:;" onclick="window.open({{url('admin/product/product-list')}});window.close();">商品管理</a>
	<span class="c-gray en">&gt;</span>
	商品数据修改
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
    <form action="{{url('/editgoods')}}" method="post" enctype="multipart/form-data" onsubmit="return checkVaild();">
            {{ csrf_field() }}
            @include('Common/tip')
    <div id="tab-system" class="HuiTab">
        <div class="tabBar cl">
            <span>商品修改</span>
        </div>
        <div class="tabCon">
            <div class="row cl">

                <input type="hidden" name="gid" value="{{$data->id}}">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    分类ID</label>
                <div class="formControls col-xs-8 col-sm-6">
					<input type="text"  name="pid" class="input-text" value="{{$data->p_id}}" disabled>
                    <input type="hidden" name="p_id" value="{{$data->p_id}}">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">
					<span class="c-red">*</span>
					品牌ID:</label>
				<div class="formControls col-xs-8 col-sm-6">
					<input type="text"  name="brandid" class="input-text" value="{{$data->brand_id}}" disabled>
                    <input type="hidden" name="brand_id" value="{{$data->brand_id}}">
				</div>
			</div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    品牌:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text"  name="brandname" class="input-text" value="{{$data->brand_name}}" disabled>
                    <input type="hidden" name="brand_name" value="{{$data->brand_name}}">
                </div>
            </div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">
					<span class="c-red">*</span>
					商品名:</label>
				<div class="formControls col-xs-8 col-sm-6">
                    <input type="text"  name="goods_name" class="input-text" value="{{$data->goods_name}}">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">
					<span class="c-red">*</span>
					库存量:</label>
				<div class="formControls col-xs-8 col-sm-6">
					<input type="text"  name="store_count" class="input-text" value="{{$data->store_count}}">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">
					<span class="c-red">*</span>
					单价:</label>
				<div class="formControls col-xs-8 col-sm-6">
					<input type="text"  name="price" class="input-text" value="{{$data->price}}">
				</div>
			</div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    现价:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text"  name="present_price" class="input-text" value="{{$data->present_price}}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    销量:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text"  name="salesnum" class="input-text" value="{{$data->sales_num}}" disabled>
                    <input type="hidden" name="sales_num" value="{{$data->sales_num}}">
                </div>
            </div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">
					<span class="c-red">*</span>
					商品描述:</label>
				<div class="formControls col-xs-8 col-sm-6">
					<input type="text" name="goods_remark" class="input-text" value="{{$data->goods_remark}}">

				</div>
			</div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">是否热销:</label>
                <div class="formControls col-xs-8 col-sm-6">
                @if($data->is_hot==1)
                    <input type="radio" name="is_hot" value="1" checked>热销
                    <input type="radio" name="is_hot" value="0" >否
                @else
                    <input type="radio" name="is_hot" value="1" >热销
                    <input type="radio" name="is_hot" value="0" checked>否
                @endif
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">是否上架:</label>
                <div class="formControls col-xs-8 col-sm-6">
                @if($data->status==1)
                    <input type="radio" name="status" value="1" checked>上架
                    <input type="radio" name="status" value="0" >下架
                @else
                    <input type="radio" name="status" value="1" >上架
                    <input type="radio" name="status" value="0" checked>下架
                @endif
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">商品图片:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <img src="{{$data->goods_pic}}"><br>
                    <input type="file" name="pic" value="{{$data->goods_pic}}">
                </div>
            </div>
        </div>
        <div class="tabCon"></div>
    </div>
    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
            <button class="btn btn-primary radius editbtn"><i class="Hui-iconfont">&#xe632;</i> 确认修改</button>
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

//检查填写的商品信息是否为空
function checkVaild() {
    var goods_name = $('input[name="goods_name"]').val();
    if (goods_name.length == 0) {
        layer.msg('请填写商品名称', {icon: 6});
        return false;
    }

    var store_count = $('input[name="store_count"]').val();
    if (store_count.length == 0) {
        layer.msg('请填写库存量', {icon: 6});
        return false;
    }

    var price = $('input[name="price"]').val();
    if (price.length == 0) {
        layer.msg('请填写单价', {icon: 6});
        return false;
    }

    var present_price = $('input[name="present_price"]').val();
    if (present_price.length == 0) {
        layer.msg('请填写现价', {icon: 6});
        return false;
    }

    var goods_remark = $('input[name="goods_remark"]').val();
    if (goods_remark.length == 0) {
        layer.msg('请填写商品描述', {icon: 6});
        return false;
    }
    return true;
}


</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
