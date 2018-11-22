<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SiteManage;
use Illuminate\Support\Facades\Redis;

/**
 * @author yaoqi <383495167@qq.com>
 * @description 商品列表页的业务处理
 */
class SiteManageApi extends Controller
{

    public function getSiteManageData()
    {
        $Siteres = Redis::get('siteres');
        if (empty($data)) {
            $Siteres = Sitemanage::where('id', 2)->first();
            $Siteres = serialize($Siteres);
            Redis::set('siteres', $Siteres);
            $Siteres = unserialize(Redis::get('siteres'));
        // var_dump($Siteres);die;
            return $Siteres;
        } else {
            $Siteres = Redis::get('siteres');
        // var_dump($Siteres);die;
            return $Siteres;
        }

    }
}
