<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\CommonApi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Model\User;
use session;
use App\Http\Controllers\Common\UploadController;

class PersonalController extends Controller
{

	 //加载个人信息页面以及数据
    public function personalDataView(Request $request)
    {
    	$users = $this->personalData($request);
    	// return view('Home/personal', ['userdata' => $users]);
    	if ($users) {
    		return view('Home/personal', ['userdata' => $users]);
    	} else {
    		return view('Home/personal');
    	}
    	
    }

    //负责查询个人用户信息 可共用使用
    public function personalData(Request $request) 
    {
    	if ($request->session()->has( 'userid' )) {
            // echo 11;
            $userid = $request->session()->get( 'userid' );
            $user = User::select(['id', 'user_name', 'name', 'password', 'phone', 'sex', 'email', 'head_pic', 'rank'])->where('id',  $userid)->get(); 
            return $user;
            // dd($user);       

        } else {
            // echo 22;exit;
            // return view('Home/personal');
            return view('/');
            
        }
    	
    }


    //加载修改用户相关信息
    public function personalDataEdit(Request $request) 
    {
    	$users = $this->personalData($request);

    	return view('Home/personal-edit',  ['userdata' => $users]);
    }


 
     /**
     * 修改用户信息
     * @author chenxiaodong <229168653@qq.com>
     * @param $request  Request的对象
     * @return  成功返回的数据是加载显示个人信息页面，失败则返回当前页面
     */
    public function personalDataUpdata(Request $request, $filename = 'pic') 
    {
        // var_dump($_POST['username']);exit;
        if (!$_POST['username']) {
            return back()->with('errorTip', '该用户名不能为空！');
        }

        if (!$_POST['email']) {
            return back()->with('errorTip', '邮箱不能为空！');
        }

        if (!$_POST['phone']) {
            return back()->with('errorTip', '手机不能为空！');
        }

        //上传头像
        // $upload = new UploadController;
        // $filename = $upload->uploadToQiNiu($request, $fileName);
        $Common = new CommonApi;
        $filename = $Common->uploadToQiNiu($request, $filename);
        
        // var_dump($imglink);
        // var_dump($_POST);
        // exit;
        //查询当前用户名 根据session可找出
        $seesionusername = $request->session()->get( 'username' );
    	$user = User::select(['id', 'user_name'])->where('user_name', '<>', $seesionusername)->get();  	
        foreach ($user as $v) {
            $username[] = $v->user_name;
        }
        // dd($username);
        
        //过滤用户名重名
        if (in_array($_POST['username'], $username)) {
        	return back()->with('errorTip', '该用户名已被使用！');
        	// return;
        }

        //判断是否修改头像
        if (!empty($filename['goodimages'])) {
            $imglink = $filename['goodimages'];

            $data = [
                'user_name' => $_POST['username'],
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'sex' =>$_POST['sex'],
                'head_pic' => $imglink
            ];
        } else {
           $data = [
                'user_name' => $_POST['username'],
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'sex' => $_POST['sex']
            ];
        }
    	
    	// exit;
    	// var_dump($data);exit;
    	$bool = DB::table('users')
    				->where('id', $_POST['id'])
    				->update($data);
    	// var_dump($user);

        if ($bool) {
            return redirect('/home/personal')->with('msg', '修改成功');
        } else {
            return back()->with('errorTip', '修改失败');
        }
    	// if ($bool) {
    	// 	// echo '修改成功';
    	// 	$request->session()->put('username', $_POST['uname']);
    	// 	echo json_encode(['status'=>200, 'msg'=>'修改成功']);

    	// }else{
    	// 	echo json_encode(['status'=>3, 'msg'=>'修改失败']);
    	// 	// return $this->personalDataEdit($request);
    	// }

    }


    //加载密码修改页面
    public function personalPasswordEdit()
    {
    	
    	return view('/Home/password-edit');
    }


    public function personalPasswordUpdata(Request $request)
    {
    	$users = $this->personalData($request);
        $currentpass = $request->input('currentpass');
        $updatapass = $request->input('updatapass');
        $confirmpass = $request->input('confirmpass');


        //判断当前页面是否输入正确
        if ( password_verify($currentpass, $users[0]->password)) {

            if (!preg_match('/^\S{6,20}$/', $updatapass)) {
                echo json_encode(['status'=>4, 'msg'=>'密码字符必须为6-20位，建议任意两种字符组合']);
                exit;
            }

            if ($updatapass==$confirmpass) {
                 $updatapass = password_hash($updatapass, PASSWORD_DEFAULT);

                //执行修改密码
                $bool =  DB::table('users')
                    ->where('id', $users[0]->id)
                    ->update(['password' => $updatapass]);

                if ($bool) {
                    //修改成功后删除session退出当前登录  返回登录页
                    $request->session()->forget('userid');
                    $request->session()->forget('username');
                    echo json_encode(['status'=>1, 'msg'=>'修改成功']); 
                    return;
                }

            } else {
                echo json_encode(['status'=>3, 'msg'=>'两次输入密码不一致！']); 
                return;
            }       

        } else {
            echo json_encode(['status'=>2, 'msg'=>'原来密码有误！']); 
            return;
        }
       
    	// return view('/Home/password-edit', ['userdata', $user]);
    }


    //会员级别修改
    public function personalRank()
    {
        $user = User::select('id','rank')->where('id', $_GET['uid'])->first();
        if($user->rank == 1) {
           $bool =  DB::table('users')->where('id', $_GET['uid'])->update(['rank'=> 2]);
            if ($bool) {
                return redirect('home/personal')->with('msg', '现在级别为VIP！');
            }
        } else {
            $bool = DB::table('users')->where('id', $_GET['uid'])->update(['rank'=> 3]);
            if ($bool) {
                return redirect('home/personal')->with('msg', '现在级别为钻石！');
            }
        } 
        // $user = User::where('id', $_GET['uid'])->update(['rank'=> ]);
    }


}
