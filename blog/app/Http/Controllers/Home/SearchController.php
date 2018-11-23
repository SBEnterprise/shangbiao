<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Api\Search;
use App\Http\Controllers\Common\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SearchController extends Controller
{
    //接收搜索表单提交过来的信息
    public function showList(Request $request)
    {
        //接收到搜索框中的内容
        $keyword = $request->input('w');
        //创建一个搜索的对象
        $search = new Search('shop');
        //调用对象中的方法, 得到查询结果
        $searchRes = $search->doSearch($keyword);
        $searchResult = Common::CustomPagination($request, $searchRes, 8);
        return view('Home/girls', ['searcheResult' => $searchResult, 'searchRes' => $searchRes, 'key' => $keyword]);
    }

    //清空索引
    public function cleanDocumentIndex()
    {
        $search = new Search();
        $search->cleanIndex();
    }

}
