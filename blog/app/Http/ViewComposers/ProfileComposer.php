<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Http\Controllers\Api\SiteManageApi;
use App\Http\Controllers\Api\CateGoryApi;
use App\Http\Controllers\Api\FootMenuApi;
use App\Http\Controllers\Api\FriendLinkApi;

class ProfileComposer
{
    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $SiteManageApi = new SiteManageApi;

        $CateGoryApi = new CateGoryApi;

        $FootMenuApi = new FootMenuApi;
        
        $FriendLinkApi = new FriendLinkApi;

        $view->with('category', $CateGoryApi->getCateGoryData());
        $view->with('Siteres', $SiteManageApi->getSiteManageData());
        $view->with('footmenu', $FootMenuApi->getFootMenuData());
        $view->with('friend', $FriendLinkApi->getFriendlinkData());
    }
}