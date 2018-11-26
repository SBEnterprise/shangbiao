

$(function() {
	// 语言切换点击事件
	$('.languages span').on('click', function() {
		var lang = $(this).text();
		if ($(this).attr('class') != 'active') alert('语言切换为'+lang);
		$(this).addClass('active').siblings().removeClass('active');
	});

	// 全站搜索点击事件
	$('.searchBtn').on('click', function() {
		var content = $('.search input').val();
		if (!content) {
			alert('搜索内容为空~');
		} else {
			alert(content);
		}
	});

	// 头部导航跳转设置：账户、购物车、收藏
	$('.btnList li').on('click', function() {
		alert($(this).text());
	});

	$('nav li a').on('click', function() {
		var nav = $(this).text();
		$(this).addClass('active').parent().siblings().children('a').removeClass('active');
		alert(nav);
	});
});