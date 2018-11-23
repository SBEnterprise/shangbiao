<?php

namespace App\Http\Controllers\Rbac;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use DB;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{	
	//加载权限页面
    public function index(Request $request)
	{
		$map = [];

		$keyword = $request->input('keyword');
		
		if ($keyword) {
			$map[] = ['name','like','%'.$keyword.'%'];
		}

		$permission = Permission::where($map)
		->paginate(5);
		return view('Admin/admin-permission',
			[
				'permission' => $permission,
				'keyword' => $keyword,
			]
		);
	}

	//加载添加权限页面
	public function create()
	{
		return view('Admin/admin-permission-add');
	}

	//执行添加权限
	public function store(Request $request)
	{
		$this->validate($request,
			[
				'name' => 'required|unique:permissions,name',
				'display_name' => 'required',
				'description' => 'required',
			],
			[
				'name.required' => '权限名称不能为空',
				'name.unique' => '权限名称已存在',
				'display_name.required' => '权限列表不能为空',
				'description.required' => '描述不能为空',
			]
			);

		$permission = new Permission();
		$permission->name = $request->input('name');
		$permission->display_name = $request->input('display_name');
		$permission->description =$request->input('description');
		$permission->save();

		return redirect()->route('permissions')->with('success','创建权限成功！');
	}

	/**
	 * [edit 加载权限修改页面]
	 * @param  [int] $id [权限ID]
	 * @return [array]     [权限数据]
	 */
	public function edit($id)
	{	
		$permission = Permission::find($id);
    	return view('Admin/admin-permission-edit',['permission' => $permission]);
	}

	/**
	 * [update 执行修改]
	 * @param  Request $request [接受表单提交过来的数据]
	 * @param  [int]  $id      [权限ID]
	 * @return     [重定向跳转]
	 */
	public function update(Request $request,$id)
	{
		$this->validate($request,
			[
				'name' => [
	    				'required',
	    		 		Rule::unique('permissions')->ignore($id),
	    		],
				'display_name' => 'required',
				'description' => 'required',
			],
			[
				'name' => '权限名称不能为空',
				'display_name.required' => '权限列表不能为空',
				'description.required' => '描述不能为空',
			]
		);
		$permission = Permission::find($id);
		$permission->name = $request->input('name');
    	$permission->display_name = $request->input('display_name');
    	$permission->description = $request->input('description');
    	$permission->update();

    	return redirect()->route('permissions')->with('success','修改权限成功！');
	}

	public function show()
	{
		
	}

	/**
	 * [destory 执行权限节点添加]
	 * @param  [int] $id [权限节点id]
	 * @return [string]     [删除节点信息]
	 */
	public function destory($id)
	{
		if (!$id) {
			return redirect()->route('permissions')->with('false','删除角色失败');
		} else {
			$role = DB::table('permissions')->where('id', $id)->delete();
		}
		if( !$role ) {
			return redirect()->route('permissions')->with('false','删除角色失败');
		} else {
			return redirect()->route('permissions')->with('success','删除角色成功');
		}
	}
}
