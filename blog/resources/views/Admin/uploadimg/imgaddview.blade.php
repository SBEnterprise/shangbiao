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
<link rel="stylesheet" type="text/css" href="{{asset('common/bootstrap-3.3.7/css/bootstrap.min.css')}}" />
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
    <form class="form form-horizontal" id="form-article-add" action="{{url('/admin/uploadimg')}}" method="post" enctype="multipart/form-data">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div id="tab-system" class="HuiTab">
            <div class="tabBar cl">
                <span>添加商品属性</span>
            </div>
             @include('Common/tip')
        	<div class="row cl">
        		<label class="form-label col-xs-4 col-sm-2">商品名称</label>
        		<div class="formControls col-xs-8 col-sm-6 cate">
                    <select name="goods_id">
                        <option value="-1">--请选择商品--</option>
                        @foreach($goods as $v)
                            <option value="{{$v->id}}">{{$v->goods_name}}</option>
                        @endforeach
                    </select>
        			
        		</div>
        	</div>

             <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">展示位置:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="radio" name="show" id="type1" value="0">主图显示&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="show" id="type2" value="1">详情显示
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">商品图片:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="file" name="pic" id="website-copyright" vlaue="">
                </div>
            </div>

            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary radius pbtn"><i class="Hui-iconfont">&#xe632;</i>上传</button>
                    <!-- <button class="btn btn-default radius" type="button"></button> -->
                </div>
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
<!-- <script type="text/javascript" src="{{asset('admin/lib/webuploader/0.1.5/webuploader.min.js')}}"></script> -->
<script type="text/javascript" src="{{asset('admin/lib/ueditor/1.4.3/ueditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/ueditor/1.4.3/ueditor.all.min.js')}}"> </script>
<script type="text/javascript" src="{{asset('admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js')}}"></script>
<script type="text/javascript">
//上传图片
// var pic = '';
/*function doUpload() {
     var formData = new FormData($( "#uploadForm" )[0]);
     $.ajax({
          url: '{{url("/upload")}}' ,
          type: 'POST',
          data: formData,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function (msg) {
            $('div.serror').html(msg.data['key']);
            // pic = msg.data['key'];
          },
          error: function (returndata) {
              // console.log(returndata);
              alert('上传失败，请重试');
          }
     });
     return false;
}*/
var id = '';
$('document').ready(function () {
    $('div.cate').on('change', 'select', function () {
        id = $(this).val();
        // console.log(id);
        $.get(
            '{{url("/typeaction")}}/'+id,
            function(data){
                var str= '';
                // console.log(data.data[0].brand_id);
                for (var i=0; i<data.data.length; i++) {
                    str += '<option value="'+data.data[i].brand_id+'">'+data.data[i].brand_name+'</option>';
                    // $('input[name="brand_id"]').val(data.data[i].brand_id);
                // str += '<option value="'+data.data.p_id+'">'+data.data.brand_name+'</option>';
                }
                $('select#brand_name')[0].options.length = 1;
                $('select#brand_name').append(str);
            },
            'json'
        );
    });
});

var brand_id;
$('div.brand').on('change', 'select', function () {
    brand_id = $(this).val();
});


$('button.pbtn').click(function () {
    var brand_id = brand_id;
    console.log(brand_id);
    // var p_id = $('input[name="type_name"]').val();
    // var brand_id = $('input[name="brand_id"]').val();
    var brand_name = $('input[name="brand_name"]').val();
    var goods_name = $('input[name="goods_name"]').val();
    var price = $('input[name="price"]').val();
    var present_price = $('input[name="present_price"]').val();
    var store_count = $('input[name="store_count"]').val();
    var goods_remark = $('input[name="goods_remark"]').val();
    var sales_num = $('input[name="sales_num"]').val();
    // var goods_pic = $('input[name="file"]').val();
    var goods_pic = 'http://owtstcm4k.bkt.clouddn.com';
    var status = $('input[name="status"]').val();
    var is_hot = $('input[name="is_hot"]').val();
    // console.log(goods_pic);
    $.post(
        '{{url("/paction")}}',
        {brand_id: brand_id,
        brand_name, brand_name, goods_name: goods_name,
        price: price, prsent_price: present_price,
        store_count: store_count, goods_remark: goods_remark,
        sales_num: sales_num, goods_pic: goods_pic,
        status: status, is_hot: is_hot,
        _token: '{{ csrf_token() }}',
        },
        function (data) {
            if (data.status==0) {
                $('div.serror').html(data.msg).css('display', 'block');
                setTimeout(function () {
                    window.parent.location.reload();
                }, 3000);
            } else {
                $('div.serror').html(data.msg).css('display', 'block');
                setTimeout(function () {
                        window.parent.location.reload();
                }, 3000);
            }
        },
        'json'
    );
});


</script>
</body>
</html>