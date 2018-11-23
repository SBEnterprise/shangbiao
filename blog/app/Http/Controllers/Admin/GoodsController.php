<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\Search;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Goods;
use App\Model\Detail;
use App\Model\Category;
use \DB;
use Excel;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Http\Controllers\Api\CommonApi;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


/**
 * @author yaoqi <383495167@qq.com>
 * @description 商品列表页的业务处理
 */
class GoodsController extends Controller
{
    /**
     * 展示商品信息
     * @author yaoqi
     * @return 视图, 要加载到页面的商品详情
     */
    public function main (Request $request)
    {
        $brand_name = $request->input('brand_name');
        $goods_name = $request->input('goods_name');
        // var_dump($brand_name);
        $map[] = ['id', '>', 1];
        if ($brand_name) {
            $map[] = ['brand_name', 'like', '%'.$brand_name.'%'];
        }
        if ($goods_name) {
            $map[] = ['goods_name', 'like', '%'.$goods_name.'%'];
        }
        $data = Goods::select('*')->where($map)->orderby('id', 'desc')->paginate(4);
        $count = Goods::count('id');
        // var_dump($count);
        return view('Admin/product/product-list',
            ['count'=> $count, 'data'=> $data, 'brand_name' => $brand_name, 'goods_name' => $goods_name]);
    }

    /**
     * 添加商品页面
     * @author yaoqi
     * @return 视图, 要加载到页面的商品详情
     */
    public function add ()
    {
        $cateres = Category::select(['id', 'type_name', 'parent_id'])
            ->where('parent_id', 0)
            ->get();
        $branddata = Brand::select(['brand_id', 'brand_name'])
                ->get();
        // dd($branddata);
        return view('Admin/product/product-add', ['cateres'=>$cateres, 'branddata' => $branddata]);
    }

    /**
     * 执行商品信息添加
     * @param $filename 图片名
     * @author yaoqi
     * @return 重定向到视图
     */
    public function index (Request $request, $filename="pic")
    {


        $pic = $_FILES['pic']['name'];
        $p_id = $request->input('p_id');
        // $brand_id = $request->input('brand_id');
        $brand_id = $request->input('brand_name');
        $goods_name = $request->input('goods_name');
        $store_count = $request->input('store_count');
        $price = $request->input('price');
        $present_price = $request->input('present_price');
        $goods_remark = $request->input('goods_remark');
        $sales_num = $request->input('sales_num');
        $is_hot = $request->input('is_hot');
        $status = $request->input('status');
        $date = date('Y-m-d H:i:s');

        $brandnamedata = Brand::select('brand_id','brand_name')->where('brand_id', $brand_id)->first();
        $brand_name = $brandnamedata->brand_name;
        // dd($pic);
        if (!empty($pic)) {
            $Common = new CommonApi;
            $res = $Common->uploadToQiNiu($request, $filename);
            // dd($res);
            // if (!empty($res)) {
                $goods_pic = $res['goodimages'];
            // }
        } else {
            die('请填写完整的商品信息');
        }
        // var_dump($goods_pic);die;
        $bool = Goods::insertGetId([
            'p_id' => $p_id,
            'brand_id' => $brand_id,
            'brand_name' => $brand_name,
            'goods_pic' => $goods_pic,
            'price' => $price,
            'present_price' => $present_price,
            'goods_name' => $goods_name,
            'store_count' => $store_count,
            'goods_remark' => $goods_remark,
            'sales_num' => $sales_num,
            'is_hot' => $is_hot,
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s'),

        ]);
        if ($bool) {

            //组装需要添加到索引的数据
            $array = [
                'id'    =>  $bool,
                'p_id' => $p_id,
                'brand_name' => $brand_name,
                'goods_pic' => $goods_pic,
                'price' => $price,
                'present_price' => $present_price,
                'goods_name' => $goods_name,
                'store_count' => $store_count,
                'goods_remark' => $goods_remark,
                'sales_num' => $sales_num,
                'is_hot' => $is_hot,
                'status' => $status,
            ];

            //将数据添加进索引服务器, 提供给搜索使用
            $search = new Search('shop');
            $search->addDocumentData($array);


            return redirect('admin/product/product-list')->with('msg', '添加成功');
            // return $this->json(0, '商品信息添加成功');
        } else {
            return back()->with('errorTip', '添加失败');
            // return $this->json(-1, '添加失败');
        }
    }

