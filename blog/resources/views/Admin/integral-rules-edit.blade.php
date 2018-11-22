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
    <form class="form form-horizontal" id="form-article-add" onsubmit="return false">
        <div id="tab-system" class="HuiTab">
            <div class="tabBar cl">
                <span>修改积分规则</span>
            </div>
            <!-- <input type="hidden" name="brand_id" id="website-Keywords" class="input-text"> -->
        	<div class="row cl">
        		<label class="form-label col-xs-4 col-sm-2"> 积分获取:</label>
        		<div class="formControls col-xs-8 col-sm-6">
        			<input type="text" value="{{$oneIntegral->obtain}}" editid="{{$oneIntegral->id}}" name="obtain" id="website-description" class="input-text" placeholder="积分获取" >
        		</div>
        	</div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">积分项目:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" value="{{$oneIntegral->object}}" name="object" id="website-uploadfile" class="input-text" placeholder="积分项目" >
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">积分说明:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" value="{{$oneIntegral->integralexplain}}"  name="integralexplain" id="website-uploadfile" class="input-text" placeholder="积分说明" >
                </div>
            </div>
        	<div class="row cl">
        		<label class="form-label col-xs-4 col-sm-2"> 积分兑换:</label>
        		<div class="formControls col-xs-8 col-sm-6">
        			<input type="text"  value="{{$oneIntegral->integralconvert}}" name="integralconvert" id="website-static" class="input-text" placeholder="积分兑换" >
                </div>
        	</div>
        	<div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">积分特权:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text"  value="{{$oneIntegral->privilege}}" name="privilege" id="website-copyright" placeholder="积分特权" class="input-text">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">积分兑现金:</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input type="text" value="{{$oneIntegral->cash}}" name="cash" id="website-copyright" placeholder="积分兑现金" class="input-text">
                </div>
            </div>
            <div class="formControls col-xs-4 col-sm-1" style="height:20px;"></div>
            <div class="formControls col-xs-4 col-sm-5 serror btn btn-success" style="display:none;height:28px;"></div>
            <!-- <div class="serror" style="height:20px;border:1px solid red"></div> -->
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button class="btn btn-primary radius pbtn"><i class="Hui-iconfont">&#xe632;</i> 修改</button>
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


$('button.pbtn').click(function () {
   
    var obtain = $('input[name="obtain"]').val();
    var object = $('input[name="object"]').val();
    var integralexplain = $('input[name="integralexplain"]').val();
    var integralconvert = $('input[name="integralconvert"]').val();
    var privilege = $('input[name="privilege"]').val();
    var cash = $('input[name="cash"]').val();
    var idedit = $('input[name="obtain"]').attr('editid');
    // console.log(obtain);
    
    $.ajax({
            type: 'post',
            dataType:'json',
            url: '{{url("admin/integraleditdata")}}',
            data: 'idedit='+idedit+'&obtain='+obtain+'&object='+object+'&integralexplain='+integralexplain+'&integralconvert='+integralconvert+'&privilege='+privilege+'&cash='+cash+'&_token={{csrf_token()}}',
            success:function (data) {
            //接收修改方法返回来的信息
            if(data.status == 1) {

                    //修改成功
                    layer.msg(data.msg,{icon:1,time:4000});
                    location.href ='{{ url("admin/integral-rules") }}';
            } else if (data.status == 0) {
                    //修改失败
                    layer.msg(data.msg,{icon:1,time:4000});
            }
        },
            error:function(data) {
                console.log(data.msg);
            },
            
        }); 


    // $.post(
    //     '{{url("/paction")}}',
    //     brand_name, brand_name, goods_name: goods_name,
    //     price: price, prsent_price: present_price,
    //     store_count: store_count, goods_remark: goods_remark,
    //     sales_num: sales_num, goods_pic: goods_pic,
    //     status: status, is_hot: is_hot,
    //     _token: '{{ csrf_token() }}',
    //     },
    //     function (data) {
    //         if (data.status==0) {
    //             $('div.serror').html(data.msg).css('display', 'block');
    //             setTimeout(function () {
    //                 window.parent.location.reload();
    //             }, 3000);
    //         } else {
    //             $('div.serror').html(data.msg).css('display', 'block');
    //             setTimeout(function () {
    //                     window.parent.location.reload();
    //             }, 3000);
    //         }
    //     },
    //     'json'
    // );
});


</script>
</body>
</html>