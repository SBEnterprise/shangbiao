<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;

class CateGoryApi extends Controller
{
    public function getCateGoryData()
    {

    $tplist = Category::select()
            ->where('parent_id',0)
            ->get()
            ->toArray();
        foreach($tplist as &$v){
            $v['zlist'] = Category::select()
                ->where("parent_id",$v['id'])
               ->get()
                ->toArray();
        }
            $category = [$tplist, $v['zlist']];
            // echo '<pre>';
// var_dump($category);die;
        return $category;
    }
}
