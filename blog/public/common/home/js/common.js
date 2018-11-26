
	// 常量

	const USERNAME_REG =  /^[a-zA-Z][a-zA-Z0-9_-]{3,10}$/;
	const EMAIL_REG = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
	const TEL_REG = /^(0|86|17951)?(13[0-9]|15[012356789]|16[6]|17[012345678]|18[0-9]|14[5679]|19[891])[0-9]{8}$/;
	const PASSWORD_REG = /^\S{6,20}$/;

$(function() {
	
	// 输入框验证显示提示的脚本

	$('input[name=username]').on('blur', function() { // 用户名
		var c = $(this).val();
        var username_reg = !!c.match(USERNAME_REG); // 用户名格式验证
        if (!c) {
        	$('.usernametips').fadeIn();
        	$('.usernametips').text('用户名为空');
        } else if (!username_reg) {
        	$('.usernametips').fadeIn();
        	$('.usernametips').text('用户名以字母开头，由4-11位字母、数字和下划线"_"组合');
        } else {
        	$('.usernametips').hide();
        }
	});
	$('input[name=email]').on('blur', function() { // 邮箱账号
		var c = $(this).val();
        var email_reg = !!c.match(EMAIL_REG); //手机号码验证
        if (!c) {
        	$('.emailtips').fadeIn();
        	$('.emailtips').text('邮箱账号为空');
        } else if (!email_reg) {
        	$('.emailtips').fadeIn();
        	$('.emailtips').text('邮箱格式有误，请重新输入');
        } else {
        	$('.emailtips').hide();
        }
	});
	$('#password input').on('blur', function() { // 密码
		var c = $(this).val();
        var password_reg = !!c.match(PASSWORD_REG); //手机号码验证
        if (!c) {
        	$('.passwordtips').fadeIn();
        	$('.passwordtips').text('密码为空');
        } else if (!password_reg) {
        	$('.passwordtips').fadeIn();
        	$('.passwordtips').text('密码由6-20位字母、数字和符号组合');
        } else {
        	$('.passwordtips').hide();
        }
	});
	$('#repassword input').on('blur', function() { // 密码再次输入
		var c = $(this).val();
		console.log(c)
		var c_password = $('#password input').val();
        if (c != c_password) {
        	$('.repasswordtips').fadeIn();
        	$('.repasswordtips').text('两次密码输入不一致');
        } else {
        	$('.repasswordtips').hide();
        }
	});
	$('input[name=telnumber]').on('blur', function() { // 手机号码
		var c = $(this).val();
        var tel_reg = !!c.match(TEL_REG); //手机号码验证
        if (!c) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码为空');
        } else if (c.length >= 12 || isNaN(c)) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码只能是数字而且长度小于12位');
        } else if (!tel_reg) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('手机号码格式有误，请重新输入');
        } else {
        	$('.telnumbertips').hide();
        }
	});
	$('input[name=idtfcode]').on('focus', function() { // 手机号码框 到 验证码框
		var c = $('input[name=telnumber]').val();
        var tel_reg = !!c.match(TEL_REG); //手机号码验证
        if (!tel_reg) {
        	$('.telnumbertips').fadeIn();
        	$('.telnumbertips').text('请先填写有效的手机号码并获取短信验证码');
		}
	});
});