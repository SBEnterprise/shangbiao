<?php

namespace App\Http\Controllers\Rbac;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use DB;



class RoleController extends Controller
{
	//加载角色列表
	public function index()
	{
		$roles = Role::paginate(5);

		return view('Admin/admin-role',['roles'=>$roles]);
	}

	//加载角色添加模板
	public function create()
	{
		$permissions = Permission::get();

		return view('Admin/admin-role-add',['permissions'=>$permissions]);
	}

	/**
	 * [store 执行添加]
	 * @param  Request $request [接受表单提交过来的数据]
	 * @return [string]           [返回创建情况]
	 */
	public function store(Request $request)
	{
		$this->validate($request,
			[
				'name' => 'required|unique:roles,name',
				'display_name' => 'required',
				'description' => 'required',
				'permissions' => 'required',
			],
			[
				'name.required' => '角色名称不能为空',
				'name.unique' => '角色名称已存在',
				'display_name.required' => '用戶列表不能為空',
				'description.required' => '角色描述不能為空',
				'permissions.required' => '请选择权限',
			]
		);

		$role = new Role();
		$role->name = $request->input('name');
		$role->display_name = $request->input('display_name');
		$role->description =$request->input('description');
		$role->save();

		$permission_role = [];

        foreach ($request->input('permissions') as $key => $value) {

            $permission_role[] = ['role_id' => $role->id, 'permission_id' => $value];

        }

        DB::table('permission_role')->insert($permission_role);


		return redirect()->route('roles')->with('success','创建成功！');
	}

	/**
	 * [edit 加载修改页面]
	 * @param  [int] $id [角色ID]
	 * @return [array]     [角色信息数据]
	 */
	public function edit($id)
	{
		$role = Role::find($id);

		$permissions = Permission::get();
    	
    	return view('Admin/admin-role-edit', ['role' => $role,'permissions'=>$permissions]);
	}

	/**
	 * [update 执行修改信息]
	 * @param  Request $request [接受表单提交过来的数据]
	 * @param  [int]  $id      [角色ID]
	 * @return [string]           [返回修改状态]
	 */
	public function update(Request $request,$id)
	{
		$this->validate($request,
			[
				'display_name' => 'required',
				'description' => 'required',
				'permissions' => 'required',
			],
			[
				'display_name.required' => '角色名称不能为空', 
				'description.required' => '角色描述不能为空', 
				'permissions.required' => '请选择权限',
			]
		);

		$role = Role::find($id);
    	$role->display_name = $request->input('display_name');
    	$role->description = $request->input('description');
    	$role->update();

    	// 先删除，后添加权限
        DB::table('permission_role')->where('role_id', $id)->delete();

        $permission_role = [];

        foreach ($request->input('permissions') as $key => $value) {

            $permission_role[] = ['role_id' => $id, 'permission_id' => $value];

        }

        DB::table('permission_role')->insert($permission_role);


    	return redirect()->route('roles')->with('success','修改成功！');
	}

	public function show()
	{
		
	}

	/**
	 * [destory 执行角色删除]
	 * @param  [int] $id [角色ID]
	 * @return [string]     [返回删除状态]
	 */
	public function destory($id)
	{

		$role = DB::table('roles')->where('id', $id)->delete();

		if( !$role ) {

			return redirect()->route('roles')->with('false','删除角色失败');

			} else {

				return redirect()->route('roles')->with('success','删除成功');
		}
		
	}
}
