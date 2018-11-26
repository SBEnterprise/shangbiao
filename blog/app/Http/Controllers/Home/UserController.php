<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\CommonApi;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Order;
use App\Model\Order_goods;
use App\Model\Order_action;
use App\Model\Goods;
use Illuminate\Support\Facades\Redis;
use session;
use Leslie\Sms\Sms;
use Carbon\Carbon;
use App\Jobs\OrderDetail;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    //用来存放验证码信息
    // static $checkPhoneCode = '';
    // public $checkPhoneCode='';
    //展示注册页面
    public function registerView()
    {
        return view('Home/register');
    }
    //展示注册页面
    public function loginView()
    {
        return view('Home/login');
    }

    //加载个人中心页面
    public function userCenter(Request $request)
    {

        if ($request->session()->has( 'userid' )) {
            $uid = $request->session()->get('userid');
            $order = DB::table('order')->select('order_id', 'pay_status', 'add_time', 'order_status')->where('user_id', $uid)->get();

            $order = DB::table('order')->orderBy('order_id', 'desc')->select()->where('user_id', $uid)->paginate(6);;
            $goods = DB::table('order_goods')->orderBy('rec_id', 'desc')->select()->get();
            // dd(count($goods));
            return view('Home/usercenter', ['order' => $order, 'goods' => $goods]);
        } else {

            return view('Home/login');
        }

    }


    /**
     * 处理注册验证
     * @author LIZHENTAO <121468594@qq.com>
     * @param $request  Request的对象
     * @return json    返回的数据是json数据  用户已经存在
     */
    public function doRegister(Request $request)
    {
        // var_dump($_POST);
        $name = $request->input('name');
        $pass = $request->input('pass');
        $repass = $request->input('repass');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $user = User::select(['id', 'username', 'password', 'phone'])->where('username', $name)->first();
        $phonecheck = User::select(['id', 'username', 'password', 'phone'])->where('phone', $phone)->first();

       if ($user) {
            echo json_encode(['status'=>1, 'msg'=>'会员名已被注册！']);
            // return false;
            exit;
       }
       if ($phonecheck) {
            echo json_encode(['status'=>2, 'msg'=>'该手机号码已被注册！']);
            exit;
       }
       // echo 100;
       return 100;

    }

    //发送手机验证码
    public function phoneCode(Request $request)
    {
        // var_dump($_POST);exit;
        //获取用户手机号码
        $phone = $request->input('phone');
        // $phone = '135000000000';
        //加载发短信类
        $push = new CommonApi;
        //发送验证码
        $push->sendMsg($phone);

    }

     /**
     * 处理注册插入数据库
     * @author LIZHENTAO <121468594@qq.com>
     * @param $request  Request的对象
     * @return json    返回的数据是json数据  成功返回true跳转登录页
     */
    public function addRegisterData(Request $request)
    {

        //判断会员名是否合格
       if (!preg_match("/^[a-zA-Z][a-zA-Z0-9_-]{3,10}$/", $_POST['name'])) {
            // echo '账号不合法';
            echo json_encode('error');
            exit;
        }
        //  //判断邮箱是否合法
       if (!preg_match('/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/',$_POST['email'])) {
           // echo '邮箱不合法';
           echo json_encode('error');
           exit;
       }
        //判断密码是否合法
        $pass = preg_match('/^\S{6,20}$/', $_POST['pass']);
        if ($pass ==0) {
            // echo '密码不合法';
            echo json_encode('error');
            exit;
        }

        //两次密码判断是否一致
        if($_POST['pass']!==$_POST['repass']){
            // echo '两次密码不一致，请重新输入';
            echo json_encode('error');
            exit;
        }

        // //判断手机号码是否合法
        if (!preg_match('/^1[34578]\d{9}$/', $_POST['phone'])) {
            // echo '手机不合法';
            echo json_encode('error');
            exit;
        }

        $bool = $this->doRegister($request);
        // var_dump($bool);exit;
        //判断是否注册过
        if ($bool==100) {

            //判断手机是否发送成功
            // var_dump($request->session->get($mobileCode));exit;
            $time = $request->session()->get($_POST['phone'])[3] < time()-60;
            //检查是否超时1分钟
            if ($time) {
                echo json_encode(['status'=>5, 'msg'=>'手机发送超时，请重新输入！']);
                return;
            }

            if ($request->session()->get($_POST['phone'])[0]!=000000) {
                echo json_encode(['status'=>5, 'msg'=>'手机发送失败！']);
                return;
            }

            if ($request->session()->get($_POST['phone'])[1]==$_POST['phone'] && $request->session()->get($_POST['phone'])[2][0] == $_POST['checkphone']) {

                //验证成功后删除session的手机验证码
                $request->session()->forget($_POST['phone']);
                //密码加密
                $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

                $data = [
                    'username'=>$_POST['name'],
                    'email'=>$_POST['email'],
                    'password'=>$password,
                    'status'=>0,
                    'phone'=>$_POST['phone'],
                    'add_time'=>date('Y-m-d')
                ];

                $result = User::insert($data);
                if ($result) {
                     echo json_encode(['status'=>3, 'msg'=>'注册成功！']);
                     return;
                } else {
                     echo json_encode(['status'=>4, 'msg'=>'注册失败！']);
                     return;
                }

            } else {
                // echo '失败';exit;
                echo json_encode(['status'=>5, 'msg'=>'手机验证码不正确！']);
                return;
            }

        } else {
             echo json_encode(['status'=>5, 'msg'=>'输入信息有误！']);
            return;
        }

    }




    /**
    * 前台登录处理
    * @author LIZHENTAO <121468594@qq.com>
    * @param $request  Request的对象
    * @return json  返回的数据是json数据  成功返回true跳转首页，失败返回登录信息有误
    */
    public function doLogin(Request $request)
    {
        $name = $request->input('name');
        $pass = $request->input('pass');
        $user = User::select(['username', 'id', 'password'])->where('username', $name)->first();
        // dd($user->id);
        // $userkey = $user->id.$user->username;
        // $request->session()->put('username', $user->username);
        //  $value = $request->session()->get( 'username' );

        // dd($value);

        //使用redis判断密码错误次数
        $redis = new \Redis;
        $redis->connect('127.0.0.1', 6379);

        $num = $redis->get($name) ? $redis->get($name) : 0;

        if($num >= 3) {
           echo json_encode(['status'=>3, 'msg'=>'登录次数超过3次,请半小时后再登录']); //登录次数大于等于3次, 禁用半小时
            return;
        }
        //判断验证码是否正确
        $CheckCode = CommonApi::CheckCode($request,'code');
        if (!$CheckCode) {
          echo json_encode(['status'=>100, 'msg'=>'验证码错误！']);
           return;
        }

         //判断用户是否存在
        if (!$user) {
            echo json_encode(['status'=>2, 'msg'=>'用户名不正确！']);
            return;
        }
        // 加密后密码判断
        // password_verify($pass, $user->password);
        // //判断密码是否正确
        if ( password_verify($pass, $user->password)) {

            if($num) {
                $redis->del($name);
            }

            //将用户名存放seesion中
            $request->session()->put('username', $user->username);
            $request->session()->put('userid', $user->id);

            echo json_encode(['status'=>1, 'msg'=>'正在登录中...']);
            return;

        } else {
            $num++;
            $redis->set($name, $num, 1800);
            echo json_encode(['status'=>0, 'msg'=>'登录失败,账号或密码错误, 错误次数'. $num]);
            return;

        }

    }


    /**
    * 执行用户退出操作
    * @author LIZHENTAO <121468594@qq.com>
    * @param $request  Request的对象
    * @return 返回true跳转登录页 删除session中键为username的值
    */
    public function loginOut(Request $request)
    {
        $request->session()->forget('username');
        $request->session()->forget('userid');
        return view('/Home/login');
    }

}
