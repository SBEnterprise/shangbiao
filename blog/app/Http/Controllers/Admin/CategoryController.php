<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Category;

/**
 * 后台分类管理类
 * @author dengxiaoxie
 * 
 */
class CategoryController extends Controller
{
	public function index()
	{
		$res = DB::select('select * from category order by concat(path,id)');
		return view('Admin/category/product-category',['data'=>$res]);
	}

  	/**
  	 * 显示添加分类页面
  	 * @author 
  	 * @return 页面
  	 */
	public function add()
	{
		$res = DB::select('select * from category order by concat(path,id)');
		return view('Admin/category/product-category-add',['data'=>$res]);

	}

  	/**
  	 * 保存添加分类
  	 * @author 
  	 * @return 返回是否添加成功
  	 */
	public function save(Request $request)
	{
		$type_name = $request->post('type_name');
		$parent_id = $request->post('parent_id');
// var_dump($_POST);exit;
		if (!empty($type_name) && is_numeric($parent_id)){
			$is_exists = Category::select(['type_name', 'parent_id'])->where('type_name', $type_name)->first();
			if(empty($is_exists)) {
				if ($parent_id == 0) {
					$path = '0,';		
				} else {

					$res = DB::select('select path from category where id = ?',[$parent_id]);
					$path = $res[0]->path . $parent_id . ",";
				}

				$result = DB::table('category')->insert(
					['type_name'=>$type_name, 'parent_id'=>$parent_id, 'path'=>$path]
				);
				if($result) {
					return json_encode(['status'=>1,'msg'=>'添加成功']);
				} else {
					return json_encode(['status'=>0,'msg'=>'添加失败']);
				}
			} else {
				return json_encode(['status'=>2,'msg'=>'分类名已存在，请重新输入']);
			}
		}

	}

  	/**
  	 * 删除分类
  	 * @author 
  	 * @return json_endcode 数据
  	 */
	public function del(Request $request)
	{
		$id = (int)$request->get('id');
		$num = Category::select()->where('parent_id', $id)->count();
		if ($num > 0) {
			return json_encode(['status'=>0,'msg'=>'此分类下还有分类，不能直接删除']);
		} else {
			$res = DB::table('category')->where('id', '=', $id)->delete(); 
			return json_encode(['status'=>1,'msg'=>'删除成功']);
		}
	}

  	/**
  	 * 显示修改分类页面
  	 * @param  int  $id
  	 * @author 
  	 * @return 页面
  	 */
	public function show($id)
	{
		$data = Category::select(['id','type_name'])->where('id',$id)->first();
		return view('Admin/category/product-category-edit',['data'=>$data]);
	}
  	/**
  	 * 保存修改的分类
  	 * @author 
  	 * @return json_encode数据
  	 */
	public function update(Request $request)
	{
		$id = (int)$request->input('id');
		$type_name = $request->input('type_name');
		$is_exists = Category::select('type_name')->where('type_name',$type_name)->first();
		if ( !empty($is_exists) ) {

			return json_encode(['status'=>2,'msg'=>'分类名已存在，请重新输入']);
			exit;
		}
	
		$bool = DB::table('category')->where('id',$id)->update(['type_name'=>$type_name]);

		if ($bool > 0) {

			return json_encode(['status'=>1,'msg'=>'修改成功']);

		} else {

			return json_encode(['status'=>0,'msg'=>'修改失败']);
		}

		return view('Admin/category/product-category-edit',['data'=>$data]);
	}

}

