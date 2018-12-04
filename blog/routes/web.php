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

 //========================前台页面路由============================================
Route::prefix('home')->group(function () {

  //登录页面
  Route::get('login', 'Home\UserController@loginView');
  //处理登录
  Route::post('dologin', 'Home\UserController@doLogin');
  //处理手机号登录
  Route::post('phonelogin', 'Home\UserController@phoneLogin');
  //处理查看手机号是否存在
  Route::post('forgetphone', 'Home\UserController@forgetPhone');
  //处理手机号找回密码
  Route::post('forgetphone', 'Home\UserController@forgetPhone');
  //执行用户退出
  Route::get('loginout', 'Home\UserController@loginOut');
  //注册页面
  Route::get('register', 'Home\UserController@registerView');
  //前台注册验证处理
  Route::post('doregister', 'Home\UserController@doRegister');
  Route::post('phonecode', 'Home\UserController@phoneCode');
  //前台注册数据新增处理
  Route::post('addregisterdata', 'Home\UserController@addRegisterData');

  //=======================收藏功能==============================================
    //查询已经收藏
    Route::get('collect','Home\CollectController@collect');
    //添加收藏
    Route::get('collect/add','Home\CollectController@addCollect');
    //取消收藏
    Route::get('collect/del','Home\CollectController@delCollect');



});

// 引导用户到新浪微博的登录授权页面
Route::get('auth/weibo', 'Auth\AuthController@weibo');
// 用户授权后新浪微博回调的页面
Route::get('auth/callback', 'Auth\AuthController@callback');
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





// ==============lizhentao=========Method===============================



//处理后台友情链接(增改删)路由
Route::get('/friendaction', 'Admin\FriendlinkController@addFriendlink');
Route::get('/frienddata', 'Admin\FriendlinkController@update');
Route::get('/frienddelete', 'Admin\FriendlinkController@destroy');

//===========================积分管理==========================================

Route::group(['prefix' => 'admin','middleware' => 'rbac.role:superadmin,admin,guest'], function() {
    //积分管理-展示积分用户数据
    Route::get('integral', ['middleware' => 'rbac.permission:integral-list,integral-edit,integral-delete', 'uses' =>'Admin\IntegralController@showIntegral']);
    //编辑用户积分
    Route::get('integral-edit/{id}', ['middleware' => 'rbac.permission:integral-edit', 'uses' =>'Admin\IntegralController@showIntegralList']);
    //修改用户积分数据
    Route::post('integraldata', 'Admin\IntegralController@updateIntegral');
    //删除用户积分数据
    Route::get('/integraldelete/{id}', ['middleware' => 'rbac.permission:integral-delete', 'uses' =>'Admin\IntegralController@deleteIntegral']);

    //积分细则页面
    Route::get('integral-rules', ['middleware' => 'rbac.permission:integral-rules-list,integral-rules-create,integral-rules-edit,integral-rules-delete', 'uses' =>'Admin\IntegralController@integralRulesView']);

     //积分规则添加
    Route::get('integral-rules-add', ['middleware' => 'rbac.permission:integral-rules-create', 'uses' =>'Admin\IntegralController@rulesView']);
    Route::get('integral-rules-edit/{id}', ['middleware' => 'rbac.permission:integral-rules-edit', 'uses' =>'Admin\IntegralController@integralEdit']);
    //积分规则后台显示
    Route::post('integralaction', 'Admin\IntegralController@addIntegral');
    //积分规则修改
    Route::post('integraleditdata', 'Admin\IntegralController@integralUpdate');
    Route::get('integraldelete', ['middleware' => 'rbac.permission:integral-rules-delete', 'uses' =>'Admin\IntegralController@ruleDelete']);

});



//===============================liguobin==================================================
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
    Route::get('/404',function() {
        return view('Admin/404');
    });


});



