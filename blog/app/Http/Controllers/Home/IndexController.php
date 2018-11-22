<?php

namespace App\Http\Controllers\Home;

use DB;
use session;
use Carbon\Carbon;
use App\Model\User;
use App\Model\Carousel;
use App\Model\HotCommodity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

/**
* 展示首页
*   lizhentao qq1214685942@gmail.com
* @return 将数据返回首页
*/
class IndexController extends Controller
{


    public function index()
    {
      // echo "访问路由成功";
    $user = User::select(['id', 'user_name', 'password', 'phone'])->where('id', 1)->first();

    // echo "$user";
      return view('/Home/index');
    }




}
