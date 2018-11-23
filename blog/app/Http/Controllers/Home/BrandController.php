<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Goods;
use App\Model\Detail;

//品牌大全
class BrandController extends Controller
{
	public function index()
	{
		$brand_name = Brand::select('id','brand_name','brand_id','brand_logo')->get();
		        //热销排行
        $hot_goods = Goods::select('id','brand_name','price','present_price','goods_pic')
                    ->with('detail')
                    ->where('is_hot',1)
                    ->orderBy('is_hot','desc')
                    ->take(5)
                    ->get()
                    ->toArray();
		// dd($brand_name);
		return view('Home/brand',['brand_name'=>$brand_name,'hot_goods'=>$hot_goods]);
		
	}

	public function brandListView(Request $request)
	{
		if ($request->get('brand_id')) {
			$brand_id = $request->get('brand_id');
			return json_encode(['status'=>0,'msg'=>$brand_id]);			
		}

		if ($request->get('gid')) {
			$gid = $request->get('gid');
			return json_encode(['status'=>1,'msg'=>$gid]);					
		}

	}

	public function brandView(Request $request)
	{
		//品牌列表
		$brand_name = Brand::select('id','brand_name','brand_id','brand_logo')->get();
		$brand_id = $request->get('brandid');
		$brand_list = Goods::select('id','brand_id','goods_pic','present_price','sales_num','brand_name','goods_name')
			->where('brand_id',$brand_id)
			->get();
		// dd($brand_list);
		//热销排行
        $hot_goods = Goods::select('id','brand_name','price','present_price','goods_pic','brand_id')
                    ->with('detail')
                    ->where('is_hot',1)
                    ->where('brand_id',$brand_id)
                    ->orderBy('is_hot','desc')
                    ->take(5)
                    ->get()
                    ->toArray();
		// dd($hot_goods);

		return view('Home/brand-detail',['brand_list'=>$brand_list,'hot_goods'=>$hot_goods,'brand_name'=>$brand_name]);
	}
}
