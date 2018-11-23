<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Integral;
use App\Model\User;
use App\Model\Goods;
use DB;
use Session;
use App\Model\order_goods;
use App\Model\order;

//前台积分控制类
class IntegralController extends Controller
{
    
    //显示用户我的积分页面
    public function integralView()
    {   
        //判断当前登录用户
        $uid = Session::get('userid');
        // dd($uid);
        //查询表数据
        $integralcenter = Integral::select('id','user_id','available_integral')->where('user_id', $uid)->first();
        $res = json_decode( $integralcenter);
        // dd($res->available_integral);
        //查询用户积分数据
        $userintegral = Integral::select('id','user_id','add_time','pay_integral','available_integral','integral_time')->where('user_id', $uid)->get();
        // dd($userintegral);
        return view('Home/integral', ['res' => $res, 'userintegral' => $userintegral]);
        
    }
    
    //显示积分细则页面
    public function integralRuleView()
    {
        
        return view('Home/integral-rule');
        
    }

    /**
    * 处理用户折扣方法
    * @author lizhentao qq1214685942@gmail.com
    * @param $total  商品总额 $uid 用户ID
    * @return total  返回的数据是用户折扣完价格  
    */
    public function integralRule($total, $uid)
    {

        $goodprice = '500';
        $uid = 3;
        $discount = 0.95;//Vip用户折扣查询
        $discounts = 0.9;//钻石用户折扣
        // $state = [1=>"普通用户",2=>"VIP",3=>"钻石"];

        $userrole = User::select(['id','rank'])->where('id', $uid)->first();

        // $goods = DB::table('goods')->select('id', 'goods_name', 'price')->whereIn('id', $gid)->get();
        // dd($userrole->rank);
        // dd($goods);
        
        // foreach ($goods as $key => $value) {
        //     $price = $value->price;
        // }

        if ( $userrole->rank == 1 ) {
            
            // echo '点击成为会员，享受折扣';
            return  $total;
        }

        if ( $userrole->rank == 2 ) {
            
            $total = $goodprice*$discount;
            return  $total;
        }
        if ( $userrole->rank == 3 ) {

            $total = $goodprice*$discounts;
            return  $total;
        }

        // return view('Home/integral');

    }

    
    /**
    * 处理用户用积分抵扣方法
    * @author lizhentao qq1214685942@gmail.com
    * @param  $uid 商品ID
    * @return total  返回的数据是用户抵消完价格  
    */
    public function integralAvailable(Request $request, $uid)
    {
        // $uid = 1;
        $int = 500;//500积分抵扣一元
        $availableintegral = Integral::select('user_id', 'available_integral')->where('user_id', $uid)->first();
        // dd($availableintegral->available_integral);
        // var_dump($availableintegral);
        // 查到对应用户的执行积分抵扣 不小于100积分才可以抵消
        if ($availableintegral->available_integral >= 100) {
            $integraltotal = round($availableintegral->available_integral/$int, 2);
        } else {
            $integraltotal = 0;
        }   
        // dd($integraltotal);
        return $integraltotal;

    }



     /**
    * 处理用户获取积分方法
    * @author lizhentao qq1214685942@gmail.com
    * @param  $gid 商品ID
    * @return 
    */
    public function integralAdd(Request $request, $oid)
    {
        // $integraladdprice = 500;
        // $gid = [25,26];
        // $goodid = DB::table('order_goods')->select('goods_id','goods_num')->where('order_id', $oid)->get();
        $uid = $request->session()->get('userid');
        $order = DB::table('order')->select('order_id', 'total_amount', 'order_sn', 'integral', 'integral_money')->where('order_id', $oid)->first();
        $addprice = $order->total_amount;
        
        // dd($order->total_amount);    
        //判断商品是否符合积分获取规则
        switch ( $addprice ) {
        
          case $addprice>=0 && $addprice<=1000:
           $addprice = $addprice*1;
            break;

          case $addprice>=1000 && $addprice<=5000:
           $addprice = $addprice*2;
            break;

          case $addprice>=5000 && $addprice<=10000:
           $addprice = $addprice*3;
            break;

          case $addprice>=10000 && $addprice<=50000:
           $addprice = $addprice*4;
            break;

          case $addprice>=50000 && $addprice<=100000:
           $addprice = $addprice*5;
            break;  

          default:
            $addprice = $addprice;
               
       }

       // dd($addprice);
       $Integraldate = Integral::select('id', 'user_id', 'available_integral', 'pay_integral')->where('user_id', $uid)->first();
       // dd($Integraldate->available_integral);
       $data = [
            'user_id' => $uid,      
            'order_sn' => $order->order_sn,
            'integral_time' => time()+6*30*24*3600,
            'add_time' => date('Y-m-d H:i:s'),
            'available_integral' => $addprice+$Integraldate->available_integral,
            'pay_integral' => $order->integral,
       ];

       // $bool = Integral::where('user_id', $uid)->update($data);
       $bool = DB::table('integral')->where('user_id', $uid)->update($data);
       // if ($bool ){
       //  echo 1;
       // } else{
       //  echo 2;
       // }
    // dd($data);

    }
}
