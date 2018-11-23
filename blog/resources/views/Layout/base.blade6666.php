<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" href="http://www.xbiao.com/favicon.ico">
    <script src="{{asset('common/home/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('common/home/js/jquery-1.12.3.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('common/home/css/sxg.css')}}">
    <script src="{{asset('common/home/js/global.js')}}"></script>
    <script>
        var www_domain='http://www.wbiao.cn';
        var wb_domain='.wbiao.cn';
        var tpl_img='http://theme.wbiao.cn/images/';
        var tpl_js='http://theme.wbiao.cn/js/';
        var www_wbiao_cn='http://www.wbiao.cn/';
        var news_wbiao_cn='http://news.wbiao.cn/';
        var cart_wbiao_cn='http://cart.wbiao.cn/';
        var user_wbiao_cn='http://user.wbiao.cn/';
        var data_wbiao_cn='http://data.wbiao.cn/';
        var qd_wbiao_cn='http://qd.wbiao.cn/src2/';
        var qdimg_wbiao_cn='http://qd.wbiao.cn/img/';
        var async_wbiao_cn='http://async.wbiao.cn/';
    </script>

    <!--修订功能js错误 重置模块功能：下拉菜单隐藏、头部幻灯片， 修改时间2014年5月20日11:11:17 修改员：huang-->

    <!--[if lte IE 6]>
<script src="{{asset('common/home/js/DD_belatedPNG.js')}}"></script>
<script>
    DD_belatedPNG.fix('.head .c__logo, .c__corner, .c__b_dotted, .bx-pager-link, .c__ls_pointer, .c__rs_pointer, .c__tMsk, .c__tm_more, .gMenu, .c__gotop, .c__suggest, .c__compare, .close, .n__dotted,.n__acn,.n__t_top,.n__t_bottom,.n__rank,.n__letter,.n__sina,.n__tqq,.n__app,.iphone,.android,.weixin, .n__left_brands,.n__right_brands, .n__arrleft,.n__arrright, .n__squ, .n__squ_small, .n__sign, .n__src_btn, .n__sa_rank, .n__smaller, .n__bigger, .n__red_pointer, .n__pl_btn, .n__ckb, .n__face, .n__sc_bg, .n__c_add, .n__c_rank, .n__r_bg, .n__sina_weibo, .n__qq_weibo, .n__weixin, .n__bo_pointer, .jb_ad img, #kf, #kfs, #goods #lookOver, .cc a.on span, #goods .agency, .bx-prev, .bx-next, .fancybox-wrap .hand, .c__pTag ');
</script>
<![endif]-->
<script>
        var wb_domain = '';
        var tpl_img = '';
        var tpl_js = '';
        var www_wbiao_cn = '';
        var news_wbiao_cn = '';
        var cart_wbiao_cn = '';
        var user_wbiao_cn = '';
        var data_wbiao_cn = '';
        var qd_wbiao_cn = '';
        var qdimg_wbiao_cn = '';
    </script>
        <!-- end 修改完毕-->
    @section('css')
      {{--子模板样式--}}
    @show

    @section('main-js')
      {{--子模板js--}}
    @show
