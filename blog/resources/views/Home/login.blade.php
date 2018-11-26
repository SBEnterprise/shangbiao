<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2, user-scalable=yes">
	<meta http-equiv="Cache-Control" content="no-transform"/>
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>登录页 - 上表企业官方商城</title>
	<script>
	// flexible 代码
	;(function(designWidth, maxWidth) {
		var doc = document,
			win = window;
		var docEl = doc.documentElement;
		var tid;
		var rootItem,rootStyle;
		function refreshRem() {
			var width = docEl.getBoundingClientRect().width;
			if (!maxWidth) {
				maxWidth = 540;
			};
			if (width > maxWidth) {
				width = maxWidth;
			}
			//与淘宝做法不同，直接采用简单的rem换算方法1rem=100px
			var rem = width * 100 / designWidth;
			//兼容UC开始
			rootStyle="html{font-size:"+rem+'px !important}';
			rootItem = document.getElementById('rootsize') || document.createElement("style");
			if(!document.getElementById('rootsize')){
			document.getElementsByTagName("head")[0].appendChild(rootItem);
			rootItem.id='rootsize';
			}
			if(rootItem.styleSheet){
			rootItem.styleSheet.disabled||(rootItem.styleSheet.cssText=rootStyle)
			}else{
			try{rootItem.innerHTML=rootStyle}catch(f){rootItem.innerText=rootStyle}
			}
			//兼容UC结束
			docEl.style.fontSize = rem + "px";
		};
		refreshRem();

		win.addEventListener("resize", function() {
			clearTimeout(tid); //防止执行两次
			tid = setTimeout(refreshRem, 300);
		}, false);

		win.addEventListener("pageshow", function(e) {
			if (e.persisted) { // 浏览器后退的时候重新计算
				clearTimeout(tid);
				tid = setTimeout(refreshRem, 300);
			}
		}, false);

		if (doc.readyState === "complete") {
			doc.body.style.fontSize = "16px";
		} else {
			doc.addEventListener("DOMContentLoaded", function(e) {
				doc.body.style.fontSize = "16px";
			}, false);
		}
	})(640, 640);
	</script>


	<!-- 引入外部 CSS -->
	<link rel="stylesheet" href="{{asset('common/home/css/normalize.css')}}">
	<link rel="stylesheet" href="{{asset('common/bootstrap-3.3.7/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('common/home/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('common/home/css/common.css')}}">
	<link rel="stylesheet" href="{{asset('common/home/css/login.css')}}">

	<!-- HTML5 Shiv 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
	<!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
	<!--[if lt IE 9]>
	 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	 <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

	<!-- 引入外部 js  -->
	<script src="{{asset('common/home/js/jquery.min.js')}}"></script>
	<script src="{{asset('common/bootstrap-3.3.7/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('common/home/js/common.js')}}"></script>
	<script src="{{asset('common/home/js/login.js')}}"></script>

