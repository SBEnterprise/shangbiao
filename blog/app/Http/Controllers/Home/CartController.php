<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use DB;

class CartController extends Controller
{

	//每次进来都开启ssession
	public function __construct()
	{
		session_start();
		// $this->idkey  = 'cart:data:'.session_id();
		// $this->gidkey ='cart:data:'.session_id().':'.$gid;
	}


	/**
	 * [处理详情页提交过来的数据]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function cartHandle(Request $request)
	{	
		// echo 11;exit;
		// var_dump($_GET);exit;

		$buyNum = intval($request->get('num'));

		$gid = $request->get('id');
		$value = $request->session()->get('userid');
		
		if ($value) {

			setcookie(session_name(), session_id(), time() +100000*3600, '/');

		} else {
			setcookie(session_name(), session_id(), time()+7*24*3600, '/');
		}

		$gid = intval($gid);

		if ( $gid <= 0 ) {

			return redirect('/');
			exit;
		}



		//1.根据商品ID查询数据库，得到商品数据(商品名字、价格)
		
		$goodData = DB::table('goods')
			->where('id',$gid)
			->first();

	

		if( empty($goodData) ) {

			return redirect('/');

		}

		$goodarrayData = [
			"id"	=> $goodData->id,
			"pid"	=> $goodData->p_id,
			"brand_id"	=> $goodData->brand_id,
			"goods_name" => $goodData->goods_name,
			"store_count" => $goodData->store_count,
			"price"	=> $goodData->price,
			"goods_remark" => $goodData->goods_remark,
			"goods_pic" => $goodData->goods_pic,
			"status" => $goodData->status,	
		];
		 // dd($goodarrayData);
		if ($request->session()->has( 'userid' )) {

			$uid = $request->session()->get('userid');

			$key = 'cart:data:'.session_id().$uid.':'.$gid;
		} else {

			$key = 'cart:data:'.session_id().':'.$gid;
		}
		

		//先查询redis中有没有对应商品
		$bool = Redis::EXISTS($key);

		if (!$bool) {

			$goodarrayData['buyNum'] = $buyNum;

			Redis::hMSet($key,$goodarrayData);

			//根据这个查商品id
			$setKey = 'cart:data:ids:'.session_id();

			//讲商品ID存放到集合中,原因：方便后面查出购物商品数据
			Redis::sAdd($setKey,$gid);

		} else {
			//有对应的商品数据， 只要给对应的商品数据的数量增加
			Redis::hIncrBy($key,'buyNum',$buyNum);
		}
		//加入购物车成功
		echo 1;
	}

/*	public function cartnumchange(Request $request)
	{	

		$buyNum = intval($request->get('num'));

		$gid = $request->get('id');

	
		$key = 'cart:data:'.session_id().':'.$gid;

		$getidkey = 'cart:data:ids:'.session_id();


		//有对应的商品数据， 只要给对应的商品数据的数量增加
		Redis::hIncrBy($key,'buyNum',$buyNum);
		if (Redis::Get($key,'buyNum')<1) {
			Redis::hIncrBy($key,'buyNum',1);
		}

		$getidkey = 'cart:data:ids:'.session_id();

		$idsArr = Redis::sMembers($getidkey);

		foreach ( $idsArr as $id ) 
		{

			$hashKey = 'cart:data:'.session_id().':'.$id;

			$cartDatas[] = Redis::hGetAll($hashKey);
			
		}
		$arr = array_filter($cartDatas);
		// dd($arr);
		//商品总价
		$sum = 0;
		foreach ($arr as $v) 
		{
			
			$sum += $v["price"]*$v["buyNum"];
		}
		echo $sum;
	}

*/	
	/**
	 * LGB['处理完数据加载购物车']
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function cart(Request $request)
	{
		if ($request->session()->has( 'userid' )) {
			$uservalue = $request->session()->get('userid');
		} else {
			$uservalue = '';
		}

		$getidkey = 'cart:data:ids:'.session_id();

		$bool = Redis::EXISTS($getidkey);
		// var_dump($bool);exit;
		if (!$bool) 
		{
			$arr =  [];
			$sum = '';
			Redis::flushall();
			// var_dump(1111111);
			// return view('Home/cartgoodnull'	);//cart模板判断。有$cartDatas[]显示遍历，没有就显示没有商品在购物车
			return view('Home/cart',[
				'cartDatas'=>$arr,
				'sum' => $sum,
				'value'=>$uservalue,

			]);
		}

		//取出所有商品ID
		$idsArr = Redis::sMembers($getidkey);
		if ($request->session()->has( 'userid' )) {
			foreach ( $idsArr as $id ) 
			{
				$uid = $request->session()->get('userid');
				$hashKey = 'cart:data:'.session_id().$uid.':'.$id;
				// $hashKey = 'cart:data:'.session_id().':'.$id;

				$cartDatas[] = Redis::hGetAll($hashKey);
				
			}
		} else {
			foreach ( $idsArr as $id ) 
			{

				$hashKey = 'cart:data:'.session_id().':'.$id;

				$cartDatas[] = Redis::hGetAll($hashKey);
				
			}
		}

		$arr = array_filter($cartDatas);

		// dd($arr);exit;
		// dd($arr);
		//商品总价
		$sum = 0;
		foreach ($arr as $v) 
		{
			
			$sum += $v["price"]*$v["buyNum"];
		}
		
		return view('Home/cart',[
			'cartDatas'=>$arr,
			'sum' => $sum,
			'value'=>$uservalue,

		]);
		
	}

	/**
	 * [删除商品的方法]
	 * @author [liguobin] <[287727881@qq.com]>
	 * @param  [int] $gid [商品ID]
	 * @return [type]      [description]
	 */
	public function goodDelete(Request $request,$gid)
	{
		//判断是否登录
		if ($request->session()->has( 'userid' )) {
			$uid = $request->session()->get('userid');
			$key = 'cart:data:'.session_id().$uid.':'.$gid;

		// $idkey = 'cart:data:'.session_id();
		
		} else {
			$key = 'cart:data:'.session_id().':'.$gid;
		}
		$bool = Redis::DEL($key);

		return redirect('home/cart');
		
	}


	public function checkBuyNum(Request $request)
	{
		// var_dump($_GET);
		$goods = DB::table('goods')->select('id', 'store_count')->where('id', $_GET['gid'])->first();
		// dd($goods);
		echo $goods->store_count;
		// echo json_encode(['status'=>200, 'data'=> $goods->store_count]);

	}

}
