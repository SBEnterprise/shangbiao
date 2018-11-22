<?php

namespace App\Http\Controllers\Rbac;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Models\Role;
use Hash;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
	//加载用户页面
	public function index(Request $request)
	{	
		$map = [];

		$keyword = $request->input('keyword');

		if ($keyword) {
			$map[] = ['user_name','like','%'.$keyword.'%'];
		}

		$users = User::where($map)
		->paginate(5);

		return view('Admin/admin-list',
			[
			'users'=>$users,
			'keyword'=>$keyword,
			]
		);
	}
	//加载添加用户界面
	public function create()
	{
		$roles = Role::get();
		return view('Admin/admin-add',['roles'=>$roles]);
	}
	//执行用户添加
	public function store(Request $request)
	{

		$this->validate($request,
			[
				'user_name' => 'required|unique:users,user_name',
				'email' => 'required|email|unique:users,email',
				'password' => 'required|same:confirm-password',
				'roles'=>'required',
				'phone'=>'required|unique:users,phone',
			],
			[
				'user_name.required' => '管理员名称不能为空',
				'user_name.unique' => '管理员名称已存在',
				'email.required' => '邮箱不能为空',
				'email.email' => '请输入正确的邮箱格式',
				'email.unique' =>'邮箱已存在',
				'password.required' => '密码不能为空',
				'password.same' => '两次密码不一致',
				'roles.required' => '角色不能为空',
				'phone.required' => '电话号码不能为空',
				'phone.unique' => '该电话号码已创建过用户',
			]

		);
		
		$user = new User();
		$user->user_name = $request->input('user_name');
		$user->email = $request->input('email');
		$user->phone =$request->input('phone');
		$user->password = Hash::make($request->input('password'));
		$user->add_time = date('Y-m-d H:i:s',time());
		$user->save();
		//添加角色
		$role_user = [];
		foreach ($request->input('roles') as $key => $value) 
		{
			$role_user[] = ['role_id' => $value,'user_id' => $user->id];
		}
		DB::table('role_user')->insert($role_user);
		
		return redirect()->route('users')->with('success','创建管理员成功！');
	}

	/**
	 * [edit 加载修改页面]
	 * @param  [int] $id [用户id]
	 * @return [array]     [用户数据and角色数据]
	 */
	public function edit($id)
	{
		$user= User::find($id);

    	$roles = Role::get();
    	
    	return view('Admin/admin-user-edit', ['user'=>$user,'roles' => $roles]);
	}

	/**
	 * [update 执行更新]
	 * @param  Request $request [description]
	 * @param  [int]  $id      [用户ID]
	 * @return [string]           [description]
	 */
	public function update(Request $request,$id)
	{

		$this->validate($request, 
			[
	    		'name' => [
	    				'required',
	    		 		Rule::unique('users')->ignore($id),
	    		],
	    		'email' => [
	    				'required',
	    				'email',
	    		 		Rule::unique('users')->ignore($id),
	    		],
	    		'phone' =>[
	    				'required',
	    				'size:11',
	    				Rule::unique('users')->ignore($id),
	    		],
	    		'password' => 'same:confirm-password',
	    		'roles' => 'required',
    		],
    		[	
    			'name.required' => '管理员名称不能为空',
    			'name.unique' => '管理员名称已存在',
    			'email.required' => '邮箱不能为空',
    			'email.unique' => '邮箱已存在',
    			'phone.required' => '电话号码不能为空',
    			'phone.size' => '请输入正确的电话号码',
    			'password.same' => '两次密码不一致',
    			'roles.required' => '请选择角色',
    		]
    	);
		
		$user = User::find($id);
		$user->name = $request->input('user_name');
		$user->email = $request->input('email');
		$user->phone =$request->input('phone');

		if(!empty($request->input('password'))) {

			$user->password = Hash::make($request->input('password'));
		}
		$user->update();

		//先删除后 添加角色
		DB::table('role_user')->where('user_id',$id)->delete();

		$role_user = [];

		foreach ($request->input('roles') as $key => $value) 
		{
			$role_user[] = ['role_id' => $value,'user_id' => $user->id];
		}
		
		DB::table('role_user')->insert($role_user);
		
		return redirect()->route('users')->with('success','修改成功！');
	}

	public function show()
	{
		
	}

	public function destory($id)
	{
		$name = DB::table('roles')->select('name')->where('id',$id)->first();

		if( $name ='superadmin' ) {

			return redirect()->route('users')->with('false','你不可以删除超级管理员');

		} else {

			$users = DB::table('users')->where('id', $id)->delete();

			if( !$users ) {

					return redirect()->route('users')->with('false','删除失败');

				} else {

					return redirect()->route('users')->with('success','删除成功');
			}
		}
	}
}
