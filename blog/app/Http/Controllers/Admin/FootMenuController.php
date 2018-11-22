<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\FootMenu;

/**
 * @author yaoqi <383495167@qq.com>
 * @description 尾部站内链接的相关处理
 */
class FootMenuController extends Controller
{
    //展示底部菜单详情页面
    public function index()
    {
        $res = DB::select('select * from footmenu order by concat(path,id)');
        return view('Admin/footmenu/footmenu', ['data' => $res]);
    }

    /**
     * 显示添加尾部菜单页面
     * @author yaoqi
     * @return 页面
     */
    public function add()
    {
        $res = DB::select('select * from footmenu order by concat(path,id)');
        return view('Admin/footmenu/footmenu-add', ['data' => $res]);

    }

    /**
     * 执行添加数据
     * @author yaoqi
     * @return 返回是否添加成功
     */
    public function save(Request $request)
    {
        $parent_id = $request->post('parent_id');
        $type_name = $request->post('type_name');
        $content = $request->post('content');
        if ( !empty($type_name) && is_numeric($parent_id) ){
            $is_exists = FootMenu::select('type_name', 'parent_id', 'content')->where('type_name', $type_name)->first();
            if( empty($is_exists) ) {
                if ( $parent_id == 0 ) {
                    $path = '0,';
                } else {
                    $res = DB::select('select path from footmenu where id = ?', [$parent_id]);
                    $path = $res[0]->path . $parent_id . ",";
                }

                $result = FootMenu::insert([
                        'type_name' => $type_name,
                        'parent_id' => $parent_id,
                        'path' => $path,
                        'content' => $content,
                ]);

                if($result) {
                    return json_encode(['status' => 1, 'msg' => '添加成功']);
                } else {
                    return json_encode(['status' => 0, 'msg' => '添加失败']);
                }
            } else {
                return json_encode(['status' => 2, 'msg' => '分类名已存在，请重新输入']);
            }
        }

    }

    /**
     * 删除分类
     * @author yaoqi
     * @return json_endcode 数据
     */
    public function del(Request $request)
    {
        $id = (int)$request->get('id');
        $num = FootMenu::select()->where('parent_id', $id)->count();
        if ($num > 0) {
            return json_encode(['status'=>0,'msg'=>'此分类下还有分类，不能直接删除']);
        } else {
            $res = DB::table('footmenu')->where('id', '=', $id)->delete();
            return json_encode(['status'=>1,'msg'=>'删除成功']);
        }
    }

    /**
     * 显示修改页面
     * @param  int  $id
     * @author yaoqi
     * @return 页面
     */
    public function show($id)
    {
        $data = FootMenu::select(['id', 'type_name', 'parent_id', 'content'])->where('id' ,$id)->first();
        return view('Admin/footmenu/footmenu-edit', ['data' => $data]);
    }

    /**
     * 执行修改数据
     * @author yaoqi
     * @return json_encode数据
     */
    public function update(Request $request)
    {
        $id = (int)$request->input('id');
        $type_name = $request->input('type_name');
        $content = $request->input('content');
        $bool = FootMenu::where('id', $id)
                    ->update([
                        'type_name' => $type_name,
                        'content' => $content,

                    ]);
        if ($bool) {
            return json_encode(['status'=>1, 'msg'=>'修改成功']);
        } else {
            return json_encode(['status'=>0, 'msg'=>'修改失败']);
        }
    }
}


