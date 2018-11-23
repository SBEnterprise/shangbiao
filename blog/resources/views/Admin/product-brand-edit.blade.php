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
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/add/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />
<!-- <link rel="stylesheet" type="text/css" href="{{asset('admin/goods.css')}}" /> -->
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<link href="{{asset('admin/lib/webuploader/0.1.5/webuploader.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page-container">
    <form class="form form-horizontal" id="form-article-add" action="{{url("/admin/branddata")}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <!-- 页面接收到数据库过来的的id，做隐藏域 -->
        <input type="hidden" name="id" value="{{$brandeditdata->id}}">
        <div id="tab-system" class="HuiTab">
            <div class="tabBar cl">
                <span>修改品牌属性</span>
            </div>
            <!-- <div class="tabCon"> -->       
        	<div class="row cl">
        		<label class="form-label col-xs-4 col-sm-2"> 品牌名称:</label>
        		<div class="formControls col-xs-8 col-sm-6">
        			<input type="text" name="brand_name" value="{{$brandeditdata->brand_name}}" id="website-description" class="input-text" placeholder="品牌名称" >
        		</div>
        	</div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">品牌编号:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" name="brand_id" value="{{$brandeditdata->brand_id}}" id="website-uploadfile" id="brandid" class="input-text" placeholder="品牌编号" >
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">品牌分类ID:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" name="pid"  value="{{$brandeditdata->p_id}}"id="website-copyright" placeholder="品牌分类id" class="input-text">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">网站地址:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" name="site_url" value="{{$brandeditdata->site_url}}" id="website-uploadfile" class="input-text" placeholder="网站地址" >
                </div>
            </div>
        	<div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">品牌说明:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" name="brand_desc" value="{{$brandeditdata->brand_desc}}" id="website-copyright" placeholder="品牌说明" class="input-text">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">品牌LOGO:</label>
                <div class="formControls col-xs-8 col-sm-6">
               
                <input name="pic" type="file" value="{{$brandeditdata->brand_logo}}" placeholder="选择图片" />
            </div>
            </div>
            <div class="formControls col-xs-4 col-sm-1" style="height:20px;"></div>
            <div class="formControls col-xs-4 col-sm-5 serror btn btn-success" style="display:none;height:28px;"></div>
            <!-- <div class="serror" style="height:20px;border:1px solid red"></div> -->
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button class="btn btn-primary radius pbtn"><i class="Hui-iconfont">&#xe632;</i>修改</button>
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


</script>
</body>
</html>