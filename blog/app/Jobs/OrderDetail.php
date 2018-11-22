<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Order;
use App\Model\Goods;
use App\Model\Order_goods;

class OrderDetail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $order = DB::table('order')->select('order_id', 'pay_status', 'add_time', 'order_status')->where([ ['pay_status', 0],['order_status', 0] ])->get();
         // dd($order);
        //查询订单半小时内未付款自动取消订单
        foreach ($order as $v) {
            $bool = strtotime($v->add_time) < time()-1800;
            if($bool) {
                $oid[] = $v->order_id;
                DB::table('order')->where('order_id', $v->order_id)->update(['order_status' => 4]);
            }
             
        }
        // dd($oid);
        //判断当前订单id为空
        if(!empty($oid)) {
            $goods = DB::table('order_goods')->select('order_id', 'goods_id', 'goods_num')->whereIn('order_id', $oid)->get();
            // dd($goodsid);
            foreach ($goods as $gk => $gv) {
                $gid[] = $gv->goods_id; 
                $num[] = $gv->goods_num;
                $data = DB::table('goods')->select('id', 'store_count')->where('id', $gv->goods_id)->first();
                $store_count = $data->store_count+$num[$gk];
                // var_dump($store_count);
                $bool = DB::table('goods')->where('id', $gv->goods_id)->update( ['store_count'=>$store_count] );
            }
        }

    }
}
