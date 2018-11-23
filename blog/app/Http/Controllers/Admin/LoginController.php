<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Api\CommonApi;
use App\Model\User;

class LoginController extends Controller
{
    public function json($code, $msg, $data=[])
    {
        return response()->json([
            'status' => $code,
            'msg' => $msg,
            'data' => $data,
        ]);
    }

    /**
     * 处理后台的登录
     * @param  int  $code $user_name $password 登录页面的数据
     * @author yaoqi
     * @return 视图, 查询到的数据
     */
    public function doLogin (Request $request)
    {
        $code = $request->input('code');
        $user_name = $request->input('user_name');
        $password = $request->input('password');
        if (empty($code)) {
            return $this->json(-1, '请填写验证码');
        }
        if (empty($user_name)) {
            return $this->json(-1, '用户名不能为空');
        }
        if (empty($password)) {
            return $this->json(-1, '密码不能为空');
        }
        // 判断验证码是否正确
        $bool = CommonApi::CheckCode($request, 'code');
        // dd($bool);
        if (!$bool) {
            return $this->json(-1, '验证码错误');
        }

        $errorCount = Redis::get('userError:'.$user_name);
        if($errorCount >= 3){
            return $this->json(-1, '密码错误,账户已锁,请1小时之后再试');
        }

        $uesrInfo = Redis::get('user:'.$user_name);
        if ( empty($userInfo) ) {
            // 根据用户名查询数据库，用户是否存在
            $userInfo = User::where('user_name', $user_name)->first();
            // dd($userInfo->status);
            $userInfo = serialize($userInfo);
            // dd($userInfo);
            if( empty($userInfo) ){
                return $this->json(-1, '账号或密码错误');
            }


        // 把用户信息放到内存里面
            Redis::set('user:'.$user_name, $userInfo);
            $userInfo = unserialize(Redis::get('user:'.$user_name));
            $user_name = $userInfo->user_name;
            $id = $userInfo->id;
            Redis::set('user_name', $user_name);
            Redis::set('id', $id);
            // dd($userInfo);
            $res = password_verify($password, $userInfo->password);
            if($res){
                // if ($userInfo->status==1) {
                //     return $this->json('-1', '');
                // }
                Redis::del('userError:'.$user_name);
                return $this->json(0, '登录成功');
            }else{
                Redis::incr('userError:'.$user_name);
                $errCount = Redis::get('userError:'.$user_name);
                Redis::expire('userError:'.$user_name, 30);
                $count = 3 - ($errorCount+1);
                if($count == 0){
                    return $this->json(-1, '输入错误3次，请1小时之后再试');
                }
                if($count < 3 && $count !=0){

                   return $this->json(-1, '密码错误,你还有'.$count.'次机会');
                }
            }

            // Rdeis::del($userInfo->password);

        }
    }

    /**
     * 处理后台的退出
     * @author yaoqi
     * @return 视图, 查询到的数据
     */
    public function loginOut ($user_name) {
        Redis::del('user_name', 'id', 'user:'.$user_name, 'userError:'.$user_name);
        return redirect('admin/login');
    }


}
