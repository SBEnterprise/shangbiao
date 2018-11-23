<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

/**
 * @author yaoqi <383495167@qq.com>
 * @description 检查每个页面是否登录,如果没有登录，跳回登录页
 */
class CheckIsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty(Redis::get('user_name'))) {
            return redirect('admin/login');
        }
        return $next($request);
    }
}
