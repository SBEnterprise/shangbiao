<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Detail;
use App\Model\Goods;

/**
 * @author yaoqi <383495167@qq.com>
 * @description 商品详情页的业务处理
 */
class DetailController extends Controller
{
    /**
     * 展示对应的商品详情列表页
     * @param  int  $id $data 查询的商品属性的数据
     * @author yaoqi
     * @return 视图, 查询到的数据
     */
    public function index ($id) {
        $data = Goods::find($id)->detail;
        if (empty($data)) {
            die('商品属性不存在，请添加商品属性');
        }
        // dd($data);
        return view('Admin/product/detail-list', ['data'=>$data]);
    }

    /**
     * 展示详情修改页面
     * @param  int  $gid $data 要修改的商品的数据
     * @author yaoqi
     * @return 视图, 要加载到页面的数据
     */
    public function edit ($gid) {
        $data = Detail::select([
            'gid', 'style',
            'weight', 'year',
            'series', 'watch_strap',
            'braceletColor', 'buckle',
            'watch_case', 'movement_name',
            'dial_size', 'dial_thickness',
        ])
        ->where('gid', $gid)->first();
        // var_dump($data);
        return view('Admin/product/detail-edit', ['data'=>$data]);
    }

    /**
     * 执行商品属性的修改
     * @author yaoqi
     * @return json数据
     */
    public function update (Request $request) {
        $date = date('Y-m-d H:i:s');
        $gid = $request->input('gid');
        $year = $request->input('year');
        $style = $request->input('style');
        $series = $request->input('series');
        $buckle = $request->input('buckle');
        $weight = $request->input('weight');
        $dial_size = $request->input('dial_size');
        $Watch_case = $request->input('Watch_case');
        $Watch_strap = $request->input('Watch_strap');
        $BraceletColor = $request->input('BraceletColor');
        $Movement_name = $request->input('Movement_name');
        $dial_thickness = $request->input('dial_thickness');
        $bool = Detail::where('gid', $gid)->update(
        [
            'year' => $year,
            'style' => $style,
            'series' => $series,
            'buckle' => $buckle,
            'weight' => $weight,
            'updated_at' => $date,
            'dial_size' => $dial_size,
            'Watch_case' => $Watch_case,
            'Watch_strap' => $Watch_strap,
            'BraceletColor' => $BraceletColor,
            'Movement_name' => $Movement_name,
            'dial_thickness' => $dial_thickness,
        ]);
        if ($bool) {
            return $this->json(0, '修改成功');
        } else {
            return $this->json(-1, '修改失败');
        }

    }

    /**
     * 编辑对应的商品详情页面
     * @param  int  $id 要修改的商品的id
     * @author yaoqi
     * @return 视图, 要加载到页面的商品详情id
     */
    public function show ($id) {
        return view('Admin/product/detail-add', ['id'=>$id]);
    }

    /**
     * 添加商品属性之前先检查该商品有没有对应的属性
     * @param  int  $id $data 属性表查询出来的数据
     * @author yaoqi
     * @return json数据
     */
    public function check (Request $request) {
        $id = $request->input('id');
        $data = Goods::find($id)->detail;
        // var_dump($data);
        if (empty($data)) {
            return $this->json(0, '',['id'=>$id]);
        } else {
            return $this->json(-1, '商品属性已存在，不能重复添加');
        }
    }

    /**
     * 执行商品详情添加
     * @author yaoqi
     * @return json数据
     */
    public function add (Request $request) {
        $date = date('Y-m-d H:i:s');
        $gid = $request->input('gid');
        $year = $request->input('year');
        $style = $request->input('style');
        $series = $request->input('series');
        $buckle = $request->input('buckle');
        $weight = $request->input('weight');
        $dial_size = $request->input('dial_size');
        $Watch_case = $request->input('Watch_case');
        $Watch_strap = $request->input('Watch_strap');
        $BraceletColor = $request->input('BraceletColor');
        $Movement_name = $request->input('Movement_name');
        $dial_thickness = $request->input('dial_thickness');

        $bool = Detail::insert([
            'gid' => $gid,
            'year' => $year,
            'style' => $style,
            'series' => $series,
            'weight' => $weight,
            'buckle' => $buckle,
            'created_at' => $date,
            'dial_size' => $dial_size,
            'Watch_case' => $Watch_case,
            'Watch_strap' => $Watch_strap,
            'BraceletColor' => $BraceletColor,
            'Movement_name' => $Movement_name,
            'dial_thickness' => $dial_thickness,
        ]);
        if ($bool) {
            return $this->json(0, '商品详情添加成功');
        } else {
            return $this->json(-1, '添加失败');
        }
    }
    public function json($code, $msg, $data=[])
    {
        return response()->json([
            'status' => $code,
            'msg' => $msg,
            'data' => $data,
        ]);
    }
}
