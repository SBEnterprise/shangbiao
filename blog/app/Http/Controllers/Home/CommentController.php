<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Comment;
use DB;

class CommentController extends Controller
{
	/**
	 * [index 加载评论界面]
	 * @param  [int] $id [订单ID]
	 * @return [array]     [该订单ID下所有的商品数据]
	 */
	public function index()
	{	
		if (!empty($_GET['oid'])) {
			$id = $_GET['oid'];
			$goods = DB::table('order_goods')->select('goods_name','goods_pic','goods_id','order_id')->where('order_id',$id)->get();
			if(!$goods){
				return back();
			}
			return view('Home/comment',['goods'=>$goods]);
		} 
		
	}

	/**
	 * [create 执行添加评论]
	 * @param  Request $request [description]
	 * @return [string]           [返回添加评论情况]
	 */
	public function create(Request $request)
	{

		//获取用户评论数据
		$logistics = $request->get('logistics');
		$commoditys = $request->get('commoditys');
		$attitudes = $request->get('attitudes');
		$texts = $request->get('texts');
		$goods_pics = $request->get('goods_pics');
		$goods_ids = $request->get('goods_ids');
		$oids = $request->get('oids');

		$data = $logistics.'-'.$commoditys.'-'.$attitudes.'-'.$texts.'-'.$goods_pics.'-'.$goods_ids.'-'.$oids;


		// var_dump($texts,$goods_pics);exit;
		$arr= explode('-',$data);

		//获取物流评价等级
		$logistics = explode(',',$arr[0]);
		//判断物流评价等级是否为空
		$lbool = in_array('',$logistics);

		if( $lbool ) {
			echo json_encode(['status'=>100, 'msg'=>'请选择物流评价等级！']);
       			return;	
		}

		//获取商品评价等级
		$commoditys = explode(',',$arr[1]);
		//判断商品评价等级是否为空
		$cbool = in_array('',$commoditys);
		if($cbool){
				echo json_encode(['status'=>101, 'msg'=>'请选择商品评价等级！']);
       			return;
			}

		//获取商家态度等级评价
		$attitudes = explode(',',$arr[2]);
		//判断商家态度评价等级是否为空
		$abool = in_array('',$attitudes);
		if( $abool ) {
			echo json_encode(['status'=>102, 'msg'=>'请选择商家态度评价等级！']);
   			return;
		}
		//获取评论内容
		$texts = explode(',',$arr[3]);
		//获取评价图片
		$goods_pics = explode(',',$arr[4]);
		//获取商品id
		$goods_ids = explode(',',$arr[5]);
		//获取订单id
		$oids = explode(',',$arr[6]);
		//添加时间
		$add_time = date('Y-m-d H:i:s');
		//获取userid
		$uid = $request->session()->get('userid');
		$commentdatas=[];
		for ($i = 0; $i < count($goods_ids); $i++) { 
			$commentdatas=[
						'add_time' => $add_time,
						'uid' => $uid,
						'goods_id' => $goods_ids[$i],
						'img' => $goods_pics[$i],
						'parent_id' => $goods_ids[$i],
						'order_id' => $oids[$i],
						'deliver_rank' => $logistics[$i],
						'goods_rank' =>$commoditys[$i],
						'service_rank' => $attitudes[$i],
						'content' =>  $texts[$i],
					];

		$bool = DB::table('comment')->insert($commentdatas);

		}
		//插入数据成功后跳转
		if( $bool ){
			DB::table('order')->where('order_id', $oids)->update(['order_status' => 6]);
			echo json_encode(['status'=>202, 'msg'=>'评论成功']);
		}
	}
}


/*在每个商品下显示msg想法
在for长度小于count($goods_ids)里面判断$logistics[i]为空
echo json_encode(['status'=>101, 'msg'=>'请选择商品评价等级！','gid'=>$goods_ids[i]]);
*/
