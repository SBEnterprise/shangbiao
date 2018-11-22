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
<script type="text/javascript" src="lib/html5shiv.js')}}"></script>
<script type="text/javascript" src="lib/respond.min.js')}}"></script>

<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admin/bootstrap-3.3.7/css/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />
<!-- <link rel="stylesheet" type="text/css" href="{{asset('admin/goods.css')}}" /> -->
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<link  rel="stylesheet" type="text/css" href="{{asset('admin/lib/webuploader/0.1.5/webuploader.css')}}" />
</head>
<body>
<div class="page-container">

        <div id="tab-system" class="HuiTab">
            <div class="tabBar cl">
                <span>添加商品信息</span>
            </div>
            <!-- <div class="tabCon"> -->
            <form action="{{url('/uploadimg')}}" method="post" enctype="multipart/form-data" onsubmit="return checkVaild();">
            {{ csrf_field() }}
            @include('Common/tip')
        	<div class="row cl">
        		<label class="form-label col-xs-4 col-sm-2">分类:</label>
        		<div class="formControls col-xs-8 col-sm-6 cate">
                    <select name="p_id" id="type_name">
                        <option value="-1">--请选择--</option>
                    @foreach($cateres as $v)
                        <option value="{{$v->id}}">{{$v->type_name}}</option>
                    @endforeach
                    </select>
        		</div>
        	</div>
            <input type="hidden" name="brand_id">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">品牌:</label>
                <div class="formControls col-xs-8 col-sm-6 brand">
                    <select name="brand_name" id="brand_name">
                        <option value="-1">--请选择--</option>
                         @foreach($branddata as $value)
                        <option class="brand_name" value="{{$value->brand_id}}">{{$value->brand_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        	<div class="row cl">
        		<label class="form-label col-xs-4 col-sm-2"> 商品名:</label>
        		<div class="formControls col-xs-8 col-sm-6">
        			<input type="text" name="goods_name" class="input-text" placeholder="商品名" >
        		</div>
        	</div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">单价:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" name="price" class="input-text" placeholder="单价" >
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">现价:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" name="present_price" class="input-text" placeholder="现价" >
                </div>
            </div>
        	<div class="row cl">
        		<label class="form-label col-xs-4 col-sm-2"> 库存量:</label>
        		<div class="formControls col-xs-8 col-sm-6">
        			<input type="text" name="store_count" class="input-text" placeholder="库存量" >
                </div>
        	</div>
        	<div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">商品描述:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" name="goods_remark" placeholder="商品描述" class="input-text">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">销量:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" name="sales_num" placeholder="商品销量" class="input-text">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">商品图片:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="file" name="pic" vlaue="">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">是否上架:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="radio" name="status"  value="1" checked>上架
                    <input type="radio" name="status" value="0">下架
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">是否热销:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="radio" name="is_hot" value="0" checked>正常
                    <input type="radio" name="is_hot" value="1">热销
                </div> 
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button class="btn btn-primary radius goodsbtn"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
                    <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
    <!-- </div> -->
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
<!-- <script type="text/javascript" src="{{asset('admin/lib/webuploader/0.1.5/webuploader.min.js')}}"></script> -->
<script type="text/javascript" src="{{asset('admin/lib/ueditor/1.4.3/ueditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/ueditor/1.4.3/ueditor.all.min.js')}}"> </script>
<script type="text/javascript" src="{{asset('admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js')}}"></script>
<script type="text/javascript">

function checkVaild () {
    var type_name = $('#type_name').val();
    if (type_name == -1) {
        layer.msg('请选择分类', {icon: 6});
        return false;
    }

    var brand_name = $('#brand_name').val();
    if (brand_name == -1) {
        layer.msg('请选择商品品牌', {icon: 6});
        return false;
    }

    var goods_name = $('input[name="goods_name"]').val();
    if (goods_name.length == 0) {
        layer.msg('请填写商品名称', {icon: 6});
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

    var store_count = $('input[name="store_count"]').val();
    if (store_count.length == 0) {
        layer.msg('请填写库存量', {icon: 6});
        return false;
    }

    var goods_remark = $('input[name="goods_remark"]').val();
    if (goods_remark.length == 0) {
        layer.msg('请填写商品描述', {icon: 6});
        return false;
    }

    var sales_num = $('input[name="sales_num"]').val();
    if (sales_num.length == 0) {
        layer.msg('请填写销量', {icon: 6});
        return false;
    }

    var pic = $('input[name="pic"]').val();
    if (pic.length == 0) {
        layer.msg('请选择要上传的图片', {icon: 6});
        return false;
    }
    return true;
}
</script>
</body>
</html>
