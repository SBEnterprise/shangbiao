<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});
*/


// Route::prefix('home')->group(function () {
//     Route::get('/{view}', 'Home\IndexController@index');

// });


//主页
Route::get('/', 'Home\IndexController@index');

 //前台页面路由
Route::prefix('home')->group(function () {
    //首页女士手表选项卡
    Route::get('showlady', 'Home\IndexController@showGoodsForLady');

    //首页男士手表选项卡
    Route::get('showmen', 'Home\IndexController@showGoodsForMen');

    //男士手表页面
    Route::get('boys', 'Home\IndexController@boys');

    //女士手表页面
    //商品分类路由
    Route::get('girls', 'Home\IndexController@girls');

    // 详情页

    Route::get('detail', 'Home\DetailController@detail');

    //购物车路由
    // Route::get('cart', 'Home\IndexController@cart');

//========================购物车============================================
     //购物车路由
    Route::get('cart/','Home\CartController@cart');
    Route::get('cart/delete/{gid}','Home\CartController@gooddelete');
    Route::get('carthandle/','Home\CartController@cartHandle');

    //前台home中间件判断是否登录
    Route::middleware(['CheckHomeIsLogin'])->group(function () {
    //=============================个人中心======================================
        Route::get('usercenter', 'Home\UserController@userCenter');
        //个人资料
        Route::get('personal', 'Home\PersonalController@personalDataView');
        //加载个人资料修改页面
        Route::get('personaledit', 'Home\PersonalController@personalDataEdit');
        //修改个人资料
        Route::post('personaldataupdata', 'Home\PersonalController@personalDataUpdata');
        //修改用户级别
        Route::get('userrank', 'Home\PersonalController@personalRank');
        //加载修改密码页面
        Route::get('personalpassword', 'Home\PersonalController@personalPasswordEdit');
        //处理修改密码
        Route::post('personalpasswordupdate', 'Home\PersonalController@personalPasswordUpdata');

    //=======================地址管理=======================================
        //地址路由组
        Route::resource('address', 'Home\AddressController');
        //加载地址三级联动数据
        Route::get('address/{id}/edit', 'Home\AddressController@edit');
        //加载新增地址数据页面
        Route::get('address/add', 'Home\AddressController@show');
        //进行新增地址插入处理
        Route::get('address/insert/data', 'Home\AddressController@insert');
        //删除地址
        Route::get('address/delete/{id}', 'Home\AddressController@delete');
        //修改地址页面
        Route::get('address/updateview/{id}', 'Home\AddressController@updateview');
        //执行修改地址
        Route::post('address/updateaddress/{id}', 'Home\AddressController@updateaddress');

    //========================订单部分============================================
        Route::get('cartshop', 'Home\OrderController@cartShop');
        //订单页路由
        Route::get('account', 'Home\OrderController@accountView');
        //处理订单生成
        Route::post('ordersuccess', 'Home\OrderController@orderSuccess');
        //生成订单成功返回页面
        Route::get('ordersuccessview', 'Home\OrderController@orderSuccessView');
        //支付成功返回页面
        Route::get('orderpaysuccessview', 'Home\OrderController@orderPaySuccessView');
        //加载订单详情页面
        Route::get('orderdetail', 'Home\OrderController@orderDetailView');
        //支付处理
        Route::post('orderpay', 'Home\OrderController@orderPay');
        //确定收货
        Route::post('/orderreceive', 'Home\OrderController@orderReceive');
        //取消订单
        Route::post('/ordercancel', 'Home\OrderController@orderCancel');
        //删除订单
        Route::post('/orderdelete', 'Home\OrderController@orderDelete');
        //退货处理
        Route::post('/orderretreat', 'Home\OrderController@orderRetreat');

    //=======================收藏功能==============================================
        Route::get('collect','Home\CollectController@collect');
        //添加收藏
        Route::get('collect/add','Home\CollectController@addCollect'); 
        //取消收藏
        Route::get('collect/del','Home\CollectController@delCollect');

        //============================积分管理================================
        //加载个人积分页面
        Route::get('integral', 'Home\IntegralController@integralView');
        //加载积分细则
        Route::get('integral-rule', 'Home\IntegralController@integralRuleView');
        //积分折扣规则方法
        Route::get('integralrole', 'Home\IntegralController@integralRule');
        // 查看获取积分详情
        Route::get('integral-see', 'Home\IntegralController@integralSee');
        //积分抵扣规则
        Route::get('integralconsum', 'Home\IntegralController@integralAvailable');

         //============================评论管理============================================
        //评论管理
        Route::get('comment', 'Home\CommentController@index');
        Route::post('commentcreate', 'Home\CommentController@create');


        //前台填写意见反馈页面  yaoqi
        Route::get('/feedback', function () {
            return view('Home/feedback');
        });
        // 尾部菜单如何订购页面 yaoqi
        Route::get('/help-707', function () {
            return view('Home/help-707');
        });
        //前台新增意见页面 yaoqi
        Route::post('/feedback/add', 'Home\FeedBackController@add');
        //展示意见我的回复页面 yaoqi
        Route::get('/myfeedback/show', 'Home\ReplyFormController@show');
        //回复 yaoqi
        Route::post('/myfeedback/reply', 'Home\ReplyFormController@reply');


    });

    //登录页面
    Route::get('login', 'Home\UserController@loginView');
    //处理登录
    Route::post('dologin', 'Home\UserController@doLogin');
    //执行用户退出
    Route::get('loginout', 'Home\UserController@loginOut');
    //注册页面
    Route::get('register', 'Home\UserController@registerView');
    //前台注册验证处理
    Route::post('doregister', 'Home\UserController@doRegister');
    Route::post('phonecode', 'Home\UserController@phoneCode');
    //前台注册数据新增处理
    Route::post('addregisterdata', 'Home\UserController@addRegisterData');

    //=================================品牌=====================================    
    //品牌大全
    Route::get('brand', 'Home\BrandController@index');
    //品牌商品展示
    Route::get('brand-detail', 'Home\BrandController@brandView');
    Route::get('brandlist', 'Home\BrandController@brandListView');



});