//==================================dengxiaoxie=========================
Route::group(['prefix' => 'admin','middleware' => 'rbac.role:superadmin,admin,guest'], function() {
    //分类管理首页   dengxiaoxie
        Route::get('/category/index',['middleware' => 'rbac.permission:category-list,category-create,category-edit,category-show,category-delete','uses' => 'Admin\CategoryController@index']);

        //加载添加分类页面
        Route::get('/category/add',['middleware' =>'rbac.permission:category-create','uses' => 'Admin\CategoryController@add']);

        //添加分类
        Route::post('/category/save',['middleware' =>'rbac.permission:category-create','uses' => 'Admin\CategoryController@save']);

        //删除分类
        Route::get('/category/del',['middleware' =>'rbac.permission:category-delete','uses' => 'Admin\CategoryController@del']);

        //加载编辑分类页面
        Route::get('/category/edit/{id}',['middleware' =>'rbac.permission:category-edit','uses' => 'Admin\CategoryController@show']);

        //修改分类
        Route::get('/category/update/',['middleware' =>'rbac.permission:category-edit','uses' => 'Admin\CategoryController@update']);

         //会员管理
        Route::get('/member/index',['middleware' =>'rbac.permission:member-list,member-create,member-edit,member-show,member-delete','uses' =>'Admin\MemberController@index']);
        //删除会员
        Route::get('/member/del',['middleware' =>'rbac.permission:member-delete','uses' =>'Admin\MemberController@del']);
        //加载编辑会员页面
        Route::get('/member/edit/{id}',['middleware' =>'rbac.permission:member-edit','uses' =>'Admin\MemberController@edit']);
        //验证用户名是否已存在
        Route::post('/member/checkusername','Admin\MemberController@checkUserName');
        //验证手机号
        Route::post('/member/checkphonenumber','Admin\MemberController@checkPhoneNumber');
        //保存修改信息
        Route::post('/member/save',['middleware' =>'rbac.permission:member-edit','uses' =>'Admin\MemberController@save']);

    });
//=============================end======================

//==========================yaoqi有前缀====================
Route::group(['prefix' => 'admin','middleware' => 'rbac.role:superadmin,admin,guest'], function() {
        //系统设置管理 yaoqi
    Route::get('system/system-base-manage', ['middleware' => 'rbac.permission:system-base-list,system-base-create,system-base-edit,system-base-show,system-base-delete','uses' => 'Admin\SiteManageController@main']);
    //显示添加网站页面 yaoqi
    Route::get('system/system-base', ['middleware' =>'rbac.permission:system-base-create','uses' =>  'Admin\SiteManageController@base']);
    //显示网站编辑页面 yaoqi
    Route::get('system/system-edit/{id}', ['middleware' =>'rbac.permission:system-base-edit','uses' =>  'Admin\SiteManageController@show']);

     //产品管理  yaoqi
        Route::get('product/product-list', ['middleware' => 'rbac.permission:product-list,product-create,product-edit,product-show,product-delete','uses' => 'Admin\GoodsController@main']);
        // 展示商品修改信息页面 yaoqi
        Route::get('product/product-edit/{id}',['middleware' => 'rbac.permission:product-edit','uses' => 'Admin\GoodsController@show']);
        //显示添加商品页面 yaoqi
        Route::get('product/product-add',['middleware' => 'rbac.permission:product-create','uses' => 'Admin\GoodsController@add']);
        // 导出商品信息
        Route::get('product/product-excel','Admin\GoodsController@excel');
        Route::get('product/product-returnexcel','Admin\GoodsController@returnexcel');
     //商品详情表  yaoqi
        Route::get('product/detail-list/{id}', 'Admin\DetailController@index');
        //展示商品详情修改页面  yaoqi
        Route::get('product/detail-edit/{gid}', 'Admin\DetailController@edit');
        //添加商品详情  yaoqi
        Route::get('product/detail-add/{id}', 'Admin\DetailController@show');

    });


//======================end=========================