</head>
<body>
    <!-- Begin header -->
        <div id="member_info2"></div>
        <div class="head">
            <div class="r1 w1225">
                <div class="ri">
                    <span class="tLnk2"><a href="{{asset('/home/cart')}}"  >购物车</a></span>
                    @if ( !empty( Session::get('userid')) ) 
                        <span class="tLnk1"><a href="{{asset('/home/usercenter')}}" class="f12">{{ Session::get('username') }}</a> <a href="{{url('/home/loginout')}}" class="f12">退出</a></span>
                    @else
                    <span class="tLnk1"><a href="{{url('/home/login')}}" class="f12">登录</a> <a href="{{url('/home/register')}}" class="f12">注册</a></span>
                     @endif
                </div>
            </div>
            <div class="r2 w1225">
                <h1 class="logo w440"><img src="{{asset('common/home/css/images/LOGO.png')}}" /></h1>
                <div class="srh">
                    <form id="searchForm" name="searchForm" method="get" action="/shoubiao.html" onsubmit="return checkSearchForm()"><input type="hidden" value="1" name="dow" id="dow">
                        <input name="w" id="w" type="text" class="tIptTxt c999 f14" value="搜索 品牌/系列/型号" title="搜索 品牌/系列/型号" onfocus="javascript:var t=$(this); if(t.val()==t.attr('title')) t.val('');" onblur="javascript:var t=$(this); if(t.val()=='') t.val(t.attr('title'));" />
                        <a class="c__search">搜索</b></a>
                    </form>
                </div>
                <div class="wbPt">
                    <span class="tTel" style="font-size:16px;">服务热线：400-888-8888</span>
                </div>
            </div>
            <div class="r3 w1225" style="position:relative">
                <div class="gSort" id="pop_menu">
                    <!-- <span class="tit"><b class="ico c__category"></b>腕表分类</span> -->
                    <ul id="dropdown_nav">
                        <li>
                            <a class="sub_link" href="#">腕表分类</a>

                            <div class="sub_nav">
                                <dl>
                                    <dt style="position:absolute;">手表品牌</dt>
                                    <dd>
                                        <a   href="">劳力士</a>
                                        <a   href="">欧米茄</a>
                                        <a   href="">欧古诗丹</a>
                                        <a   href="">天梭</a>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>男士手表</dt>
                                    <dd>
                                        <a   href="">送父亲</a>
                                        <a   href="">送老公</a>
                                        <a   href="">送男友</a>
                                        <a   href="">送亲人</a>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>女士手表</dt>
                                    <dd>
                                        <a   href="">送母亲</a>
                                        <a   href="">送老婆</a>
                                        <a   href="">送女友</a>
                                        <a   href="">送亲人</a>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>特价推荐</dt>
                                    <dd>
                                        <a href="" title="雅克利曼手表 Jacques Lemans">雅克利曼</a>
                                        <a href="" title="玛莎拉蒂手表 Maserati">玛莎拉蒂</a>
                                        <a href="" title="CK手表 Calvin Klein">CK</a>
                                        <a href="" title="Guess手表 Guess">Guess</a>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>款式场合</dt>
                                    <dd>
                                        <a href="" title="商务手表">商务休闲</a>
                                        <a href="" title="正装手表">正装</a>
                                        <a href="" title="时尚手表">时尚</a>
                                        <a href="" title="运动手表">运动</a>
                                        <a href="" title="运动手表">收藏</a>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>新品上市</dt>
                                    <dd>
                                                <a href="" title="送母亲手表">送母亲</a>
                                                <a href="" title="送老婆手表">送老婆</a>
                                                <a href="" title="送女友手表">送女友</a>
                                          <a href="" title="送闺蜜手表">送闺蜜</a>
                                    </dd>
                                </dl>
                            </div>
                        </li>
                    </ul>
                </div>
