<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\AddressController;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Order;
use App\Model\Order_goods;
use App\Model\Order_action;
use App\Model\Goods;
use App\Model\Address;
use App\Model\Integral;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Home\IntegralController;
use Carbon\Carbon;
use App\Jobs\OrderDetail;

/**
* 订单处理
* @author chenxiaodong <229168653@qq.com>
* @param $request  Request的对象
*/
class OrderController extends Controller
{

    //立即购买的时候进来处理数据
    public function buyNow(Request $request) 
    {
        if (!empty($_GET['gid']) && !empty($_GET['num'])) {
             $goods= DB::table('goods')->select(['id' , 'price', 'store_count'])->where('id', $_GET['gid'])->first();
             if ($_GET['num'] > $goods->store_count) {
                echo 401;//没货
                return;
             } else {
                $buynowdata = $_GET['num'].','.$_GET['gid'];
                // var_dump($buynowdata);              
                echo json_encode(['status'=>200, 'data'=> $buynowdata]);

             }
             

        }
    }

    //这是购物车页提交过来的数据
    public function cartShop(Request $request)
    {   
        if ($request->session()->has( 'userid' )) {
            //判断用户是否已选择商品
            if (empty($_GET['gids']) && empty($_GET['good_numbers'])) {
                echo 404; //如果没有选择则返回提示给用户
                return;
            }
            // var_dump($_GET);
            // exit;
            //在这里加个判断选择商品
            $gid = rtrim($_GET["gids"], ',');
            // // var_dump($_GET["good_numbers"]);
            // $arrgid = explode(',', $gid);

            $num = rtrim($_GET["good_numbers"], ',');
            // $arrnum = explode(',', $num);
            $data = $gid.'_'.$num;
            // var_dump($num.'_'.$gid);
            echo json_encode(['status'=>200, 'data'=> $data]);
        } else {
            echo 401;
        }
    }


	//显示生成订单页面
    public function accountView(Request $request)
    {
// var_dump($_GET);exit;
    	//加载地址信息
        if ($request->session()->has( 'userid' )) {
            //查询用户信息及收货地址
            $uid = $request->session()->get('userid');
            $addre = DB::table('address')->select(['id', 'uid', 'name', 'address', 'phone', 'code'])->where('uid', $uid)->get();
            //查询用户等级打折
            $userdata = DB::table('users')->select( 'id', 'rank')->where('id', $uid)->first();
            $available_integral = Integral::select('user_id', 'available_integral')->where('user_id', $uid)->first();
            // $integral = $integral->available_integral;
            //判断用户是否第一次购买，处理积分表没有数据
           if (isset($available_integral)) {
                //查询可用积分
                $available = $available_integral->available_integral;
           } else {
                $available = 0;
           }
          
            // dd( $available_integral->available_integral);
            //调用积分控制类 IntegralController 查询出用户可用的积分并返回相应的抵消费用
            $IntegralController = new IntegralController;
            $integral = $IntegralController->integralAvailable($request, $uid);
            // dd($integral);
            // exit;

            // dd($integral->available_integral);
            //判断用户级别打折 1为普通用户  2为vip  3为钻石
            if($userdata->rank==1) {
                $rank = 1;
            } elseif ($userdata->rank==2) {
                $rank = 0.9;
            } else {
                $rank = 0.8;
            }
            // dd($rank);
            //判断下单是从哪里跳转的 if条件若为真，是用户直接在详情页面立即购买进来
            if (isset($_GET['buynowdata'])) {
               $buynowdata =  explode(',',$_GET['buynowdata']);
                // var_dump($buynowdata[1]);exit;
                // $num = $_GET['amp;num'];
                // echo '这是立即购买';
                $goods= DB::table('goods')->select(['id' , 'goods_name', 'price', 'goods_pic'])->where('id', $buynowdata[1])->get();

                return view('Home/account', ['address' => $addre, 'goods' => $goods, 'num' => $buynowdata, 'rank' => $rank, 'integral' =>$integral, 'available' => $available]);

            } else {
                //判断是否传进来数据
                if (isset($_GET['data'])) {
                    // echo '这是从购物车来的';
                    $arr = explode('_',$_GET['data']);
                    //获取商品id
                    $gid = explode(',', $arr[0]);
                    //获取购买数量
                    $num = explode(',', $arr[1]);
                    // dd($num);
                    $goods = DB::table('goods')->select(['id' , 'goods_name', 'price', 'goods_pic'])->whereIn('id', $gid)->get();
                    return view('Home/account', ['address' => $addre, 'goods' => $goods, 'num' => $num, 'rank' => $rank,'integral' =>$integral, 'available' => $available]);

                } else {

                    return view('/Home/login');
                }
            }

        } else {
            return view('Home/login');
        }

    }

