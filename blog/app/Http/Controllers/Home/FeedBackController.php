<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Model\FeedBack;
use App\Model\ReplyForm;
use App\Model\User;
use session;
use DB;

class FeedBackController extends Controller
{
    public function add (Request $request)
    {

        $userid = $request->session()->get('userid');
        $username = $request->session()->get('username');
        // dd($userid);
        $content = $request->input('content');

        $date = date('Y-m-d H:i:s');
        $bool = FeedBack::insert(['user_id' => $userid, 'username' => $username, 'content' => $content, 'created_at' => $date]);
        // dd($bool);
        if ($bool) {
            return $this->json(0, '提交成功');
        } else {
            return $this->json(-1, '提交失败');
        }
    }

    public function show (Request $request)
    {
        $userid = $request->session()->get('userid');
        $feedBackData = FeedBack::where('user_id', $userid)->get()->toArray();

        $id = FeedBack::where('user_id', $userid)->get()->toArray();
        // dd($id);
        foreach($id as $v){

            $a[] = $v['id'];
        }
        dd($a);
        $ids = Redis::set('id', serialize($a));
        $id = unserialize(Redis::get('id'));
        // dd($id);
        // $reply = ReplyForm::whereIn('uid', $a)->get();
            // $reply = FeedBack::find($a)->replyform();
            // dd($reply);
        // dd($bb);
        // dd($reply);
        $head_pic = User::where('id', $userid)->first();
        // dd($head_pic->head_pic);
        // dd($feedBackData->id);
        return view('Home/myfeedback', ['feedBackData' =>$feedBackData, 'head_pic' => $head_pic]);

    }

    public function json($code, $msg, $data=[])
    {
        return response()->json([
            'status' => $code,
            'msg' => $msg,
            'data' => $data,
        ]);
    }

}
