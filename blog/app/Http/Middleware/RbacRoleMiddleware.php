<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
use App\Model\User;

class RbacRoleMiddleware
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
        //获取user的id
        $user_id = Redis::get('id');
       //检查是否登录
        if( $user_id ){
            $user = User::find($user_id);
        } else {
            return redirect('admin/login');
        }
        
        $roleName = $user->roles;

        $user_roles = [];
        foreach ($roleName as $v) {
            $user_roles[] = $v->name;
        }
        
        $i = 2;
        $roles = func_get_args();
        while ( $i < func_num_args()) {
            $role[] = $roles[$i];
            $i++;
        }

        //求交集,没有交集跳转到后台首页
        if (!array_intersect($user_roles, $role)) {
            return redirect('admin/404');
        }
        return $next($request);
    }
}
