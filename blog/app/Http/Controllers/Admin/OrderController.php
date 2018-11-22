<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Order;
use App\Model\Order_goods;
use App\Model\Order_action;
use App\Model\Goods;

/**
* 后台订单管理
* @author chenxiaodong <229168653@qq.com>
* @param $request  Request的对象
*/
class OrderController extends Controller
{
    public function index()
    {

    	$order = DB::table('order')->orderBy('order_id', 'desc')->select()->paginate(4);
    	return view('Admin/order/index', ['order' => $order] );
    }

    //显示订单详情
    public function detailView()
    {
    	// var_dump($_GET['oid']);
    	$goods = DB::table('order_goods')->orderBy('order_id', 'desc')->select()->where('order_id', $_GET['oid'])->get();
    	$orderData = DB::table('order')->select()->where('order_id', $_GET['oid'])->first();
    	return view('Admin/order/order_detail', ['goods' => $goods, 'order' => $orderData]);
    }

    //订单发货
    public function orderShipping()
    {
        // var_dump($_POST['oid']);
        $bool = DB::table('order')
                    ->where('order_id', $_POST['oid'])
                    ->update(['order_status' => 2]);

        if ($bool) {
            echo 200;
        }
    }


   public function orderEditView()
   {
        $goods = DB::table('order_goods')->orderBy('order_id', 'desc')->select()->where('order_id', $_GET['oid'])->get();
        $orderData = DB::table('order')->select()->where('order_id', $_GET['oid'])->first();
        return view('Admin/order/order_edit', ['goods' => $goods, 'order' => $orderData]);
   }

   //执行修改订单信息
   public function orderUpdate()
   {
        // var_dump($_POST);
        $data = [
            'consignee' => $_POST['consignee'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'shipping_name' => $_POST['shipping_name'],
            'integral_money' => $_POST['integral_money'],
            'total_amount' => $_POST['total_amount']
        ];

        // var_dump($data);exit;

        $bool = DB::table('order')->where('order_id', $_POST['oid'])->update($data);
        if ($bool) {
            echo 200;
        }
   }

}
