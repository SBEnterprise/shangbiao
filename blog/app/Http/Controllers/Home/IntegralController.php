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
use App\Model\Integralrule;

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
      
        $integralcenter = Integral::select('available_integral')->where('user_id', $uid)->get()->toArray();
      if ($integralcenter){
        $res = $integralcenter[0]['available_integral'];
        // dd($res);
        } else {
            $res = 0;
        }
            
            //查询用户积分数据
        $userintegral = Integral::select('id','user_id','add_time','pay_integral','available_integral','integral_time','order_sn')->where('user_id', $uid)->get();
            // dd($userintegral);
            return view('Home/integral', ['res' => $res, 'userintegral' => $userintegral] );
        // } else {
        //     // $integralcenter = '';
        //     $userintegral = '';
        //     return view('Home/integral', ['res' => $res, 'userintegral' => $userintegral] );
        // }
        
        
    }
    
    //显示积分细则页面
    public function integralRuleView()
    {
        
        $integraldata = Integralrule::select('id','obtain','object','integralexplain','integralconvert','privilege','cash')->get();
        $integral = Integralrule::select('id','integralconvert','privilege','cash')->first();
        // $integraldata = Integralrule::select('id','obtain','object','integralexplain','integralconvert','privilege','cash')->first();
        // $integraldata = Integralrule::select('id','obtain','object','integralexplain','integralconvert','privilege','cash')->first();

        return view('Home/integral-rule', ['indexruledata' => $integraldata, 'integral' => $integral] );
        
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
        $discount = 0.8;//Vip用户折扣查询
        $discounts = 0.6;//钻石用户折扣
        // $state = [1=>"普通用户",2=>"VIP",3=>"钻石"];

        $userrole = User::select(['id','rank'])->where('id', $uid)->first();

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

        if (isset($availableintegral->user_id)) {
            // echo 22;
       // exit;
            // dd($availableintegral->user_id);
            // dd($availableintegral->available_integral);
            // var_dump($availableintegral);
            // 查到对应用户的执行积分抵扣 不小于100积分才可以抵消
            // if ($availableintegral->user_id)
            if ($availableintegral->available_integral >= 100) {
                $integraltotal = round($availableintegral->available_integral/$int, 2);
            } else {
                $integraltotal = 0;
            }   
            // dd($integraltotal);
            
        } else {

            $integraltotal = 0;

        }

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
        //根据session查询登录用户获取用户ID
        $uid = $request->session()->get('userid');
        //根据订单id查询数据
        $order = DB::table('order')->select('order_id', 'total_amount', 'order_sn', 'integral', 'integral_money', 'order_amount')->where('order_id', $oid)->first();
        $addprice = $order->order_amount;
        
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

          case $addprice>=100000 && $addprice<=500000:
           $addprice = $addprice*6;
            break;    

          default:
            $addprice = $addprice;
               
       }

       // dd($addprice);
       // 根据用户ID查询当前的可用积分和消耗积分，分别写入数据库
       $Integraldate = Integral::select('id', 'user_id', 'available_integral', 'pay_integral')->where('user_id', $uid)->first();
       if (isset($availableintegral->user_id)) {
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
        } else {

           $data = [
                'user_id' => $uid,      
                'order_sn' => $order->order_sn,
                'integral_time' => time()+6*30*24*3600,
                'add_time' => date('Y-m-d H:i:s'),
                'available_integral' => $addprice,
                'pay_integral' => $order->integral,
           ];

           $bool = DB::table('integral')->insert($data);
        }


    }
    
    //查看用户积分详情
    public function integralSee()
    {
        //根据用户Id查询积分订单ID
        $uid = Session::get('userid');
        $res = Integral::select('id','user_id','order_sn','available_integral')->where('user_id', $uid)->first(); 
        // 根据积分表订单ID查询订单详情
        $seeintegral = $res->order_sn;
        $orderData = DB::table('order')->select()->where('order_sn', $seeintegral)->get();
        $goodsData = DB::table('order')->select()->where('order_sn', $seeintegral)->first();
        //根据订单id查询查询订单详情表订单
        // dd($goodsData); 
        $goodsres = $goodsData->order_id;
        $goods = DB::table('order_goods')->select()->where('order_id',$goodsres)->get();
         
        
        return view('Home/integral-see', ['goods' => $goods, 'goodsData' => $orderData, 'integral' => $res]);

    }


}