//搜索模块 cjm
Route::get('search', 'Home\SearchController@showList');
Route::get('clean', 'Home\SearchController@cleanDocumentIndex');
Route::get('delIndex', 'Home\SearchController@delDocumentIndex');

//公用验证码
Route::get('/makecode', 'Api\CommonApi@buildCode');

//文件上传的路由
Route::post('/home/upload', 'common\UploadController@upload');

 Route::get('/password/reset', function () {
        return view('/password/reset');
    });
Auth::routes();


// ===================后台路由===================================

Route::prefix('admin')->group(function () {

    Route::get('/index', 'Admin\IndexController@show');

    //右侧主页面 yaoqi
    Route::get('welcome', function () {
        return view('Admin/welcome');
    });

    Route::middleware(['CheckIsLogin'])->group(function () {
    //后台主页 yaoqi
        Route::get('/index', 'Admin\IndexController@show');

        //查看当前登录的管理员信息 yaoqi
        Route::get('admin/admin-show/{user_name}', 'Admin\AdminController@adminshow');

        //右侧主页面 yaoqi
        Route::get('welcome', function () {
            return view('Admin/welcome');
        });
        //展示意见反馈详情 yaoqi
        Route::get('feedback/feedback-list', 'Admin\FeedBackController@action');

        //意见反馈编辑 yaoqi
        Route::get('feedback/feedback-edit/{id}', 'Admin\FeedBackController@show');

        //查看反馈意见的用户信息 yaoqi
        Route::get('member/member-show/{user_id}', 'Admin\MemberController@show');
        //查看意见内容的回复 yaoqi
        Route::get('reply/reply-show/{id}', 'Admin\ReplyFormController@show');
        //意见回复
        Route::get('reply/reply-edit/{id}', 'Admin\ReplyFormController@edit');

        //资讯（友情链接）管理friendata
        Route::get('article-list', 'Admin\FriendlinkController@showFriendlink');
        //友情链接修改传ID
        Route::get('friend-add/{id}', 'Admin\FriendlinkController@show');

        //添加品牌
        Route::post('brand-add','Admin\BrandController@uploadToQiNiu');

        //品牌管理
        Route::get('product-brand', 'Admin\BrandController@showBrand');
        //添加品牌
        Route::get('product-brand-add', 'Admin\BrandController@addBrandView');
        //执行图片上传
        Route::post('uploadexec', 'Common\UploadController@uploadToQiNiu');
        //执行添加
        Route::post('addBrand', 'Admin\BrandController@addBrand');
        //修改品牌路由
        Route::get('product-brand-edit/{id}', 'Admin\BrandController@showBrandList');
        //修改品牌数据
        Route::post('branddata', 'Admin\BrandController@updateBrand');
        //删除品牌数据路由
        Route::get('/branddelete/{id}', 'Admin\BrandController@deleteBrand');

        //产品管理  yaoqi
        Route::get('product/product-list', 'Admin\GoodsController@main');
        // 展示商品修改信息页面 yaoqi
        Route::get('product/product-edit/{id}', 'Admin\GoodsController@show');
        //显示添加商品页面 yaoqi
        Route::get('product/product-add', 'Admin\GoodsController@add');
        //系统设置管理 yaoqi
        Route::get('system/system-base-manage', 'Admin\SiteManageController@main');
        //显示添加网站页面 yaoqi
        Route::get('system/system-base', 'Admin\SiteManageController@base');
        //显示网站编辑页面 yaoqi
        Route::get('system/system-edit/{id}', 'Admin\SiteManageController@show');
        //商品详情表  yaoqi
        Route::get('product/detail-list/{id}', 'Admin\DetailController@index');
        //展示商品详情修改页面  yaoqi
        Route::get('product/detail-edit/{gid}', 'Admin\DetailController@edit');
        //添加商品详情  yaoqi
        Route::get('product/detail-add/{id}', 'Admin\DetailController@show');


        //分类管理首页   dengxiaoxie
        Route::get('/category/index','Admin\CategoryController@index');

        //加载添加分类页面
        Route::get('/category/add','Admin\CategoryController@add');

        //添加分类
        Route::post('/category/save','Admin\CategoryController@save');

        //删除分类
        Route::get('/category/del','Admin\CategoryController@del');

        //加载编辑分类页面
        Route::get('/category/edit/{id}','Admin\CategoryController@show');

        //修改分类
        Route::get('/category/update/','Admin\CategoryController@update');

        //尾部菜单管理首页   yaoqi
        Route::get('/footmenu/index', 'Admin\FootMenuController@index');
        //加载添加尾部菜单分类页面 yaoqi
        Route::get('/footmenu/add', 'Admin\FootMenuController@add');
        //添加菜单 yaoqi
        Route::post('/footmenu/save', 'Admin\FootMenuController@save');
        //删除菜单 yaoqi
        Route::get('/footmenu/del', 'Admin\FootMenuController@del');
        //加载编辑菜单页面 yaoqi
        Route::get('/footmenu/edit/{id}', 'Admin\FootMenuController@show');
        //修改尾部菜单 yaoqi
        Route::post('/footmenu/update', 'Admin\FootMenuController@update');

    });

    //资讯（友情链接）管理friendata
    Route::get('article-list', 'Admin\FriendlinkController@showFriendlink');
    Route::get('friend-add/{id}', 'Admin\FriendlinkController@show');


    //品牌管理
    Route::get('product-brand', 'Admin\BrandController@showBrand');
    //添加品牌
    Route::get('product-brand-add', 'Admin\BrandController@addBrandView');
    //执行图片上传
    Route::post('uploadexec', 'Common\UploadController@uploadToQiNiu');
    //执行添加
    Route::post('addBrand', 'Admin\BrandController@addBrand');
    //修改品牌路由
    Route::get('product-brand-edit/{id}', 'Admin\BrandController@showBrandList');
    //修改品牌数据
    Route::post('branddata', 'Admin\BrandController@updateBrand');
    //删除品牌数据路由
    Route::get('/branddelete/{id}', 'Admin\BrandController@deleteBrand');

    


    //分类管理首页   dengxiaoxie
    Route::get('/category/index','Admin\CategoryController@index');

    //加载添加分类页面
    Route::get('/category/add','Admin\CategoryController@add');

    //添加分类
    Route::post('/category/save','Admin\CategoryController@save');

    //删除分类
    Route::get('/category/del','Admin\CategoryController@del');

    //加载编辑分类页面
    Route::get('/category/edit/{id}','Admin\CategoryController@show');

    //修改分类
    Route::get('/category/update/','Admin\CategoryController@update');

    //=========================后台订单管理===========================
    //后台订单管理页面
    Route::get('/orderview', 'Admin\OrderController@index');

    //显示订单详情页面
    Route::get('/orderdetailview', 'Admin\OrderController@detailView');

    //负责订单发货处理
    Route::post('/ordershipping', 'Admin\OrderController@orderShipping');

    //显示订单修改页面
    Route::get('/ordereditview', 'Admin\OrderController@orderEditView');

    //执行修改
    Route::post('/orderupdate', 'Admin\OrderController@orderUpdate');

//===========================图片管理=====================================
    //显示商品图片页面
    Route::get('/imgview', 'Admin\ImgController@imgView');

    //显示新增商品图片页面
    Route::get('/imgaddview', 'Admin\ImgController@imgAddView');

    //负责上传图片
    Route::post('/uploadimg', 'Admin\ImgController@uploadImg');

    //负责删除图片
    Route::get('/imgdelete', 'Admin\ImgController@deleteImg');

//=====================================================================

    //积分管理-展示积分用户数据
    Route::get('integral', 'Admin\IntegralController@showIntegral');
    //编辑用户积分
    Route::get('integral-edit/{id}', 'Admin\IntegralController@showIntegralList');
    //修改用户积分数据
    Route::post('integraldata', 'Admin\IntegralController@updateIntegral');
    //删除用户积分数据
    Route::get('/integraldelete/{id}', 'Admin\IntegralController@deleteIntegral');
    //积分细则页面
    Route::get('integral-rules', 'Admin\IntegralController@integralRulesView');

     //积分规则添加
    Route::get('integral-rules-add', 'Admin\IntegralController@rulesView');
    Route::get('integral-rules-edit/{id}', 'Admin\IntegralController@integralEdit');
    //积分规则后台显示
    Route::post('integralaction', 'Admin\IntegralController@addIntegral');
    //积分规则修改
    Route::post('integraleditdata', 'Admin\IntegralController@integralUpdate');
    Route::get('integraldelete', 'Admin\IntegralController@ruleDelete');





    //轮播图后台处理,显示页面
    Route::get('/carousel', 'Admin\CarouselController@showView');
    //上传轮播图页面
    Route::get('/carouselAdd', 'Admin\CarouselController@showCarouselAdd');
    //处理上传路由
    Route::post('/uploadCarousel', 'Admin\CarouselController@carouselAdd');
    //加载轮播图修改页面
    Route::get('/carouselEdit/{id}', 'Admin\CarouselController@showCarouselEdit');
    //处理轮播图信息更新
    Route::post('/editCarousel', 'Admin\CarouselController@carouselEdit');
    //删除轮播图
    Route::get('/delCarousel', 'Admin\CarouselController@carouselDel');
    //更新status状态按钮路由
    Route::post('/updateStatus', 'Admin\CarouselController@carouselUpdateStatus');

});


