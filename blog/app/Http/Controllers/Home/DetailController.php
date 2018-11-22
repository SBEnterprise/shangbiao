<?php

namespace App\Http\Controllers\Home;

use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Detail;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Session;
use App\Model\Goods_images;
use DB;
use App\Model\Comment;
use App\Model\User;

class DetailController extends Controller
{

    public function detail(Request $request)
    {   
        //接收传递过来的商品ID  
        $gid =intval(@$request->get('gid'));  
        
        // $gid = intval(@$request->get('gid'));
        //判断是否带来了商品ID
        if ($gid <= 0) {
            // dd($gid);
            return Redirect::to('/');
        }
        // 查询商品是否热卖
        $is_hot = Goods::select('is_hot','sales_num')
        ->where('id','=',$gid)
        ->where('is_hot','=',1)
        ->where('sales_num','>',100)
        ->first();

        // dd($hot_sale_goods);
        //如果是热销商品，就从缓存中读取数据
        if (!empty($is_hot)) {
            //是热销商品走这里
            $goods_key = 'goods_id_'.$gid;
            $key = md5($goods_key);

            if (Cache::get($key)) {

                $data= Cache::get($key);
            } else { 
                //查询数据库并存到缓存中 
                $data =  Goods::select('id','goods_remark','goods_pic','goods_name','sales_num','price','is_hot', 'store_count')
                        ->where('id',$gid)->get();
                //缓存时间
                $expire = Carbon::now()->addMinutes(10);
                // 存到缓存中
                $hot_sale_goods = Cache::put($key, json_decode($data),  $expire);             
            }
               
        } else {
            //没达到做缓存条件的走这里
            $data =  Goods::select('id','goods_remark','goods_pic','goods_name','sales_num','price','is_hot', 'store_count')
                        ->where('id',$gid)->get();          
        }

        //热销排行
        $hot_goods = Goods::select('id','brand_name','price','present_price','store_count','goods_pic')
                    ->with('detail')
                    ->where('is_hot',1)
                    ->orderBy('is_hot','desc')
                    ->take(5)
                    ->get()
                    ->toArray();
        //             echo '<pre>';
        // print_r($hot_goods);exit;
        $detail = Detail::select()->where('gid',$gid)->get();
        $mainimg = DB::table('goods_images')->select()->where(['goods_id'=>$gid, 'type'=>0])->get();
        $detailimg = DB::table('goods_images')->select()->where(['goods_id'=>$gid, 'type'=>1])->get();

        //评论
        $comment = Comment::select('comment_id','uid','content','add_time','img','goods_id')
                    ->with('commentContent')
                    ->where('goods_id',$gid)
                    ->get()
                    ->toArray();
        //用户评论总条数
        $comment_sum = Comment::select('comment_id','goods_id')
                    ->where('goods_id',$gid)
                    ->count();
        // dd($comment);
        return view('Home/detail',['data'=>$data,
                                    'detail'=>$detail,
                                    'gid'=>$gid, 
                                    'hot_goods'=>$hot_goods, 
                                    'mainimg' => $mainimg, 
                                    'detailimg'=> $detailimg, 
                                    'comment_content'=>$comment, 
                                    'comment_sum'=>$comment_sum,
                                    ]);
    }

}
