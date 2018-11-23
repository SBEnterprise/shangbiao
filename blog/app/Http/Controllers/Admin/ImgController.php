<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Goods;
use App\Model\Goods_images;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Common\UploadController;
use App\Http\Controllers\Api\CommonApi;

class ImgController extends Controller
{
	//显示商品图主页
    public function imgView(Request $request)
    {
        //搜索关键字
        $keyword = $request->input('keyword');
    	$img = DB::table('goods_images')->select()->where('goods_id','like','%'.$keyword.'%')->paginate(8);
    	return view('Admin/uploadimg/imgview', ['img' => $img, 'keyword' => $keyword ]);
    }

    //商品图片添加页
    public function imgAddView()
    {
    	$goods = DB::table('goods')->select('id', 'goods_name')->get();
    	// dd($goods);
    	return view('Admin/uploadimg/imgaddview', ['goods' => $goods] );
    }

    //上传图片
    public function uploadImg(Request $request, $filename = 'pic')
    {
    	// var_dump($_POST['show']);exit;
    	if ($_POST['goods_id']==-1) {
    		return back()->with('errorTip', '请选择商品！');
    	}
        if ($_POST['show']== 'on') {
            return back()->with('errorTip', '请选择商品显示位置！');
        }
  
  		// exit;
    	//上传图片
    	// $upload = new UploadController;
     //    $filename = $upload->uploadToQiNiu($request, $fileName);

        $Common = new CommonApi;
        $filename = $Common->uploadToQiNiu($request, $filename);
        // var_dump($filename);

    	if (!empty($filename['goodimages'])) {

            $data = [
	        	'goods_id' => $_POST['goods_id'],
	        	'url' => $filename['goodimages'],
                'type' => $_POST['show']
        	];

        	$bool = DB::table('goods_images')->insert($data);

        	if ($bool) {
        		return redirect('/admin/imgview')->with('msg', '上传成功');
        	}

        } else {
        	 return back()->with('errorTip', '上传失败！');
        }
        
    }

    //删除商品图片
    public function deleteImg()
    {
    	// var_dump($_GET['gid']);exit;
    	$bool = DB::table('goods_images')->where('img_id', $_GET['gid'])->delete();

    	if ($bool) {
        	return redirect('/admin/imgview')->with('msg', '删除成功');
        } else {
        	return back()->with('errorTip', '删除失败！');
        }
    }
}
