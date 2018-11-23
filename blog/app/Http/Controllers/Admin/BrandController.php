<?php

namespace App\Http\Controllers\Admin;

use DB;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Http\Controllers\Common\UploadController;
use App\Http\Controllers\Api\CommonApi;


/**
* 品牌表上传图片操作
*   lizhentao qq1214685942@gmail.com
* @return 将数据返回后台品牌首页
*/
class BrandController extends Controller
{
    
    //显示添加页面
    public function addBrandView()
    {
        
        return view('Admin/product-brand-add');
        
    }

    //添加品牌方法，将图片上传七牛云
    public function addBrand(Request $request, $fileName = 'pic')
    {

        //调用文件上传方法，拿到图片地址
        // $upload = new UploadController;
        // $img = $upload->uploadToQiNiu($request, $fileName);

        // $goods_pic = $res['goodimages'];
        // dd($img['goodimages']);
        if (!empty($img)) {
            $Common = new CommonApi;
            $img = $Common->uploadToQiNiu($request, $fileName);
        }else{
             // return back()->with('errorTip', '请填写完整的品牌信息');
              return redirect('admin/product-brand-add')->with('msg', '请填写完整的品牌信息');
        }
        $bool = Brand::insert([ 
            'p_id' => $_POST['pid'],
            'brand_id' =>$_POST['brand_id'],
            'brand_name' =>$_POST['brand_name'],
            'brand_logo' =>$img['goodimages'],
            'brand_desc' =>$_POST['brand_desc'],
            'site_url' =>$_POST['site_url'],
            ]);
        //判断bool值并返回信息  
        if ($bool>0) {
       
             return redirect('admin/product-brand')->with(['status'=>0,'msg'=>'添加成功']);
           
        }else{
            
            return redirect()->back(['status'=>0,'msg'=>'添加失败']);     
        }  
        // return view('Admin/product-brand'); 
        
    }

    //展示品牌数据
    public function showBrand(Request $request)
    {
        //搜索关键字的变量值
        $keyword = $request->input('keyword');

        //查询品牌表数据
        $brandlist = Brand::select('id','brand_id','brand_name','brand_logo','brand_desc','site_url','p_id')->where('brand_name','like','%'.$keyword.'%')->paginate(5);

        return view('Admin/product-brand', ['brand' => $brandlist, 'keyword' => $keyword]);

    }

    /**
    * 显示品牌修改页面
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function showBrandList($id)
    {
        
        //根据$id查询对应商品数据，并且放到页面
        $brandeditdata = Brand::select('id','brand_id','brand_name','brand_logo','brand_desc','site_url','p_id')->where('id', $id)->first();
        // var_dump($brandeditdata->id);exit;

        // dd($oneProduct);
        return view('Admin/product-brand-edit', ['brandeditdata' => $brandeditdata]);
    }

    /**
     * 负责品牌数据库修改,update
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $fileName 传的是上传文件的name值 需调用Common里面的文件上传方法
     * @return \Illuminate\Http\Response
     */
    public function updateBrand(Request $request, $fileName = 'pic')
    {   
        //调用文件上传方法，拿到图片地址
        // $upload = new UploadController;
        // $imglink = $upload->uploadToQiNiu($request, $fileName);
        $Common = new CommonApi;
        $img = $Common->uploadToQiNiu($request, $fileName);
  
        //判断修改页面提交过来的文件上传是否为空
        if (!empty($img['goodimages'])) {

            $img = $img['goodimages'];
            // dd($img);


            $data = [
                'brand_id' => $_POST['brand_id'],
                'brand_name' => $_POST['brand_name'],
                'brand_logo' => $img,
                'brand_desc' => $_POST['brand_desc'],
                'site_url' => $_POST['site_url'],
                'p_id' => $_POST['pid'],
            ];
        } else {
            $data = [
                'brand_id' => $_POST['brand_id'],
                'brand_name' => $_POST['brand_name'],
                'brand_desc' => $_POST['brand_desc'],
                'site_url' => $_POST['site_url'],
                'p_id' => $_POST['pid'],
            ];
        }
        // var_dump($id);
        // var_dump($imglink);
        
       

        $bool = DB::table('brand')
            ->where('id', $_POST['id'])
            ->update($data);

        //判断bool值并返回信息
        if ($bool>0) {
       
             return redirect('admin/product-brand')->with(['status'=>0,'msg'=>'修改成功']);
           
        }else{
            
            return redirect()->back(['status'=>0,'msg'=>'修改失败']);

            
        }


    }


    //删除品牌表数据
    public function deleteBrand($id)
    {
               
        $bool = DB::table('brand')->where('id', $id)->delete();
        //判断bool值并返回信息     
       if ($bool>0) {
       
             return redirect('admin/product-brand')->with(['status'=>0,'msg'=>'删除成功']);
           
        }else{
            
            return redirect()->back(['status'=>0,'msg'=>'删除失败']);
            
        }
        
    }


    /**
     * @author yaoqi <383495167@qq.com>
     * @description 根据分类表的id查询品牌表里面的品牌id和品牌名
     */
    public function action($id) {
        $data = Brand::select(['brand_id', 'brand_name'])
                ->where('p_id', $id)
                ->get();
        echo  json_encode(['data'=>$data]);
    }


    
}
