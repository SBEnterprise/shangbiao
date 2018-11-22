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
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>我的桌面</title>
</head>
<body>
<div class="page-container">
	<!-- <p class="f-20 text-success">欢迎使用H-ui.admin <span class="f-14">v3.1</span>后台模版！</p>
	<p>登录次数：18 </p>
	<p>上次登录IP：222.35.131.79.1  上次登录时间：2014-6-14 11:19:55</p> -->
	<table class="table   table-bg">
		<?php $arr = ['未确定', '已确定', '等待买家确定收货', '交易成功', '无效订单', '退货', '交易成功'];?>
		<?php $pay = ['未支付', '已支付'] ?>
		<thead>
			<tr>
				<th colspan="2" scope="col">
					<label>订单信息：</label>			
					<label style="margin-right: 30px">{{$order->add_time}} </label>
					<label style="margin-right: 40px">订单号：{{$order->order_sn}}</label> 
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width="10%">收货地址</td>
				<td>
					<span id="lbServerName">收货人：<input type="text" name="consignee" value="{{$order->consignee}}"></span>
					<span id="lbServerName">联系方式：<input type="text" name="phone" value="{{$order->phone}}"></span>
					<span id="lbServerName">详细地址：<input type="text" name="address" value="{{$order->address}}" size="80"></span>
				</td>
			</tr>
			<tr>
				<td>物流信息</td>
				<td><input type="text" name="shipping_name" value="{{$order->shipping_name}}"></td>
			</tr>
			
			<tr>
				<td>订单状态</td>
				<td>{{ $arr[$order->order_status] }}</td>
			</tr>
			<tr>
				<td>支付状态 </td>
				<td>{{$pay[$order->pay_status]}}</td>
			</tr>
			<tr>
				<td>使用积分兑换</td>
				<td><input type="text" name="integral_money" value="{{$order->integral_money}}"></td>
			</tr>
		
			<tr>
				<td>总金额 </td>
				<td><input type="text" name="total_amount" value="{{$order->total_amount}}"></td>
			</tr>

			<tr>
				<td>买家留言</td>
				<td>{{$order->user_note}}</td>
			</tr>
			<tr>
				<td><button class="btn btn-primary" type="submit" id="submit" oid="{{$order->order_id}}">保存</button></td>
			</tr>
		</tbody>
	</table>

	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th colspan="7" scope="col">
					<label>商品信息：</label>
				
					
					<!-- <label style="float: right;margin-right: 40px">总金额：{{$order->total_amount}}</label> -->
				</th>
			</tr>
			<tr class="text-c">
				<th colspan="2" >商品信息</th>
				<th width="100">单价</th>
				<th width="100">购买数量</th>
				<th width="100">金额</th>
				<th width="100">订单状态</th>
			</tr>
		</thead>
		<tbody>
			@foreach($goods as $v)
			<tr class="text-c">
				<td width="50"><img src="{{url('/common/home/images/3412_183_24_30_27_27885.jpg')}}" width="50" height="50"></td>
				<td width="200">{{$v->goods_name}}</td>
				<td>{{$v->goods_price}}</td>
				<td>{{$v->goods_num}}</td>
				<td>{{$v->goods_num*$v->goods_price}}</td>
				<td>{{$arr[$order->order_status]}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<footer class="footer mt-20">
	<div class="container">
		<p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br>
			Copyright &copy;2015-2017 H-ui.admin v3.1 All Rights Reserved.<br>
			本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
	</div>
</footer>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script> 
<!--此乃百度统计代码，请自行删除-->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<script type="text/javascript">
	$('#submit').click(function () {
		var oid = $(this).attr('oid');
		var consignee = $('input[name="consignee"]').val();
		var phone = $('input[name="phone"]').val();
		var address = $('input[name="address"]').val();
		var shipping_name = $('input[name="shipping_name"]').val();
		var integral_money = $('input[name="integral_money"]').val(); 
		var total_amount = $('input[name="total_amount"]').val();

		$.ajax({
		    type:'post',
		    url: "{{url('/admin/orderupdate')}}",
		    data: 'oid='+oid+'&_token={{csrf_token()}}'+'&consignee='+consignee+'&phone='+phone+'&address='+address+'&shipping_name='+shipping_name+'&integral_money='+integral_money+'&total_amount='+total_amount,
		    success:function (data) {
		        console.log(data);
		        if (data==200) {
		            alert('修改成功！');
		            location.href = '{{url("/admin/orderview")}}';
		        }
		    },
		    dataType:'json'

		})
	})
</script>

</body>
</html>