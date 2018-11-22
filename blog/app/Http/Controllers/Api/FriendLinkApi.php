<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Friendlink;
use Illuminate\Support\Facades\Redis;

/**
 * @author yaoqi <383495167@qq.com>
 * @description 商品列表页的业务处理
 */
class FriendLinkApi extends Controller
{

    public function getFriendlinkData()
    {
        //查询友情链接后台数据
        $friend = Friendlink::select('id','friendlink_id','friendlink_name','friendlink_url')->limit(5)->get()->toArray();
        // dd($friend);
        return $friend;

    }
}