</head>
<body>

	<!-- start head -->
	<header>
		<div class="container">
			<div class="row">
				<a href="javascript:;" class="logo"><img src="{{asset('common/home/images/logo.png')}}" alt="上表企业官方商城"></a>
			</div>
		</div>
	</header>
	<!-- end head -->
	
	<!-- start content -->
	<div id="content">
		<div class="container">
			<div class="row">
				<!-- start 标准登陆框 -->
				<div class="loginwrap">
					<div class="switchbar"><a href="javascript:;" class="active">手机验证登录</a><span>|</span><a href="javascript:;">账号登录</a></div>

					<!-- start 手机验证码登陆 -->
					<form id="quickmode">
						<div id="telnumber" class="inputcontainers">
							<input type="text" name="telnumber" placeholder="请输入手机号" data-focus="0" aria-label="手机号">
							<div class="inputicons"><img src="{{asset('common/home/images/login/mobile-icon.png')}}" alt="上表企业官方商城"></div>
							<p class="telnumbertips formtips" style="display: none;">手机号码不能为空</p>
						</div>
						<div id="idtfcode" class="inputcontainers clearfix">
							<input type="text" name="idtfcode" placeholder="请输入验证码" class="pull-left" aria-label="短信验证码">
							<button class="getidtfcode pull-right" data-idtfcode="8888">获取验证码</button>
							<div class="inputicons"><img src="{{asset('common/home/images/login/safe-icon.png')}}" alt="上表企业官方商城"></div>
							<p class="idtfcodetips formtips" style="display: none;">请输入短信动态码</p>
						</div>
						<button class="loginbtn">立刻登录</button>
						<div class="toolsbar clearfix">
							<a href="{{url('/home/register')}}" class="toregister pull-left">免费注册</a>
							<a href="javascript:;" class="getpassback pull-right">忘记密码</a>
						</div>
						<div class="otherchoices">
							<div class="title clearfix">
								<span class="bar pull-left"></span>
								<span class="textbar">其他方式登陆</span>
								<span class="bar pull-left"></span>
							</div>
							<div class="logingroups clearfix">
								<a href="javascript:;"><img src="{{asset('common/home/images/login/weixin-icon.png')}}" alt="上表企业官方商城"></a>
								<a href="javascript:;"><img src="{{asset('common/home/images/login/zhifubao-icon.png')}}" alt="上表企业官方商城"></a>
								<a href="javascript:;"><img src="{{asset('common/home/images/login/xinlang-icon.png')}}" alt="上表企业官方商城"></a>
							</div>
						</div>
					</form>
					<!-- end 手机验证码登陆 -->

					<!-- start 账号密码登陆 .-->
					<form id="classicalmode" style="display: none;">
						<div id="username" class="inputcontainers">
							<input type="text" name="username" placeholder="请输入用户名">
							<div class="inputicons"><img src="{{asset('common/home/images/login/people-icon.png')}}" alt="上表企业官方商城"></div>
							<p class="usernametips formtips" style="display: none;">用户名不能为空</p>
						</div>
						<div id="password" class="inputcontainers clearfix">
							<input type="password" name="password" placeholder="请输入密码">
							<div class="inputicons"><img src="{{asset('common/home/images/login/lock-icon.png')}}" alt="上表企业官方商城"></div>
							<div class="passwordicon" data-display="0"><img src="{{asset('common/home/images/login/attention-down-icon.png')}}" alt="上表企业官方商城"></div>
							<p class="passwordtips formtips" style="display: none;">密码不正确</p>
						</div>
						<button class="loginBtn">立刻登录</button>
						<div class="toolsbar clearfix">
							<a href="{{url('/home/register')}}" class="toregister pull-left">免费注册</a>
							<a href="javascript:;" class="getpassback pull-right">忘记密码</a>
						</div>
						<div class="otherchoices">
							<div class="title clearfix">
								<span class="bar pull-left"></span>
								<span class="textbar">其他方式登陆</span>
								<span class="bar pull-left"></span>
							</div>
							<div class="logingroups clearfix">
								<a href="javascript:;"><img src="{{asset('common/home/images/login/weixin-icon.png')}}" alt="上表企业官方商城"></a>
								<a href="javascript:;"><img src="{{asset('common/home/images/login/zhifubao-icon.png')}}" alt="上表企业官方商城"></a>
								<a href="javascript:;"><img src="{{asset('common/home/images/login/xinlang-icon.png')}}" alt="上表企业官方商城"></a>
							</div>
						</div>
					</form>
					<!-- end 账号密码登陆 -->
				</div>
				<!-- end 标准登陆框 -->
			</div>
		</div>
	</div>
	<!-- end content -->

	<!-- start foot -->
	<footer>
		<div class="container">
			<div class="foot-info">
				<p>上表企业官方商城 版权所有 2018-2027 ICP 备案证书号：粤ICP备09108738号 网监备案号：4401060103141</p>
				<p>上表企业管理（广州）有限公司 地址：广州市天河区中山大道建中路5号1106房</p>
				<p>Copyright 2018-2027 WWW.BESTSHANGBIAO.CN.LTD ALL RIGHT RESERVED.</p>
			</div>
			<div class="wanganbeian">
				<a href="javascript:;"><img src="{{asset('common/home/images/login/wj.gif')}}" alt="上表企业官方商城"></a>
			</div>
		</div>
	</footer>
	<!-- end foot -->
	
	<script>

	</script>
</body>
</html>