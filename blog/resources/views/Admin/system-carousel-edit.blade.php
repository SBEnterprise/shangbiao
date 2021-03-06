﻿<!--_meta 作为公共模版分离出去-->
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
	产品管理
	<span class="c-gray en">&gt;</span>
	轮播图管理
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
    <form action="{{url('/admin/editCarousel')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('Common/tip')
    <div id="tab-system" class="HuiTab">
        <div class="tabBar cl">
            <span>修改轮播图信息</span>
        </div>
        <div class="tabCon">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    id
                </label>
                <div class="formControls col-xs-8 col-sm-6">
					<input type="text"  name="cid" class="input-text" disabled value="{{ $editData->id }}" />
                    <input type="hidden" name="c_id" value="{{ $editData->id }}" />
				</div>
			</div>
            <br>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    说明
                </label>
                <div class="formControls col-xs-8 col-sm-6">
                    <textarea  cols="85" rows="5" name="title">{{ $editData->title }}</textarea>
                </div>
            </div>
            <br>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    链接地址
                </label>
                <div class="formControls col-xs-8 col-sm-6" id="storecount-error">
                    <input type="text"  name="path_url" class="input-text" value="{{ $editData->path_url }}" >
                </div>
            </div>
            <br>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">是否使用:</label>
                <div class="formControls col-xs-8 col-sm-6">
                @if( $editData->status == 1 )
                    <input type="radio" name="status" value="1" checked>启用
                    <input type="radio" name="status" value="0" >禁用
                @else
                    <input type="radio" name="status" value="1" >启用
                    <input type="radio" name="status" value="0" checked>禁用
                @endif
                </div>
            </div>
            <br>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">图片:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <img src="{{$editData->pic_url}}" width="630"><br>
                    <input type="file" name="pic" value="{{$editData->pic_url}}">
                </div>
            </div>
        </div>
        <br>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">
                <span class="c-red">*</span>
                修改时间
            </label>
            <div class="formControls col-xs-8 col-sm-6">
                <input type="text"  name="updated_at" class="input-text" value="{{ $editData->updated_at }}" disabled>
            </div>
        </div>
        <br>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">
                <span class="c-red">*</span>
                添加时间
            </label>
            <div class="formControls col-xs-8 col-sm-6">
                <input type="text"  name="created_at" class="input-text" value="{{ $editData->created_at }}" disabled>
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
    <div class="formControls col-xs-4 col-sm-2" style="height:20px;"></div>
    <div id="error" class="formControls col-xs-4 col-sm-6 btn btn-success" style="display:none;height:28px;"></div>
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

</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
