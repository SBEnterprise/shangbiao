<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {

        // 引导用户到新浪微博的登录授权页面
      // Route::get('auth/weibo', 'Auth\AuthController@weibo');
      // 用户授权后新浪微博回调的页面
      // Route::get('auth/callback', 'Auth\AuthController@callback');

    return $request->user();
});