    //生成订单插入数据
    public function orderSuccess(Request $request)
    {   	
        DB::beginTransaction();
        // var_dump($_POST);exit;

        // $_POST['integral']
       // echo json_encode(['status'=>200, 'id'=>2]); exit;
        // 判断收货地址是否选择
    	$addressid = $request->input('addressid');
        if($addressid == 'undefined'){
            echo 400;
            return;
            
        }
        // exit;
        // var_dump($addressid);
    	//获取用户备注
    	$order_note = $request->input('order_note');
    	//获取收货地址信息
    	$addressdata = DB::table('address')->select(['id', 'name', 'address', 'code', 'phone'])->where('id', $addressid)->first();
    	//获取当前用户id userid
    	$userid = $request->session()->get('userid');
    	// dd($order_note);
    	
        //获取购买商品id
        $gid = rtrim($_POST['gid'], ',');
        $gid = explode(',', $gid);

        //获取购买数量
        $num = rtrim($_POST['valarr'], ',');
        $num = explode(',', $num);
        // var_dump($gid);
        // var_dump($num);exit;
        //获取商品信息
        $goods= DB::table('goods')->select(['id', 'goods_name', 'price', 'goods_pic', 'store_count', 'sales_num'])->whereIn('id', $gid)->get();
        // $goodsdate = DB::table('goods')->select('id', 'store_count', 'sales_num')->whereIn('id', $gid)->get();
        // dd($goods);
    // exit;
		//插入order表
    	$orderdata = [
    		'order_sn' => date('Ymdhis'),
    		'user_id'  => $userid,
    		'consignee'	=> $addressdata->name,
    		'address' => $addressdata->address,
    		'zipcode' => $addressdata->code,
    		'phone' => $addressdata->phone,
    		'shipping_name' => '顺丰快递',
    		'total_amount' => $_POST['total'],
    		'add_time' => date('Y-m-d H:i:s'),
    		'user_note' => $_POST['order_note'],
            'integral' => $_POST['available'],
            'integral_money' => $_POST['integral'],
            'order_amount' => $_POST['order_amount']
    	];
        // exit;
    	$orderid = DB::table('order')->insertGetId($orderdata);
       

        //插入 order_goods 订单商品信息表
    	foreach ($goods as $k=>$v) {
            //库存减去购买数量
            $store_count = $v->store_count-$num[$k];
            $ordergoodsdata = [
                'order_id' => $orderid,
                'goods_id' => $v->id,
                'goods_name' => $v->goods_name,
                'goods_num' => $num[$k],
                'goods_price' => $v->price,
                'goods_pic' => $v->goods_pic,
            ];

            $bool = DB::table('order_goods')->insert($ordergoodsdata);
            //减去库存          
            DB::table('goods')->select('id', 'store_count')->where('id', $v->id)->update( ['store_count'=>$store_count] );
        }

        //插入订单操作表
        // $bool = DB::table('order_action')->insert(
        //     ['order_id' => $orderid]
        // );

        //检查半个小时订单生效  自动取消订单
        OrderDetail::dispatch($bool)->delay(Carbon::now()->addMinutes(30));
        // OrderDetail::dispatch($bool)->delay(Carbon::now()->addSeconds(60));

        if ($bool) {
             DB::commit();
            echo json_encode(['status'=>200, 'id'=>$orderid]);
        } else {

            DB::rollBack();
        }
    	
    }

    //生成订单后成功提示显示页面
    public function orderSuccessView(Request $request)
    {
        if ($request->session()->has( 'userid' )) {
            $oid = $_GET['oid'];
            return view('Home/order_success', ['oid' => $oid]);
        } else {
            return view('/');
        }
        
    }

    //显示订单详情页面
    public function orderDetailView()
    {
        // var_dump($_GET['oid']);
        if (!empty($_GET['oid'])) {
            $orderData = DB::table('order')->select()->where('order_id', $_GET['oid'])->first();
            $goods = DB::table('order_goods')->select()->where('order_id', $_GET['oid'])->get();
        }

       // dd($goods);
        return view('Home/order_detail', ['orderData' => $orderData, 'goods' => $goods] );
    }