//=============================yaoqi无admin前缀================================================
Route::group(['middleware' => 'rbac.role:superadmin,admin,guest'], function() {

    //处理添加网站信息
    Route::post('/action', ['middleware' =>'rbac.permission:system-base-create','uses' => 'Admin\SiteManageController@handler']);
    //处理修改网站信息
    Route::post('/saction',['middleware' =>'rbac.permission:system-base-edit','uses' => 'Admin\SiteManageController@update']);
    //处理网站信息删除
    Route::post('/udel',['middleware' =>'rbac.permission:system-base-delete','uses' => 'Admin\SiteManageController@delete']);

    //处理添加商品信息
    Route::post('/paction',['middleware' => 'rbac.permission:product-create','uses' => 'Admin\GoodsController@index']);
    //处理修改商品状态
    Route::post('/pupdate', 'Admin\GoodsController@statusUpdate');
    //处理修改商品信息
    Route::post('/editgoods',['middleware' => 'rbac.permission:product-edit','uses' =>'Admin\GoodsController@update']);
    //处理删除商品
    Route::get('/pdelete',['middleware' => 'rbac.permission:product-delete','uses' => 'Admin\GoodsController@dele']);

     //处理商品详情修改信息
    Route::post('/dupdate', 'Admin\DetailController@update');

    //处理商品详情添加
    Route::post('/dinsert', 'Admin\DetailController@add');
    Route::post('/check', 'Admin\DetailController@check');

    //添加商品品牌路由 yaoqi
    Route::get('/typeaction/{id}', 'Admin\BrandController@action');

    //商品图片上传路由 yaoqi
    Route::post('/uploadimg','Admin\GoodsController@index');

    //处理用户意见删除 yaoqi
    Route::get('/feedbackdel/{id}', ['middleware' => 'rbac.permission:feedback-delete','uses' => 'Admin\FeedBackController@del']);
    //处理用户意见回复 yaoqi
    Route::post('/replyaction', 'Admin\FeedBackController@update');

    });

// ==============lizhentao=========Method===============================

    Route::group(['prefix' => 'admin','middleware' => 'rbac.role:superadmin,admin,guest'], function() {
    //品牌管理
    Route::get('product-brand',['middleware' => 'rbac.permission:brand-list,brand-create,brand-edit,brand-show,brand-delete','uses' => 'Admin\BrandController@showBrand']);
    //添加品牌
    Route::get('product-brand-add',['middleware' => 'rbac.permission:brand-create','uses' => 'Admin\BrandController@addBrandView']);
    //品牌LOGO执行图片上传
    Route::post('uploadexec','Common\UploadController@uploadToQiNiu');
    //品牌执行添加
    Route::post('addBrand', ['middleware' => 'rbac.permission:brand-create','uses' => 'Admin\BrandController@addBrand']);
    //修改品牌路由
    Route::get('product-brand-edit/{id}',['middleware' => 'rbac.permission:brand-edit','uses' => 'Admin\BrandController@showBrandList']);
    //修改品牌数据
    Route::post('branddata', ['middleware' => 'rbac.permission:brand-edit','uses' =>'Admin\BrandController@updateBrand']);
    //删除品牌数据路由
    Route::get('/branddelete/{id}', ['middleware' => 'rbac.permission:brand-delete', 'uses' =>'Admin\BrandController@deleteBrand']);
        });

//==============lizhentaoend=========================