    /**
     * 执行商品信息状态修改
     * @param $filename 图片名
     * @author yaoqi
     * @return 重定向到视图
     */
    public function statusUpdate (Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        if ($status==0) {
            $status = 1;
        } else if ($status==1) {
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

    /**
     * 商品信息编辑页面
     * @param $id 要展示的商品id $data 查询相出来的数据
     * @author yaoqi
     * @return 视图, $data要编辑的数据
     */
    public function show ($id)
    {
        // $id = $request->input('id');
        $data = Goods::select([
            'id', 'p_id',
            'brand_id', 'brand_name',
            'goods_name', 'store_count',
            'price', 'present_price',
            'goods_remark', 'goods_pic',
            'status', 'is_hot',
            'sales_num',
        ])->where('id', $id)->first();
        // var_dump($data);
        return view('Admin/product/product-edit', ['data'=>$data]);
    }

    /**
     * 执行商品信息修改
     * @param $filename 图片名
     * @author yaoqi
     * @return 重定向到视图
     */
    public function update (Request $request, $filename="pic")
    {
        $Common = new CommonApi;
        $res = $Common->uploadToQiNiu($request, $filename);
        // dd($res);die;
        $id = $request->input('gid');
        if ($res['status'] != 2200) {
            $rspic = Goods::select(['goods_pic'])->where('id', $id)->first();
            $goods_pic = $rspic->goods_pic;
        } else {
            $goods_pic = $res['goodimages'];
        }
        $p_id = $request->input('p_id');
        $brand_id = $request->input('brand_id');
        $brand_name = $request->input('brand_name');
        $goods_name = $request->input('goods_name');
        $store_count = $request->input('store_count');
        $price = $request->input('price');
        $present_price = $request->input('present_price');
        $goods_remark = $request->input('goods_remark');
        $sales_num = $request->input('sales_num');
        $is_hot = $request->input('is_hot');
        $status = $request->input('status');
        $date = date('Y-m-d H:i:s');
        $bool = Goods::where('id', $id)->update([
            'p_id' => $p_id,
            'brand_id' => $brand_id,
            'brand_name' => $brand_name,
            'goods_name' => $goods_name,
            'store_count' => $store_count,
            'price' => $price,
            'present_price' => $present_price,
            'goods_remark' => $goods_remark,
            'sales_num' => $sales_num,
            'goods_pic' => $goods_pic,
            'is_hot' => $is_hot,
            'status' => $status,
            'updated_at' => $date
        ]);
        if ($bool) {

            $indexArray = [
                'id' => $id,
                'p_id' => $p_id,
                'brand_id' => $brand_id,
                'brand_name' => $brand_name,
                'goods_name' => $goods_name,
                'store_count' => $store_count,
                'price' => $price,
                'present_price' => $present_price,
                'goods_remark' => $goods_remark,
                'sales_num' => $sales_num,
                'goods_pic' => $goods_pic,
                'is_hot' => $is_hot,
                'status' => $status,
                'updated_at' => $date
            ];

            $search = new Search();
            $search->updateDocumentData($indexArray);

            return redirect('admin/product/product-list');
        } else {
            return redirect('admin/product/product-list');
        }
    }

    /**
     * 执行删除商品数据
     * @param $id 要删除的商品的id
     * @author yaoqi
     * @return json数据
     */
    public function dele (Request $request) {
        $id = $request->input('id');

        $bool = Goods::where('id', $id)->delete();
        $detailData = Detail::where('gid', $id)->first();
        if (!empty($detailData)) {
            $boold = Detail::where('gid', $id)->delete();
            if ($boold) {
                return $this->json(0, '删除商品属性成功');
            } else {
                return $this->json(-1, '删除商品属性失败');
            }
        }

        if ($bool) {

            //删除索引库的索引
            $search = new Search();
            $search->delDocumentData($id);

            return $this->json(0, '删除商品成功');
        } else {
            return $this->json(-1, '删除商品失败');
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

    /**
     * 执行导出商品数据
     * @param $id 要导出的商品的id
     * @author lizhentao
     * @return excel数据表
     */
    public function excel()
    {
      //查询所有商品数据
      $content = DB::table('goods')->select('id','p_id','brand_id','brand_name','goods_pic', 'goods_name', 'price', 'present_price','store_count','goods_remark','is_hot','sales_num','status','created_at','updated_at')->orderBy('id', 'desc')->get();
      $result = $content->toArray();

      Excel::create("Excel文档", function($excel) use($result)
      {
          //创建sheet
          $excel->sheet('sheet1',function($sheet)  use($result)
          {

            //填充每个单元格的内容
            $sheet->row(1,array('序号','分类ID','品牌id','品牌名','图片名', '商品名','原价','现价','库存量','商品描述','1热销0非热销','销量','1在售0下架','添加时间','修改时间'));
            $sheet->setWidth('A', 10);
            $is_hot = [1=>'热销',0=>'非热销'];
            $status = [1=>'在售', 0=>'下架'];
            $j = 2;
            foreach ($result as $k => $v) {
               $sheet->row($j,array($k+1,$v->p_id,$v->brand_id,$v->brand_name,$v->goods_pic,
                                    $v->goods_name,$v->price,$v->present_price,$v->store_count,$v->goods_remark,
                                    $is_hot[$v->is_hot],$v->sales_num,$status[$v->status],$v->created_at,$v->updated_at
                                  ));
                $j++;
            }
          });
      })->export('xls');

    }


    /**
     * 执行导出商品数据
     * @param $id 要导入的商品
     * @author lizhentao
     * @return excel数据表
     */
    public function returnExcel(Request $request)
    {

        //导入的时候  上传文件
        if (!$request->hasFile('file')) {
         return [
             'success' => false,
             'message' => '上传文件为空'
         ];
        }
        $file = $request->file('file');
        if (!$file->isValid()) {
         return [
             'success' => false,
             'message' => '文件上传出错'
         ];
        }
        $extension = $file->getClientOriginalExtension();
        $storage_path = storage_path('app/public/excel');//上传文件保存的路径
        if (!file_exists($storage_path)) {//如果$storage_path（文件保存的目录）不存在
         mkdir($storage_path, 0777, true);//创建一个目录
        }
        $filename = md5(millisecond()) . '.' . $extension;//文件名
        if ($file->move($storage_path, $filename) == false) {//移动一个已上传的文件
         return [
             'success' => false,
             'message' => '文件保存失败'
         ];
        }
        return [//上传成功返回文件名称
         'success' => true,
         'message' => $filename
        ];


    }

}
