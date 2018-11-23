<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{

    public function show()
    {
        $user_name = Redis::get('user_name');

        // dd($user_name);
        return view('Admin/index', ['user_name' => $user_name]);
    }
}
