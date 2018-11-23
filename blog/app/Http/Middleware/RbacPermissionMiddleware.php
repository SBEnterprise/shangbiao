<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
use App\Model\User;

class RbacPermissionMiddleware
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

        $permission_role = [];
        foreach ($roleName as $v) {
            $permission_role[] = $v->permissions->toArray();
        }
         // dd( $permission_role );
        $permission_list = [];
        foreach ($permission_role as $value) {
            foreach($value as $perm){
                $permission_list[] = $perm['name'];
            }  
        }

        //去除数组中重复元素
        $permission_list = array_unique($permission_list);
        
        $i = 2;
        $permissions = func_get_args();
        while ( $i < func_num_args()) {
            $permission[] = $permissions[$i];
            $i++;
        }
    // dd($permission_list, $permission);
        //求交集,没有交集跳转到后台首页
        if (!array_intersect($permission_list, $permission)) {
            return redirect('admin/404');
        }

        return $next($request);
    }
}
