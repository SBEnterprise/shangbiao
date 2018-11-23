<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FootMenu;
use Illuminate\Support\Facades\Redis;

class FootMenuApi extends Controller
{
    public function getFootMenuData()
    {

        $foottplist = FootMenu::select()
                ->where('parent_id', 0)
                ->get()
                ->toArray();
            foreach($foottplist as &$f){
                $f['flist'] = FootMenu::select()
                    ->where("parent_id", $f['id'])
                    ->get()
                    ->toArray();
            }
            $footmenu = [$foottplist, $f['flist']];

        return $footmenu;
    }
}
