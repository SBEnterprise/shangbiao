<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Collect;
use App\Model\Goods;
use Illuminate\Support\Facades\DB;
use Session;

class CollectController extends Controller
{
	public function collect()
	{
		//查询用户已收藏的商品
		$user_id = Session::get('userid');//用户id
        $collection_goods = Collect::select('goods_id','add_time','user_id')
                    ->with('collectGoods')
                    ->where('user_id',$user_id)
                    ->orderBy('add_time','desc')
                    ->get()
                    ->toArray();
        // dd($collection_goods);
        $collect_sum = Collect::select('id','user_id')
        			->where('user_id',$user_id)
                    ->count();
        // dd($collect_sum);
	    return view('Home/collect',['collection_goods'=>$collection_goods,'collect_sum'=>$collect_sum]);
	}

	//添加收藏
	public function addCollect(Request $request)
	{
        // 判断用户是否已登录
        if (empty(Session::get('userid'))) {
            return json_encode(['status'=>0,'msg'=>'请登录']);
        } 

	    $return_msg = ['error'=>1, 'msg'=>''];
	    $user_id  = Session::get('userid'); //用户ID
	    $goods_id = intval(@$request->post('gid')); //商品ID
	    // dd($goods_id);
	    $time = time();
	    
	    //判断是否已经存在收藏
	    $is_exists = Collect::where('user_id',$user_id)
	    			->where('goods_id',$goods_id)
	    			->count();
	    // dd($is_exists);
	    if(empty($is_exists)) {
	        //不存在时, 往数据库表collect插入新数据
	        DB::beginTransaction(); //开启事务
	        $res = DB::table('goods_collect')->insert([
	            'user_id'  => $user_id,
	            'goods_id' => $goods_id,
	            'add_time' => $time
	        ]);
	        if($res) {
	            DB::commit(); //事务提交
	            $return_msg['error'] = 0;
	            $return_msg['msg'] = '收藏成功';
	            return $return_msg;
	        } else {
	            DB::rollBack(); //事务回滚
	            $return_msg['msg'] = '收藏失败';
	            return $return_msg;
	        }
	    } else {
	        //存在时, 提示已经收藏
		    $res = Collect::where('goods_id',$goods_id)->where('user_id',$user_id)->delete();
		    if ($res){
		    	$return_msg['msg'] = '取消收藏'; 
		    } else {
		    	$return_msg['msg'] = '取消收藏失败'; 
		    }    
	        return $return_msg;
	    }

	}

	//删除收藏的商品
	public function delCollect(Request $request)
	{
	    $user_id = Session::get('userid'); //用户ID
	    $goods_id  = $request->get('goods_id'); //商品ID
	    // var_dump($goods_id);exit;
	    $res = Collect::where('goods_id',$goods_id)->where('user_id',$user_id)->delete();
	    if ($res){
	    	return json_encode(['status'=>0,'msg'=>'删除成功']);
	    } else {
	    	return json_encode(['status'=>1,'msg'=>'删除失败']);
	    }
	}
}
