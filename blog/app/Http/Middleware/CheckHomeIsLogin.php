<?php

namespace App\Http\Middleware;

use Closure;

class CheckHomeIsLogin
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
       if (!$request->session()->get('userid')) {
            return redirect('home/login')->with('errorTip', '请登录！！！！');
        }

        return $next($request);
    }
}