    //订单支付
    public function orderPay(Request $request)
    {
        session_start();
        $IntegralController = new IntegralController;
        $integral = $IntegralController->integralAdd($request,$_POST['oid']);
        // dd($integral);
// exit;
        //查询已经购买的商品id
        if (!empty($_POST['oid'])) {
 
            $goodid = DB::table('order_goods')->select('goods_id','goods_num')->where('order_id', $_POST['oid'])->get();
            $uid = $request->session()->get('userid');
            $order = DB::table('order')
                        ->select('order_id', 'pay_status', 'add_time', 'order_status')
                        ->where([ ['user_id', $uid], ['order_id', $_POST['oid']] ])->first();
            // dd( $order->pay_status);
            if ($order->pay_status == 0 && $order->order_status ==0) {
                // $paytime = $v->add_time;
                //判断是否超过半个小时未付款 则自动取消订单
                $bool = strtotime($order->add_time) < time()-1800;
                if($bool) {
                    // echo '超过半个小时'.$paytime.'<br>';
                    DB::table('order')->where('order_id', $order->order_id)->update(['order_status' => 4]);
                    echo 400;
                    return;
                }
                // dd(2);
                 
                //获取当前用户id
                // $uid = $request->session()->get('userid');
                
                //开启事物处理
                DB::beginTransaction(); 
                //修改订单状态和支付状态
                $bool = DB::table('order')
                            ->where('order_id', $_POST['oid'])
                            ->update(['order_status' => 1, 'pay_status' => 1 ]);

                if ($bool) {        
                    foreach ($goodid as $gk=>$gv) {
                        $gid[] = $gv->goods_id;
                        $num[] = $gv->goods_num;
                        // //循环删除购物车内已存在的商品           
                        // $key = 'cart:data:'.session_id().$uid.':'.$gid;
                        $key = 'cart:data:'.session_id().$uid.':'.$gv->goods_id;
                        $bool = Redis::DEL($key);
                    }
                    // dd($goodid);
                    // dd($_POST['oid']);
                    //查询商品信息
                    $goodsdate = DB::table('goods')->select('id', 'store_count', 'sales_num')->whereIn('id', $gid)->get();
                    //减去库存和添加销量
                    foreach ($goodsdate as $k => $v) {
                        //库存减去购买数量
                        // $store_count = $v->store_count-$num[$k];
                        //销量增加购买数量
                        $sales_num = $v->sales_num+$num[$k];
                        // DB::table('goods')->select('id', 'store_count', 'sales_num')
                        //                   ->where('id', $v->id)
                        //                   ->update( ['store_count'=>$store_count, 'sales_num'=>$sales_num] );

                        $bool = DB::table('goods')->select('id', 'store_count', 'sales_num')
                                          ->where('id', $v->id)
                                          ->update( ['sales_num'=>$sales_num] );
                    }
                    
                    if($bool) {
                        DB::commit();
                        //完成支付执行跳转
                        echo 200;
                    } else {
                        DB::rollBack();
                        echo 401; //下单异常
                    }

                //失败回滚
                } else {
                    DB::rollBack();
                }
            }
        } else {
            echo 444;//下单失败返回错误信息
            return;
        }       

    }


    //确定收货处理
    public function orderReceive()
    {
        // if (!empty($_GET['oid'])) {
        //    var_dump($_GET);
        // }
        // exit;
        // var_dump($_POST['oid']);
        $bool = DB::table('order')
                    ->where('order_id', $_POST['oid'])
                    ->update(['order_status' => 3]);

        if ($bool) {
            echo 200;
        }
    }

    //执行订单取消
    public function orderCancel()
    {
        // var_dump($_POST);
        // 修改订单状态
         $bool = DB::table('order')
                    ->where('order_id', $_POST['oid'])
                    ->update(['order_status' => 4]);

        //库存处理          
        $goodid = DB::table('order_goods')->select('goods_id','goods_num')->where('order_id', $_POST['oid'])->get();
        // dd($goodid);
        foreach ($goodid as $gk=>$gv) {
            $gid[] = $gv->goods_id;
            $num[] = $gv->goods_num;        
        }
        //查询该订单购买商品信息
        $goodsdate = DB::table('goods')->select('id', 'store_count', 'sales_num')->whereIn('id', $gid)->get();

        foreach ($goodsdate as $k => $v) {
            //库存增加购买数量
            $store_count = $v->store_count+$num[$k];
            $bool = DB::table('goods')->select('id', 'store_count', 'sales_num')
                              ->where('id', $v->id)
                              ->update( ['store_count'=>$store_count] );
        }
        // dd($v->store_count);
        // dd($goodsdate);

        if ($bool) {
            echo 200;
        }
    }

    //删除订单
    public function orderDelete()
    {
        // var_dump($_POST);
        DB::table('order_goods')->where('order_id', $_POST['oid'])->delete();
        $bool = DB::table('order')
                    ->where('order_id', $_POST['oid'])
                    ->delete();

        if ($bool) {
            echo 200;
        }

    }

    //支付成功返回页面
    public function orderPaySuccessView(Request $request)
    {
        if ($request->session()->has( 'userid' )) {

            return view('Home/order_pay_success');
        } else {
            return view('/');
        }
        
    }

    //执行退货
    public function orderRetreat()
    {
        // var_dump($_POST);
        $goodid = DB::table('order_goods')->select('goods_id','goods_num')->where('order_id', $_POST['oid'])->get();
        $bool = DB::table('order')
                    ->where('order_id', $_POST['oid'])
                    ->update(['order_status' => 5]);

        //循环查询该订单购买商品id和购买数量
        foreach ($goodid as $gk=>$gv) {
                $gid[] = $gv->goods_id;
                $num[] = $gv->goods_num;
        }
        // dd($num);
        //查询商品信息
        $goodsdate = DB::table('goods')->select('id', 'store_count', 'sales_num')->whereIn('id', $gid)->get();
        // dd($goodsdate);
        //增加库存和减少销量
        foreach ($goodsdate as $k => $v) {
            //库存增加购买数量
            $store_count = $v->store_count+$num[$k];
            //销量减少购买数量
            $sales_num = $v->sales_num-$num[$k];
            $bool =DB::table('goods')->select('id', 'store_count', 'sales_num')
                              ->where('id', $v->id)
                              ->update( ['store_count'=>$store_count, 'sales_num'=>$sales_num] );
        }

        if($bool) {
            //退货执行跳转
            echo 200;
        } 
    

    }

    
}
