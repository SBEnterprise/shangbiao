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

});



