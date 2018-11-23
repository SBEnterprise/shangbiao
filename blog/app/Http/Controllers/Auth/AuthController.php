<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    //weibo第三方登录
    public function weibo() {
      return \Socialite::with('weibo')->redirect();
      // return \Socialite::with('weibo')->scopes(array('email'))->redirect();
    }

  //回调路由
  public function callback() {
      $oauthUser = \Socialite::with('weibo')->user();

      var_dump($oauthUser->getId());
      var_dump($oauthUser->getNickname());
      var_dump($oauthUser->getName());
      var_dump($oauthUser->getEmail());
      var_dump($oauthUser->getAvatar());
    }
}
