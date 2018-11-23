<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\CommonApi;
use App\Model\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CarouselController extends Controller
{
    //加载后台轮播图管理页面
    public function showView()
    {
        $carouselData = DB::table('carousel')
            ->select('id', 'title', 'pic_url', 'status','path_url','created_at', 'updated_at')
            ->paginate(5);
        return view('Admin/system-carousel', ['carouselData' => $carouselData]);
    }

    //加载添加轮播图页面
    public function showCarouselAdd()
    {
        return view('Admin/system-carousel-add');
    }

    //处理轮播图添加
    public function carouselAdd(Request $request, $filename="pic")
    {
        $picName = $_FILES['pic']['name'];
        $status = $request->input('status');
        $path_url = $request->input('path');
        $title = $request->input('desc');

        if(!empty($picName)) {
            $qiNiu = new CommonApi();
            $pic = $qiNiu->uploadToQiNiu($request, $filename);
            $picture = $pic['goodimages'];
        }else{
            die('请上传图片');
        }

        $res = Carousel::insert([
            'title'     =>  $title,
            'pic_url'   =>  $picture,
            'path_url'  =>  $path_url,
            'status'    =>  $status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if($res) {
            return redirect('admin/carousel')->with('msg', '添加成功');
        }else{
            return back()->with('errorMsg', '添加失败');
        }
    }

    //加载轮播图信息更新页面
    public function showCarouselEdit($id)
    {

        $editData = Carousel::select([
            'id',
            'title',
            'pic_url',
            'path_url',
            'status',
            'created_at',
            'updated_at',
        ])->where('id', $id)
          ->first();
          $count = Carousel::count('id');
//        dd($editData);
        return view('Admin/system-carousel-edit', ['editData' => $editData, 'count' => $count]);
    }

    //处理轮播图信息更新
    public function carouselEdit(Request $request, $filename='pic')
    {

        $id = $request->input('c_id');
        $qiNiu = new CommonApi();
        $res = $qiNiu->uploadToQiNiu($request, $filename);

        if( $res['status'] != 2200 ) {
            $pic = Carousel::select('pic_url')->where('id', $id)->first();
            $pic_url = $pic->pic_url;
        }else{
            $pic_url = $res['goodimages'];
        }

        //整理数据
        $title = $request->input('title');
        $path_url = $request->input('path_url');
        if(empty(trim($path_url))){
            return back()->with('msg', '链接地址不能为空');
        }
        $status = $request->input('status');
        $update_at = date('Y-m-d H:i:s');

        //组装成数组
        $array = [
            'title'      =>   $title,
            'path_url'   =>   $path_url,
            'status'    =>   $status,
//            'updated_at' =>   $update_at,
            'pic_url'    =>   $pic_url,
        ];

        //更新数据
        $updateRes = Carousel::where('id', $id)->update($array);
        if ($updateRes) {
           return redirect('admin/carousel');
        } else {
            return redirect('admin/carouselEdit');
        }

    }

    //删除轮播图
    public function carouselDel(Request $request)
    {
       $id = $request->input('id');
       $bool = Carousel::where('id', $id)->delete();
       if ($bool) {
          return $this->json(1, '删除成功');
       }else{
           return $this->json(-1, '删除失败');
       }
    }

    //点击轮播图状态按钮,更新状态
    public function carouselUpdateStatus(Request $request)
    {
       $id = $request->input('id');
       $status = $request->input('status');

       $status=($status == 0)?1:0;
       //dd( $status );
       $bool = Carousel::where('id', $id)->update(['status' => $status]);

       if ($bool) {
           return $this->json(0, '更新状态成功');
       } else {
           return $this->json(1, '更新状态失败');
       }

    }

    //返回json格式的数据处理结果
    public function json($code, $msg, $data=[])
    {
        return response()->json([
            'status' => $code,
            'msg' => $msg,
            'data' => $data
        ]);
    }



}