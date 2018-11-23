<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;

class AdminController extends Controller
{
    /**
     * @param  int  $id
     * @author yaoqi
     * @return 页面 data数据库查询的数据
     * @description 显示后台登录的管理员的数据
     */
    public function adminshow ($user_name)
    {
        $adminData = User::where('user_name', $user_name)->first();
        // dd($adminData);
        return view('Admin/admin/admin-show', ['adminData' => $adminData]);
    }
}
