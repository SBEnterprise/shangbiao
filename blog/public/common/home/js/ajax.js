 //热销
$('#hotGoods #hotGoodsChoice ul li').on('mouseenter', function () {
    var obj = $(this).parent().parent().next().children().eq( $(this).index() );
    obj.removeClass('conceal').siblings().addClass('conceal');
});

//        //男士手表
$('#men_choice ul li').not( $('#menmoreabout') ).on('mouseenter', function () {

    var that = $(this);

    var obj = $(this).parent().parent().next().children().eq( $(this).index() );
    obj.removeClass('conceal').siblings().addClass('conceal');

    var liObj = ($(this).attr('data-cateid'));

    var flag = that.attr('isRequest');

    if(flag == null ) {
        $.ajax({
            type: 'get',
            url: urlObj.men,
            success: function (msg) {
                if (msg.status == 200) {
                    var str = '';
                    for (var i = 0; i < msg.data.length; i++) {
                        str += '<li>\n' +
'                        <a href="' + urlObj.detail + '?gid=' + msg.data[i].id + '" onclick="_gaq.push([\'_trackEvent\',\'首页商品\',\'热销-男士-10\',\'库尔沃CYS3196.1C@热销-男士-10\']);">\n' +
'                            <!-- <i class="c__tMsk"></i> -->\n' +
'                            <img src="' + msg.data[i].goods_pic + '"  width="250" height="250" />\n' +
'                            <div class="tNm">' + msg.data[i].goods_name + '</div >\n' +
'                            <div class="tPrc">￥' + msg.data[i].present_price + '&nbsp;</div>\n' +
'                            <div class="tInfo">已售出<b>&nbsp;' + msg.data[i].sales_num + '</b></div >\n' +
'                        </a>\n' +
'                    </li>';
                    }
                    // $('#ladyshehua').remove(str);
                    that.attr('isRequest', true);
                    obj.html(str);
                }
            },
            data: 'liObj=' + liObj,
            dataType: 'json'
        });
    }
});

//女士手表
$('#ladies_choice ul li').not( $("#moreabout")).on('mouseenter', function () {
    //将每个li对象赋给taht,供下面使用
    var that = $(this);
    //实现选项卡切换
    var obj = $(this).parent().parent().next().children().eq($(this).index());
    obj.removeClass('conceal').siblings().addClass('conceal');

    //获取属性值, 传给PHP,PHP根据给定的值返回相应的数据
    var liObj = ($(this).attr('data-cateid'));

    var flag = that.attr('requested');

    if(flag == null ) {

        $.ajax({
            type: 'get',
            url: urlObj.lady,
            success: function (msg) {
                if (msg.status == 200) {

                    var str = '';
                    for (var i = 0; i < msg.data.length; i++) {
                        str += '<li>\n' +
    '                        <a href="' + urlObj.detail + '?gid=' + msg.data[i].id + '" onclick="_gaq.push([\'_trackEvent\',\'首页商品\',\'热销-男士-10\',\'库尔沃CYS3196.1C@热销-男士-10\']);">\n' +
    '                            <!-- <i class="c__tMsk"></i> -->\n' +
    '                            <img src="' + msg.data[i].goods_pic + '"  width="250" height="250" />\n' +
    '                            <div class="tNm">' + msg.data[i].goods_name + '</div >\n' +
    '                            <div class="tPrc">￥' + msg.data[i].present_price + '&nbsp;</div>\n' +
    '                            <div class="tInfo">已售出<b>&nbsp;' + msg.data[i].sales_num + '</b></div >\n' +
    '                        </a>\n' +
    '                    </li>';
                    }
                    // $('#ladyshehua').remove(str);
                    obj.html(str);
                    that.attr('requested', true);
                }
            },
            data: 'liObj=' + liObj,
            dataType: 'json'
        });
    }
});