// ============================yaoqi======Method============================
//处理添加网站信息 yaoqi
    Route::post('/action', 'Admin\SiteManageController@handler');
    //处理修改网站信息 yaoqi
    Route::post('/saction', 'Admin\SiteManageController@update');
    //处理网站信息删除 yaoqi
    Route::post('/udel', 'Admin\SiteManageController@delete');

    //处理添加商品信息 yaoqi
    Route::post('/paction', 'Admin\GoodsController@index');
    //处理修改商品状态 yaoqi
    Route::post('/pupdate', 'Admin\GoodsController@statusUpdate');
    //处理修改商品信息 yaoqi
    Route::post('/editgoods', 'Admin\GoodsController@update');

    //处理删除商品
    Route::get('/pdelete', 'Admin\GoodsController@dele');

    //处理商品详情修改信息 yaoqi
    Route::post('/dupdate', 'Admin\DetailController@update');

    //处理商品详情添加 yaoqi
    Route::post('/dinsert', 'Admin\DetailController@add');
    Route::post('/check', 'Admin\DetailController@check');

    //添加商品品牌路由 yaoqi
    Route::get('/typeaction/{id}', 'Admin\BrandController@action');

    //商品图片上传路由 yaoqi
    Route::post('/uploadimg','Admin\GoodsController@index');

    //处理用户意见删除 yaoqi
    Route::get('/feedbackdel/{id}', 'Admin\FeedBackController@del');
    //处理用户意见回复 yaoqi

    Route::post('/replyaction', 'Admin\ReplyFormController@insert');

