<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Detail;
use App\Model\Category;

/**
 * @author yaoqi <383495167@qq.com>
 * @description 商品列表页的业务处理
 */
class GoodsController1 extends Controller
{
    //展示商品信息
    public function main ()
    {
        $data = Goods::select([
            'id', 'p_id',
            'brand_id', 'brand_name',
            'goods_pic', 'goods_name',
            'price', 'present_price',
            'store_count', 'goods_remark',
            'is_hot','sales_num', 'status',
            'created_at', 'updated_at',
        ])->orderby('id', 'desc')->paginate(2);
        $count = Goods::count('id');
        // var_dump($count);
        return view('Admin/product/product-list', ['count'=> $count, 'data'=> $data]);
    }

    //展示添加商品页面
    public function add ()
    {
        $cateres = Category::select(['id', 'type_name', 'parent_id'])
            ->where('parent_id', 0)
            ->get();
        return view('Admin/product/product-add', ['cateres'=>$cateres]);
    }


    //添加商品信息
    public function index (Request $request) {
        $p_id = $request->input('p_id');
        $brand_id = $request->input('brand_id');
        $brand_name = $request->input('brand_name');
        $goods_name = $request->input('goods_name');
        $store_count = $request->input('store_count');
        $price = $request->input('price');
        $present_price = $request->input('present_price');
        $goods_remark = $request->input('goods_remark');
        $goods_pic = $request->input('goods_pic');
        $status= $request->input('status');
        $bool = Goods::insert([
            'p_id' => $p_id,
            'brand_id' => $brand_id,
            'goods_name' => $goods_name,
            'store_count' => $store_count,
            'price' => $price,
            'goods_remark' => $goods_remark,
            'goods_pic' => $goods_pic,
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if ($bool) {
            return $this->json(0, '商品信息添加成功');
        } else {
            return $this->json(-1, '添加失败');
        }
    }

    //修改商品是否上架状态
    public function pupdate (Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        if ($status==0) {
            $status = 1;
        }else if ($status==1) {
            $status = 0;
        }
        // var_dump($status);
        $bool = Goods::where('id', $id)->update(['status'=>$status]);
        $res = Goods::select(['status'])->where('id', $id);
        if ($bool) {
            return $this->json(0, '状态更新成功' , ['data'=> $res]);
        } else {
            return $this->json(-1, '状态更新失败');
        }
    }

    //展示商品信息编辑页面
    public function show ($id)
    {
        // $id = $request->input('id');
        $data = Goods::select([
                'id',
                'p_id',
                'brand_id',
                'goods_name',
                'store_count',
                'price',
                'goods_remark',
                'goods_pic',
                'status',
        ])->where('id', $id)->first();
        // var_dump($data);
        return view('Admin/product/product-edit', ['data'=>$data]);
    }

    public function gupdate (Request $request)
    {
        $id = $request->input('id');
        $p_id = $request->input('p_id');
        $brand_id = $request->input('brand_id');
        $goods_name = $request->input('goods_name');
        $store_count = $request->input('store_count');
        $price = $request->input('price');
        $goods_remark = $request->input('goods_remark');
        $goods_pic = $request->input('goods_pic');
        $status= $request->input('status');
        $date = date('Y-m-d H:i:s');
        // var_dump($id);
        // var_dump($goods_name);
        $bool = Goods::where('id', $id)->update([
            'p_id' => $p_id,
            'brand_id' => $brand_id,
            'goods_name' => $goods_name,
            'store_count' => $store_count,
            'price' => $price,
            'goods_remark' => $goods_remark,
            'goods_pic' => $goods_pic,
            'status' => $status,
            'updated_at' => $date,
        ]);
        if ($bool) {
            return $this->json(0, '修改成功');
        } else {
            return $this->json(-1, '修改失败');
        }
    }

    //删除商品数据
    public function dele (Request $request) {
        $id = $request->input('id');

        $bool = Goods::where('id', $id)->delete();

        $boold = Detail::where('gid', $id)->delete();
        if ($bool && $boold) {
            return $this->json(0, '删除成功');
        } else {
            return $this->json(-1, '删除失败');
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