Route::group(['prefix' => 'admin','middleware' => 'rbac.role:superadmin,admin,guest'], function() {
    //后台主页 yaoqi
    Route::get('/index', 'Admin\IndexController@show');

    //查看当前登录的管理员信息 yaoqi
    Route::get('admin/admin-show/{user_name}', 'Admin\AdminController@adminshow');

    //右侧主页面 yaoqi
    Route::get('welcome', function () {
        return view('Admin/welcome');
    });
    //展示意见反馈详情 yaoqi
    Route::get('feedback/feedback-list', ['middleware' => 'rbac.permission:feedback-list,feedbackmember-show,feedbackreply-edit,feedback-delete','uses' => 'Admin\FeedBackController@action']);

    //查看意见内容的回复 yaoqi
    Route::get('reply/reply-show/{id}', 'Admin\ReplyFormController@show');
    //意见回复
    Route::get('reply/reply-edit/{id}', ['middleware' => 'rbac.permission:feedbackreply-edit','uses' => 'Admin\ReplyFormController@edit']);
    //意见反馈编辑 yaoqi
    Route::get('feedback/feedback-edit/{id}', 'Admin\FeedBackController@show');

    //查看反馈意见的用户信息 yaoqi
    Route::get('member/member-show/{user_id}', 'Admin\MemberController@show');

    //资讯（友情链接）管理friendata
    Route::get('article-list', 'Admin\FriendlinkController@showFriendlink');
    //友情链接修改传ID
    Route::get('friend-add/{id}', 'Admin\FriendlinkController@show');

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


//=======================chenxiaodong===============================================
Route::group(['prefix' => 'admin','middleware' => 'rbac.role:superadmin,admin,guest'], function() {

//=========================后台订单管理===========================
    //后台订单管理页面
    Route::get('/orderview', ['middleware' => 'rbac.permission:order-list,order-create,order-edit,order-show,order-delete','uses' => 'Admin\OrderController@index']);

    //显示订单详情页面
    Route::get('/orderdetailview', 'Admin\OrderController@detailView');

    //负责订单发货处理
    Route::post('/ordershipping', 'Admin\OrderController@orderShipping');

    //显示订单修改页面
    Route::get('/ordereditview', ['middleware' => 'rbac.permission:order-edit','uses' =>   'Admin\OrderController@orderEditView']);

    //执行修改
    Route::post('/orderupdate', ['middleware' => 'rbac.permission:order-edit','uses' => 'Admin\OrderController@orderUpdate']);


    //===========================图片管理=====================================
    //显示商品图片页面
    Route::get('/imgview',['middleware' => 'rbac.permission:img-list,img-create,img-edit,img-show,img-delete','uses' => 'Admin\ImgController@imgView']);

    //显示新增商品图片页面
    Route::get('/imgaddview', ['middleware' => 'rbac.permission:img-create','uses' =>'Admin\ImgController@imgAddView']);

    //负责上传图片
    Route::post('/uploadimg', 'Admin\ImgController@uploadImg');

    //负责删除图片
    Route::get('/imgdelete', ['middleware' => 'rbac.permission:img-delete','uses' => 'Admin\ImgController@deleteImg']);

    });

//===============================chenjiaming==========================================


Route::group(['prefix' => 'admin','middleware' => 'rbac.role:superadmin,admin,guest'], function() {
  //轮播图后台处理,显示页面
    Route::get('/carousel', ['middleware' => 'rbac.permission:carousel-list,carousel-create,carousel-edit,carousel-status,carousel-delete','uses' =>'Admin\CarouselController@showView']);
    //上传轮播图页面
    Route::get('/carouselAdd', ['middleware' => 'rbac.permission:carousel-create','uses' =>'Admin\CarouselController@showCarouselAdd']);
    //处理上传路由
    Route::post('/uploadCarousel', 'Admin\CarouselController@carouselAdd');
    //加载轮播图修改页面
    Route::get('/carouselEdit/{id}', ['middleware' => 'rbac.permission:carousel-edit','uses' =>'Admin\CarouselController@showCarouselEdit']);
    //处理轮播图信息更新
    Route::post('/editCarousel', 'Admin\CarouselController@carouselEdit');
    //删除轮播图
    Route::get('/delCarousel',['middleware' => 'rbac.permission:carousel-delete','uses' => 'Admin\CarouselController@carouselDel']);
    //更新status状态按钮路由
    Route::post('/updateStatus', ['middleware' => 'rbac.permission:carousel-status','uses' =>'Admin\CarouselController@carouselUpdateStatus']);

});
