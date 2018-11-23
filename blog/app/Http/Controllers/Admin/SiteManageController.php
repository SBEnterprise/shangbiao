<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SiteManage;

class SiteManageController extends Controller
{
    public function json($code, $msg, $data=[])
    {
        return response()->json([
            'status' => $code,
            'msg' => $msg,
            'data' => $data,
        ]);
    }

    public function handler (Request $request) {
        // echo 11;
        // var_dump($_POST);
        $name = $request->input('name');
        $keyword = $request->input('keyword');
        $desc = $request->input('desc');
        $url = $request->input('url');
        $basename = $request->input('basename');
        $copyright = $request->input('cp');
        $record_num= $request->input('recnum');
        // dd($name);
        $bool = SiteManage::insert([
            'site_name'=> $name,
            'keyword'=> $keyword,
            'description'=> $desc,
            'url'=> $url,
            'basename'=> $basename,
            'copyright'=> $copyright,
            'record_num'=> $record_num,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        if ($bool) {
            return $this->json(0, '添加成功');
        } else {
            return $this->json(-1, '添加失败');
        }
    }

    public function main () {
        $info = SiteManage::select('id', 'site_name', 'keyword', 'description', 'url', 'basename', 'copyright', 'record_num', 'created_at', 'updated_at')->paginate(5);
        $count = SiteManage::count('id');
        // var_dump($info);
        return view('Admin/system/system-base-manage', ['count'=>$count, 'info' => $info]);
    }

    public function base () {
        return view('Admin/system/system-base');
    }

    public function show ($id) {

        $data = SiteManage::select(['id', 'site_name', 'keyword', 'description', 'url', 'basename', 'copyright', 'record_num'])->where('id', $id)->first();
        // var_dump($data);
        return view('Admin/system/system-edit', ['data' => $data]);
    }

    public function update (Request $request) {
        $id = $request->input('id');
        $name = $request->input('name');
        $keyword = $request->input('keyword');
        $desc = $request->input('desc');
           $url = $request->input('url');
        $basename = $request->input('basename');
        $copyright = $request->input('cp');
        $record_num= $request->input('recnum');
        $date = date('Y-m-d H:i:s');
        $bool = SiteManage::where('id', $id)->update([
            'site_name'=> $name,
            'keyword'=> $keyword,
            'description'=> $desc,
            'url'=> $url,
            'basename'=> $basename,
            'copyright'=> $copyright,
            'record_num'=> $record_num,
            'updated_at'=> $date,
        ]);

        if ($bool) {
            return $this->json(0, '修改成功');
        } else {
            return $this->json(-1, '修改失败');
        }
    }

    //删除网站信息
    public function delete (Request $request) {
        $id = $request->input('id');
        if ($id==3) {
            return $this->json(-1, '禁止删除');
        }
        $bool = SiteManage::where('id', $id)->delete();
        if ($bool) {
             return $this->json(0, '已删除成功');
        } else {
            return $this->json(-1, '删除失败');
        }
    }

}
