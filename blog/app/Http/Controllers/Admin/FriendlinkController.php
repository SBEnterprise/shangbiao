<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Friendlink;
use Illuminate\Support\Facades\Cache;


//处理友情链接添加
/**
* @author lizhentao <qq1214685942@gmail.com>
* @param 暂定
* @return 返回到后台处理页面
*/

class FriendlinkController extends Controller
{
    
    public function addFriendlink(Request $request)
    {
        //获取ajax提交过来的数据
    	$wname = $request->input('wname');
      	$waddress = $request->input('waddress');
      	$friendnumber = $request->input('friendnumber');
      	// $friendlinkid = 
		// var_dump($_POST);
		
		//检查友情链接是否存在
		//DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
        $bool = Friendlink::insert([ 
        	'friendlink_id' =>$friendnumber,
        	'friendlink_name' =>$wname,
        	'friendlink_url' => $waddress,
        	]);
        //判断bool值并返回信息
        if ($bool>0) {
        
        return json_encode(['status'=>1,'msg'=>'添加成功']);
           
        }else{
        
            return json_encode(['status'=>0,'msg'=>'添加失败']);
        }
    }

    /**
    * 显示遍历出来的友情链接列表面
    *
    * @return \Illuminate\Http\Response
    */
    public function showFriendlink()
    {

    	$friend = DB::table('friendlink')->select('id','friendlink_id','friendlink_name','friendlink_url')->paginate(6);
		// echo "<pre>";
		// print_r($friend);
    	return view('Admin/article-list', ['friend' => $friend]);
    	
    }

    /**
    * 显示修改页面
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //根据$id查询对应商品数据，并且放到页面
        $oneFriend = DB::table('friendlink')->select([ 'id','friendlink_id','friendlink_name','friendlink_url'])->where('id', $id)->first();

        // dd($oneProduct);
        return view('Admin/friend-add', ['friend' => $oneFriend]);
    }

    /**
     * 负责做修改,update
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $fdid ajax传过来的id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        // echo 123;
        // 获取ajax提交过来的数据
    	$friendlinkid = $request->input('fid');
        $friendlinkname = $request->input('fname');
        $friendlinkurl = $request->input('furl');
        $friendlinkdid = $request->input('fdid');
        
        // var_dump($_GET['fdid']);exit;

        $bool = DB::table('friendlink')
        ->where('id', $friendlinkdid)
        ->update([
          'friendlink_id' => $friendlinkid,
          'friendlink_name' => $friendlinkname,
          'friendlink_url' => $friendlinkurl
        ]);
        //判断bool值并返回信息
        if ($bool>0) {
        
        return json_encode(['status'=>1,'msg'=>'修改成功']);
           
        }else{
        
            return json_encode(['status'=>0,'msg'=>'修改失败']);
        }

        // return back()->with('errorTip', '修改失败');

    }

    /**
     * 负责删除友链的表数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request)
    {
        $id = (int)$request->get('id');
        // var_dump($id);
        $bool = DB::table('friendlink')->where('id', $id)->delete();
        //判断bool值并返回信息
        if ($bool>0) {
        
        return json_encode(['status'=>0,'msg'=>'删除成功']);
           
        }else{
        
            return json_encode(['status'=>1,'msg'=>'删除失败']);
        }
    }

}
