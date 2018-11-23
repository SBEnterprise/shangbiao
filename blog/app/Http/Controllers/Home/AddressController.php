<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\PersonalController;
use Illuminate\Support\Facades\DB;
use App\Model\Address;
use App\Model\Area;

class AddressController extends Controller
{
     /**
     * 负责查询用户所有的地址信息 可共用
     *
     * @return 返回值为用户所有地址相应的数据
     */
     public function addressData(Request $request)
     {
        $personaldata = new PersonalController;
        $user = $personaldata->personalData($request);
        // var_dump($user);exit;
        // dd($user[0]->id);
        $address = Address::select(['id', 'uid', 'name', 'address', 'phone', 'code'])->where('uid',  $user[0]->id)->get(); 
        return $address;
     }


    /**
     * 加载显示用户所有地址信息
     * @return 返回页面及数据
     */
    public function index(Request $request)
    {   
        $address = $this->addressData($request);
        // dd($address[0]->uid);
        return view('Home/address', ['address' => $address]);
    }

    /**
     * Show the form for creating a new resource.
     * 创建一个新的地址数据
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        // var_dump($_GET);exit;
        // echo 11;
        //查询用户信息 uid
        $personaldata = new PersonalController;
        $user = $personaldata->personalData($request);
        if (empty($_GET['code'])) {
           $_GET['code'] = '';
        }
        //获取提交数据
        $addressData = [
            'code'    => $_GET['code'],
            'name'    => $_GET['name'],         
            'phone'   => $_GET['phone'],
            'address' => $_GET['address'],
            'uid'     => $user[0]->id
        ];
        // var_dump($addressData);
        // exit;
        $bool = DB::table('address')->insert($addressData);
        if ($bool) {
           echo json_encode(['status'=>200, 'msg'=>'添加成功！']);
        } else {

           echo json_encode(['status'=>400, 'msg'=>'添加失败，请仔细填写地址信息！']);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     *显示新增地址页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {      
        return view('Home/addressadd');
    }

    /**
     *传输地址三级联动数据
     * @param  int  $id
     * @return 返回area表的全部数据
     */
    public function edit($id)
    {
        // $area = Area::select(['id', 'name', 'upid'])->where('uid', 0)->get(); 
        if (empty($_GET['upid'])) {
            $upid= [0];
        } else {
            $upid[] = intval($_GET['upid']);
        }
        $area = DB::select('select id,name,upid from area where upid = ?', $upid);
        return $area;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param 加载修改地址页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateview(Request $request)
    {
        // echo 'update';
        $id[] = $request->input('id');

        $data = DB::select('select id ,code ,name, address, phone from address where id = ?', $id);
        // dd($data);
        return view('/Home/addressupdate-edit', ['updatedata' =>$data]);
    }

    /**
     * Update the specified resource in storage.
     * @param 处理修改地址
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateaddress(Request $request)
    {   
        $id = $request->input('id');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $code = $request->input('code') ? $request->input('code') : '';
        $address = $request->input('myaddress');
        
        $data = [
            'name' => $name,
            'phone' => $phone,
            'code' => $code,
            'address' => $address
        ];
         // var_dump($id);exit;
        $bool = DB::table('address')->where('id', $id)->update($data);
        if ($bool) {
          return redirect('home/address')->with('msg', '修改成功');
        } else {
            return back()->with('errorTip', '修改失败');
        }

    }


    /**
     *这对地址删除处理
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
        // var_dump(input('id'));
         $bool = DB::table('address')->where('id', $_GET['id'])->delete();
         if($bool) {

           return back()->with('msg', '删除成功！');
         }
    }

}
