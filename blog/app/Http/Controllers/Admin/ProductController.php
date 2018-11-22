<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::put('aa', 'ssdss', 20);
        $m = Cache::get('aa');
        echo $m;
        $goods = DB::table('detail')->select(['id', 'name', 'price'])->paginate(5);

        return view('Admin/Products/list', ['goods'=>$goods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $onegood = DB::table('detail')->select(['id', 'name', 'price'])->where('id', $id)->first();

        return view('Admin/Products/show', ['good'=>$onegood]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $bool = DB::table('detail')
                ->where('id', $id)
                ->update([
                    'name'=>$request->input('name'),
                    'price'=>$request->input('price'),
        ]);

        if ($bool) {
            return redirect('admin/product')->with('msg', '修改成功');
        }
        return back()->with('errorTip', '修改失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'destory';
    }
}