// ===============================yaoqi ===<--end--> ===================


// ==============lizhentao=========Method===============================

//处理后台友情链接(增改删)路由
Route::get('/friendaction', 'Admin\FriendlinkController@addFriendlink');
Route::get('/frienddata', 'Admin\FriendlinkController@update');
Route::get('/frienddelete', 'Admin\FriendlinkController@destroy');

Route::group(['prefix' => 'admin','middleware' => 'rbac.role:superadmin,admin,guest'], function() {

    // 角色
    Route::get('roles', ['as' => 'roles', 'middleware' => 'rbac.permission:role-list,role-create,role-edit,role-show,role-delete', 'uses' => 'Rbac\RoleController@index']);
    Route::get('roles/create', ['as' => 'roles.create','middleware' => 'rbac.permission:role-create', 'uses' => 'Rbac\RoleController@create']);
    Route::post('roles/create', ['as' => 'roles.store', 'middleware' => 'rbac.permission:role-create','uses' => 'Rbac\RoleController@store']);
    Route::get('roles/{id}/edit', ['as' => 'roles.edit','middleware' => 'rbac.permission:role-edit', 'uses' => 'Rbac\RoleController@edit']);
    Route::get('roles/{id}', ['as' => 'roles.show','middleware' => 'rbac.permission:role-show', 'uses' => 'Rbac\RoleController@show']);
    Route::patch('roles/{id}', ['as' => 'roles.update','middleware' => 'rbac.permission:role-edit', 'uses' => 'Rbac\RoleController@update']);
    Route::get('roles/{id}', ['as' => 'roles.delete','middleware' => 'rbac.permission:role-delete', 'uses' => 'Rbac\RoleController@destory']);

    // 权限
    Route::get('permission', ['as' => 'permissions','middleware' => 'rbac.permission:permission-list,permission-create,permission-edit,permission-show,permission-delete', 'uses' => 'Rbac\PermissionController@index']);
    Route::get('permission/create', ['as' => 'permissions.create', 'middleware' => 'rbac.permission:permission-create',  'uses' => 'Rbac\PermissionController@create']);
    Route::post('permission/create', ['as' => 'permissions.store', 'middleware' => 'rbac.permission:permission-create', 'uses' => 'Rbac\PermissionController@store']);
    Route::get('permission/{id}/edit', ['as' => 'permissions.edit', 'middleware' => 'rbac.permission:permission-edit', 'uses' => 'Rbac\PermissionController@edit']);
    Route::get('permission/{id}', ['as' => 'permissions.show', 'middleware' => 'rbac.permission:permission-show', 'uses' => 'Rbac\PermissionController@show']);
    Route::patch('permission/{id}', ['as' => 'permissions.update', 'middleware' => 'rbac.permission:permission-edit', 'uses' => 'Rbac\PermissionController@update']);
    Route::get('permission/{id}', ['as' => 'permissions.delete', 'middleware' => 'rbac.permission:permission-delete', 'uses' => 'Rbac\PermissionController@destory']);

     // 用户
    Route::get('users', ['as' => 'users','middleware' => 'rbac.permission:user-list,user-create,user-edit,user-show,user-delete', 'uses' => 'Rbac\UserController@index']);
    Route::get('users/create', ['as' => 'users.create','middleware' => 'rbac.permission:user-create','uses' => 'Rbac\UserController@create']);
    Route::post('users/create', ['as' => 'users.store','middleware' => 'rbac.permission:user-create', 'uses' => 'Rbac\UserController@store']);
    Route::get('users/{id}/edit', ['as' => 'users.edit','middleware' => 'rbac.permission:user-edit', 'uses' => 'Rbac\UserController@edit']);
    Route::get('users/{id}', ['as' => 'users.show','middleware' => 'rbac.permission:user-show', 'uses' => 'Rbac\UserController@show']);
    Route::patch('users/{id}', ['as' => 'users.update','middleware' => 'rbac.permission:user-edit', 'uses' => 'Rbac\UserController@update']);
    Route::get('users/{id}', ['as' => 'users.delete','middleware' => 'rbac.permission:user-delete', 'uses' => 'Rbac\UserController@destory']);
});

// ===================后台登录路由===================================
Route::prefix('admin')->group(function () {

    //显示后台登录页面 yaoqi
    Route::get('/login', function () {
        return view('Admin/login');
    });
    //处理后台登录 yaoqi
    Route::post('/doLogin', 'Admin\LoginController@doLogin');

    //处理退出登录 yaoqi
    Route::get('/loginOut/{user_name}', 'Admin\LoginController@loginOut');

    //404页面,没有权限访问跳转页面
    // Route::get('404',function() {

    //     return view('Admin/404');
    // });
});
