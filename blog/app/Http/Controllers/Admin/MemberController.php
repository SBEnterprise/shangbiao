<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FeedBack;
use App\Model\Address;
use App\Model\User;
use DB;

class MemberController extends Controller
{
    /**
     * @author yaoqi <383495167@qq.com>
     * @description 展示提交意见反馈的用户信息
     */
    public function show ($id)
    {

        $userData = FeedBack::find($id)->user;
        $uid = $userData->id;
        // dd($userData);
        //根据用户id查询地址表的信息 user.id=address.uid
        $addr = Address::where('uid', $uid)->first();
        return view('Admin/member/member-show', ['userData' => $userData, 'addr' => $addr]);
    }

    //会员首页
    public function index()
    {
        $member_info = User::select('id','user_name','sex','phone','add_time','email','rank','pay_points','password')->paginate(5);
        $sum = User::select('id')->count();
        // dd($member_info);
        return view('Admin/member/member-list',['member_info'=>$member_info,'sum'=>$sum]);
    }


    //删除会员  
    public function del(Request $request)
    {
        $id = (int)$request->get('id');
        $res = User::where('id', '=', $id)->delete();
        if ($res > 0) {
            return json_encode(['status'=>0,'msg'=>'删除成功']);
        } else {
            return json_encode(['status'=>1,'msg'=>'删除失败']);
        }
    }

    //加载编辑会员页面
    public function edit($id)
    {
        $member_info = User::select('id','user_name','sex','phone','add_time','status','email','rank','pay_points','password')
                    ->where('id',$id)
                    ->first()
                    ->toArray();

        return view('Admin/member/member-edit',['member_info'=>$member_info]);
    }

    //判断用户名是否已被注册
    public function checkUserName(Request $request)
    {
        
        $uname = $request->post('uname');
        $id = (int)$request->post('id');
        // var_dump($_POST['name']);
        // exit;

        //判断用户名是否已被注册
        $user_id = User::select('id')->where('user_name',$uname)->first();

            if (isset($user_id->id)) {
                if ($user_id->id == $id) {
                    return json_encode(['status'=>0, 'msg'=>'']);
                } else {
                    return json_encode(['status'=>2, 'msg'=>'该用户名已被使用！']);
                }
                exit;
            } else {
                return json_encode(['status'=>1, 'msg'=>'该用户名可以使用！']);
            }
    }

     // 判断手机号是否已被注册过
    public function checkPhoneNumber(Request $request)
    {
        $phone = $request->post('phone');
        $id = (int)$request->post('id');
        $phone_id = User::select('id')->where('phone','=',$phone)->first();
        
            if (isset($phone_id->id)) {
                if ($phone_id->id == $id) {
                    return json_encode(['status'=>0, 'msg'=>'']);
                } else {
                    return json_encode(['status'=>4, 'msg'=>'该手机号已被注册！']);
                }
                exit;
            } else {
                return json_encode(['status'=>3, 'msg'=>'该手机号可以注册！']);
            }
    }

    //保存修改信息
    public function save(Request $request)
    {
        // var_dump($_POST);
        $name = $request->post('name');
        $pass = $request->post('pass');
        $repass = $request->post('repass');
        $email = $request->post('email');
        $sex = $request->post('sex'); 
        $phone = $request->post('phone');
        $rank = $request->post('rank');
        $id = (int)$request->post('id');
        $password = password_hash($pass, PASSWORD_DEFAULT);
        // echo $pass;
        // echo $repass;

        //判断用户名是否合格
       if (!preg_match("/^[a-zA-Z][a-zA-Z0-9_-]{3,10}$/", $name)) {
            // echo '账号不合法';
            return json_encode('error');
            exit;
        }

        //判断密码是否合法
        $pass = preg_match('/^\S{6,20}$/', $pass);
        if ($pass == 0) {
            return json_encode('error');
            exit;
        }

        //两次密码判断是否一致
        if($_POST['pass']!==$_POST['repass']){
            return json_encode('error');
            exit;
        }

         //  //判断邮箱是否合法
        if (!preg_match('/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/',$email)) {
            // echo '邮箱不合法';
            return json_encode('error');
            exit;
        }

        // //判断手机号码是否合法
        if (!preg_match('/^1[34578]\d{9}$/', $phone)) {
            // echo '手机不合法';
            return json_encode('error');
            exit;
        }
        $data = [
            'user_name'=>$name,
            'password'=>$password,
            'email'=>$email,
            'sex'=>$sex,
            'phone'=>$phone,
            'rank'=>$rank,
            'add_time'=>date('Y-m-d H:i:s')
        ];
        $bool = DB::table('user')
                    ->where('id', $id)
                    ->update($data);
        if ( $bool ) {
            return json_encode(['status'=>0, 'msg'=>'修改成功']);
        } else {
            return json_encode(['status'=>1, 'msg'=>'修改失败']);
        }

    }
}
