
$(function() {
 
	// 常量

	const TEL_REG = /^(0|86|17951)?(13[0-9]|15[012356789]|16[6]|17[012345678]|18[0-9]|14[5679]|19[891])[0-9]{8}$/;
	const USERNAME_REG =  /^[a-zA-Z][a-zA-Z0-9_-]{3,10}$/;
	const PASSWORD_REG = /^\S{6,20}$/;


	// 切换登录模式的脚本

	$('.switchbar a').on('click', function() {
		var c = $(this).attr('class');
		var t = $(this).text();
		$(this).addClass('active').siblings().removeClass('active');
		if (c == 'active') return;
		if (t != '手机验证登录') {
			$('#quickmode').hide();
			$('#classicalmode').show();
		} else {
			$('#quickmode').show();
			$('#classicalmode').hide();
		}
	});

	// 实现获取验证码延迟的脚本
	
	$('.getidtfcode').on('click', function(e) {
		// e.preventDefault(); // 对于 form 中 button 自动提交无效
		var countdown = 60;
		var timeId = null;
		var _this = $(this);
		$(this).attr('disabled', 'true');
		timeId = setInterval(function() {
			countdown--;
			_this.html(countdown+' 后可重新获取');
			if (countdown < 1) {
				_this.text('获取验证码');
				$(this).attr('disabled', 'false');
				clearInterval(timeId);
			}
		}, 1000);
		return false;
	});

	// 输入框验证显示提示的脚本（手机验证登录）

	$('input[name=telnumber]').on('blur', function() { // 手机号码框
		var c = $(this).val();
        var tel_reg = !!c.match(TEL_REG); //手机号码验证
        if (!c) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码还没填');
        } else if (c.length >= 12 || isNaN(c)) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码只能是数字而且长度小于12位');
        } else if (!tel_reg) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码格式错误，请检查');
        } else {
        	$('.telnumbertips').hide();
        }
	});
	$('input[name=idtfcode]').on('focus', function() { // 手机号码框 到 验证码框
		var c = $('input[name=telnumber]').val();
        var tel_reg = !!c.match(TEL_REG); //手机号码验证
        if (!tel_reg) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('请先填写有效的手机号码并获取验证码');
		}
	});

	// 输入框验证显示提示的脚本（账号登录}

	$('input[name=username]').on('blur', function() { // 用户名框
		var c = $(this).val();
        var username_reg = !!c.match(USERNAME_REG); // 用户名格式验证
        if (!c) {
        	$('.usernametips').fadeIn();
        	$('.usernametips').text('用户名为空');
        } else if (!username_reg) {
        	$('.usernametips').fadeIn();
        	$('.usernametips').text('用户名输入错误，请检查');
        } else {
        	$('.usernametips').hide();
        }
	});

	// 用户登录前的判断处理脚本

	$('#quickmode .loginBtn').on('click', function(e) { // 手机验证登陆
		e.preventDefault(); // 可以取消点击 form 中 button 触发的默认提交
		var c_tel = $('input[name=telnumber]').val();
		var c_code = $('input[name=idtfcode]').val();
        var tel_reg = !!c_tel.match(TEL_REG); //手机号码验证
        var data = {
        	telnumber: c_tel,
        	idtfcode: c_code,
        	submit: true
        };


        if (!c_tel) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码还没填');
        	console.log(c_tel);
        } else if (c_tel.length >= 12 || isNaN(c_tel)) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码只能是数字而且长度小于12位');
        } else if (!tel_reg) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码格式错误，请检查');
        } else {
        	$('.telnumbertips').hide();
/*	        $.post('http://sg.shwatch.cn/test_api.php', data, function(data) {
	            data=JSON.parse(data);
	            if(data.success == true){
	            	alert('ok!');
	            }else{
	                alert(data.error);
	            }
	        });*/
	        return false;
        }
	});
	$('#classicalmode .loginBtn').on('click', function(e) { // 账号密码登陆
		e.preventDefault(); // 可以取消点击 form 中 button 触发的默认提交
		var c_username = $('input[name=username]').val();
		var c_password = $('input[name=password]').val();
        var username_reg = !!c_username.match(USERNAME_REG); //用户名验证
        var data = {
        	username: c_username,
        	password: c_password,
        	submit: true
        };

        if (!c_username) {
        	$('.usernametips').fadeIn();
        	$('.usernametips').text('用户名为空');
        	console.log(c_username);
        } else if (!username_reg) {
        	$('.usernametips').fadeIn();
        	$('.usernametips').text('用户名输入错误，请检查');
        } else {
        	$('.usernametips').hide();
/*	        $.post('http://sg.shwatch.cn/test_api.php', data, function(data) {
	            data=JSON.parse(data);
	            if(data.success == true){
	            	alert('ok!');
	            }else{
	                alert(data.error);
	            }
	        });*/
	        return false;
        }
	});

	// 密码输入框密码显示方式的切换的实现脚本

	$('.passwordicon').on('click', function() {
		var data = $(this).data('display');
		if (data == 1) {
			$(this).siblings('input').attr('type', 'password');
			$(this).find('img').attr('src', '/common/home/images/login/attention-down-icon.png');
			$(this).data('display', '0');
		} else {
			$(this).siblings('input').attr('type', 'text');
			$(this).find('img').attr('src', '/common/home/images/login/attention-up-icon.png');
			$(this).data('display', '1');
		}
	});
});