<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class Common extends Controller
{
    /**
     * @CustomPagination 手动创建分页器
     * @author LiangZhi <gzphper@163.com>
     * @param  object $request  请求实例
     * @param  array $data      要分页的数据
     * @param  int   $perPage   每页显示条数
     * @return object 对数据分页后的分页对象
     */
    public static function CustomPagination(Request $request, $data, $perPage = 5)
    {
        $current_page = $request->input('page');
        $current_page = $current_page <= 0 ? 1 :$current_page;

        $item = array_slice($data, ($current_page-1)*$perPage, $perPage);
        $total = count($data);

        $paginator =new LengthAwarePaginator($item, $total, $perPage, $current_page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName'  => 'page',
        ]);
        return $paginator;
    }


}
