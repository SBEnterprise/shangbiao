
$(function() {

	var idtfcode = '';

	// 实现获取验证码延迟的脚本
	
	$('.getidtfcode').on('click', function(e) {
		e.preventDefault();
		var countdown = 5;
		var timeId = null;
		$(this).attr('disabled', true);
		timeId = setInterval(() => {
			countdown--;
			$(this).html(countdown+' 后可重新获取');
			if (countdown == 4) {
				idtfcode = '8888';
			}
			if (countdown < 1) {
				$(this).text('获取验证码');
				$(this).attr('disabled', false);
				clearInterval(timeId);
			}
		}, 1000);
	});

	// 用户成功注册前的判断处理脚本

	$('.registerbtn').on('click', function(e) { // 账号密码登陆
		console.log(idtfcode)
		e.preventDefault(); // 可以取消点击 form 中 button 触发的默认提交
		var c_username = $('input[name=username]').val();
		var c_email = $('input[name=email]').val();
		var c_password = $('#password input').val();
		var c_repassword = $('#repassword input').val();
		var c_tel = $('input[name=telnumber]').val();
		var c_code = $('input[name=idtfcode]').val();
		var c_read = $('input[type=checkbox]:checked').length;
        var username_reg = !!c_username.match(USERNAME_REG); //用户名验证
        var tel_reg = !!c_tel.match(TEL_REG); //手机号码验证
        var email_reg = !!c_email.match(EMAIL_REG); //手机号码验证
        var password_reg = !!c_password.match(PASSWORD_REG); //手机号码验证

        var data = {
        	username: c_username,
        	email: c_email,
        	password: c_password,
        	telnumber: c_tel
        };

        if (!c_username) { 							// 用户名
        	$('.usernametips').fadeIn();
        	$('.usernametips').text('用户名为空');
        } else if (!username_reg) {
        	$('.usernametips').fadeIn();
        	$('.usernametips').text('用户名以字母开头，由4-11位字母、数字和下划线"_"组合');
        } else {
        	$('.usernametips').hide();
        }

        if (!c_email) { 							// 邮箱
        	$('.emailtips').fadeIn();
        	$('.emailtips').text('邮箱账号为空');
        } else if (!email_reg) {
        	$('.emailtips').fadeIn();
        	$('.emailtips').text('邮箱格式有误，请重新输入');
        } else {
        	$('.emailtips').hide();
        }

        if (!c_password) { 							// 密码
        	$('.passwordtips').fadeIn();
        	$('.passwordtips').text('密码为空');
        } else if (!password_reg) {
        	$('.passwordtips').fadeIn();
        	$('.passwordtips').text('密码由6-20位字母、数字和符号组合');
        } else {
        	$('.passwordtips').hide();
        }

        if (c_password != c_repassword) { 		    // 再次输入密码 
        	$('.repasswordtips').fadeIn();
        	$('.repasswordtips').text('两次密码输入不一致');
        } else {
        	$('.repasswordtips').hide();
        }

        if (!c_tel) { 							    // 手机号码
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码为空');
        } else if (c_tel.length >= 12 || isNaN(c_tel)) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码只能是数字而且长度小于12位');
        } else if (!tel_reg) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码格式有误，请重新输入');
        } else {
        	$('.telnumbertips').hide();
        }

        if (!c_read) {
        	alert('请阅读《上表商城用户协议》');
        }

        if (!c_code) { 							// 验证码
        	$('.idtfcodetips').fadeIn();
        	$('.idtfcodetips').text('验证码为空');
		} else if (c_code != idtfcode) {
        	$('.idtfcodetips').fadeIn();
        	$('.idtfcodetips').text('验证码错误，请重新输入');
		} else {
			alert('注册成功！');
		}
	});

	// 密码输入框密码显示方式的切换的实现脚本

	$('.passwordicon').on('click', function() {
		var data = $(this).data('display');
		if (data == 1) {
			$(this).siblings('input').attr('type', 'password');
			$(this).find('img').attr('src', 'images/login/attention-down-icon.png');
			$(this).data('display', '0');
		} else {
			$(this).siblings('input').attr('type', 'text');
			$(this).find('img').attr('src', 'images/login/attention-up-icon.png');
			$(this).data('display', '1');
		}
	});
});