<!-- end pop_menu-->
<!--end gMune 修改2014-5-19 15:15:00 修改员——huang-->
            </div>
            <ul class="gNav">

                <li><a href="{{asset('/')}}" title="首页" class="cur"  >首页</a></li>
                <li><a href="{{asset('/home/tejia')}}" title="本期特价">本期特价</a></li>
                <li><a href="{{asset('/home/time')}}" title="限时抢购">限时抢购</a></li>
                <li><a href="{{asset('/home/boys')}}" title="男士腕表">男士腕表</a></li>
                <li><a href="{{asset('/home/girls')}}" title="女士腕表">女士腕表</a></li>
                <li><a href="{{asset('/home/jimai')}}" title="免费寄卖">免费寄卖</a></li>
                <li><a href="{{asset('/home/huiyuan')}}" title="寻表专区/采购清单" style="font-size:15px; color:#ce1739;" ><strong>寻表专区/采购清单</strong></a>
                </li>
            </ul>
        </div>
    </div>

    <script type="text/javascript">
    $(function() {
        //我们一开始就隐藏所有的下拉菜单
        $('#dropdown_nav li').find('.sub_nav').hide();
        //当鼠标悬停在主导航链接，我们发现下拉菜单中的相应链接。
        $('#dropdown_nav li').hover(function() {
            $(this).find('.sub_nav').fadeIn(100);
            $(this).find(".sub_link").addClass("cur");
        }, function() {
            $(this).find('.sub_nav').fadeOut(50);
            $(this).find(".sub_link").removeClass("cur");
        });
    });
    </script>

        <!-- End header -->
        <div class="contains">
        @section('main')

        @show
        </div>


        <!-- Begin footer -->
        <div class="foot">
            <div class="r1 w1225">
                <dl class=" w188">
                    <dd class=" w110">
                        <a href="/help-706.html" rel="nofollow"><img src="{{asset('common/home/css/images/logoxia.png')}}"/></a>
                    </dd>
                </dl>
                <dl class=" w188">
                    <dt class=" w70"><i>新手</i></dt>
                    <dd class=" w110">
                        <a href="" rel="nofollow">&bull;&nbsp;用户注册</a>
                        <a href="" rel="nofollow">&bull;&nbsp;找回密码</a>
                        <a href="" rel="nofollow">&bull;&nbsp;订购流程</a>
                    </dd>
                </dl>
                <dl class=" w188">
                    <dt class=" w70"><i>支付</i></dt>
                    <dd class=" w110">
                        <a href="" rel="nofollow">&bull;&nbsp;支付方式</a>
                        <a href="" rel="nofollow">&bull;&nbsp;发票说明</a>
                        <a href="" rel="nofollow">&bull;&nbsp;支付问题</a>
                    </dd>
                </dl>
                <dl class=" w188">
                    <dt class=" w70"><i>配送</i></dt>
                    <dd class=" w110">
                        <a href="" rel="nofollow">&bull;&nbsp;配送方式</a>
                        <a href="" rel="nofollow">&bull;&nbsp;配送说明</a>
                        <a href="" rel="nofollow">&bull;&nbsp;包裹签收</a>
                    </dd>
                </dl>
                <dl class=" w188">
                    <dt class=" w70"><i>保障</i></dt>
                    <dd class=" w110">
                        <a href="" rel="nofollow">&bull;&nbsp;退换货政策说明</a>
                        <a href="" rel="nofollow">&bull;&nbsp;如何办理退货</a>
                        <a href="" rel="nofollow">&bull;&nbsp;常见问题</a>
                    </dd>
                </dl>
                <dl class=" w188">
                    <dt class=" w70"><i>寄卖</i></dt>
                    <dd class=" w110">
                        <a href="" rel="nofollow">&bull;&nbsp;寄卖流程</a>
                        <a href="" rel="nofollow">&bull;&nbsp;寄卖说明</a>
                        <a href="" rel="nofollow">&bull;&nbsp;调价与撤卖</a>
                    </dd>
                </dl>
            </div>
            <div class="r2 w1225 wide">
                <div class="f333 tmallLinks">
                <a href=""   rel="nofollow">正品保证</a>&nbsp;|&nbsp;
                <a href=""   rel="nofollow">7天退货</a>&nbsp;|&nbsp;
                <a href=""  >售后维修 </a>&nbsp;|&nbsp;
                <a href=""  >全场包邮</a>&nbsp;|&nbsp;
                <a href=""   rel="nofollow">投诉建议</a>
                </div>
                <div>喜悦名表 版权所有  Copyright 2014-2015 www.xxxxxxx.cn . LTD ALL RIGHT RESERVED.<br/></div>
            </div>
        </div>
        <!-- End footer -->
        <div id="floatBox">
            <div id="return">
                <a href="javascript:void(0);" class="c__gotop" title="返回顶部" style="display:none;" rel="nofollow"></a>
            </div>
        </div>
</body>


    @section('footer-js')

    @endsection

</html>