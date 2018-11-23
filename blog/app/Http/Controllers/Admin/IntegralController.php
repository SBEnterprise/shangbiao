<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Integral;
use App\Model\Integralrule;
use App\Model\User;
use DB;


/**
* 积分表操作
*   lizhentao qq1214685942@gmail.com
* @return 将数据返回后台积分管理
*/
class IntegralController extends Controller
{
   

   //展示积分数据
    public function showIntegral(Request $request)
    {
         //搜索关键字的变量值
        $keyword = $request->input('keyword');
        // $logkeyword = $request->input('logkeyword');
        //查询品牌表数据
        $integrallist = Integral::select('id','user_id','order_sn','integral_time','add_time','available_integral','pay_integral')->where('user_id','like','%'.$keyword.'%')->paginate(5);

        return view('Admin/integral', ['integral' => $integrallist, 'keyword' => $keyword]);

    }
    //显示编辑用户积分页面
    public function showIntegralList($id)
    {
        
        //根据$id查询对应商品数据，并且放到页面
        $integraleditdata = Integral::select('id','user_id','order_sn','integral_time','add_time','available_integral','pay_integral')->where('id', $id)->first();
        // var_dump($integraleditdata);exit;

        // dd($oneProduct);
        return view('Admin/integral-edit', ['integraleditdata' => $integraleditdata]);
    }

    //修改用户积分数据方法
    public function updateIntegral()
    {   
     	
     	$data = [
                'user_id' => $_POST['user_id'],
                'order_sn' => $_POST['order_sn'],
                'integral_time' => $_POST['integral_time'],
                'add_time' => $_POST['add_time'],
                'user_id' => $_POST['user_id'],
                'available_integral' => $_POST['available_integral'],
                'pay_integral' => $_POST['pay_integral'],
            ];

        $bool = DB::table('integral')
            ->where('id', $_POST['id'])
            ->update($data);

        //判断bool值并返回信息
        if ($bool>0) {
       
             return redirect('admin/integral')->with(['status'=>0,'msg'=>'修改成功']);
           
        }else{
            
            return redirect()->back(['status'=>0,'msg'=>'修改失败']);     
        }

    }

    //删除用户积分表数据
    public function deleteIntegral($id)
    {
               
        $bool = DB::table('integral')->where('id', $id)->delete();
        //判断bool值并返回信息     
       if ($bool>0) {
       
             return redirect('admin/integral')->with(['status'=>0,'msg'=>'删除成功']);
           
        }else{
            
            return redirect()->back(['status'=>0,'msg'=>'删除失败']);
            
        }
        
    }



    /**
    * 积分细则操作
    *   lizhentao qq1214685942@gmail.com
    * @return 将数据返回后台积分管理
    */
    public function integralRulesView()
    {
      
      $integralres = DB::table('integralrule')->select('id','obtain','object','integralexplain','integralconvert','privilege','cash')->paginate(6);
      // $integralcount = DB::table('integralrule')->select('id')->count();
      // dd($integralcount);
      return view('Admin/integral-rules', ['integralres' => $integralres] );    
        
        
    }
   
     public function addIntegral(Request $request)
    {
      
      // dd($_POST);
      //获取ajax提交过来的数据
      $obtain = $request->input('obtain');
      $object = $request->input('object');
      $integralexplain = $request->input('integralexplain');
      $integralconvert = $request->input('integralconvert');
      $privilege = $request->input('privilege');
      $cash = $request->input('cash');
      // dd($obtain);
      
      //插入数据库
      $datalist = [
                'obtain' => $obtain,
                'object' => $object,
                'integralexplain' => $integralexplain,
                'integralconvert' => $integralconvert,
                'privilege' => $privilege,
                'cash' => $cash,
            ];
      $bool = Integralrule::insert($datalist);
        //判断bool值并返回信息
        if ($bool>0) {
        
        return json_encode(['status'=>1,'msg'=>'添加成功']);
           
        }else{
        
            return json_encode(['status'=>0,'msg'=>'添加失败']);
        }
    }

    /**
    * 显示积分规则修改页面
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function integralEdit($id)
    {
        //根据$id查询对应商品数据，并且放到页面
        $oneIntegral = DB::table('integralrule')->select([ 'id','obtain','object','integralexplain','integralconvert','privilege','cash'])->where('id', $id)->first();

        // dd($oneIntegral);
        return view('Admin/integral-rules-edit', ['oneIntegral' => $oneIntegral]);
    }

    /**
     * 负责做修改,update
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $fdid ajax传过来的id
     * @return \Illuminate\Http\Response
     */
    public function integralUpdate(Request $request)
    {   
     


      // dd($_POST);exit;
      // 获取ajax提交过来的数据
      $obtain = $request->input('obtain');
      $object = $request->input('object');
      $integralexplain = $request->input('integralexplain');
      $integralconvert = $request->input('integralconvert');
      $privilege = $request->input('privilege');
      $cash = $request->input('cash');
      $idedit = $request->input('idedit');

        
      // dd($_POST);exit;
      $datalist = [
                'obtain' => $obtain,
                'object' => $object,
                'integralexplain' => $integralexplain,
                'integralconvert' => $integralconvert,
                'privilege' => $privilege,
                'cash' => $cash,
            ];

        $bool = DB::table('integralrule')
        ->where('id',$idedit)
        ->update( $datalist );
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
    public function ruleDelete(Request $request)
    {
        $id = (int)$request->get('id');
        // var_dump($id);
        $bool = DB::table('integralrule')->where('id', $id)->delete();
        //判断bool值并返回信息
        if ($bool>0) {
        
        return json_encode(['status'=>0,'msg'=>'删除成功']);
           
        }else{
        
            return json_encode(['status'=>1,'msg'=>'删除失败']);
        }
    }


     //显示添加页
    public function rulesView()
    {
        
        return view('Admin/integral-rules-add');    
           
    }

     //显示修改页
    // public function integralEditView()
    // {
        
    //     return view('Admin/integral-rules-edit');    
           
    // }



}
