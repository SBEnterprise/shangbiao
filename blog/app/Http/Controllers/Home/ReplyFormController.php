<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ReplyForm;
use App\Model\FeedBack;
use App\Model\User;

class ReplyFormController extends Controller
{
    /**
     * @ author yaoqi
     * @param $id 用户的user_id
     * @decription 根据意见表的user_id, id 查询回复表的数据
     */
    public function reply (Request $request)
    {
        $userid = $request->session()->get('userid');
        $username = $request->session()->get('username');
        $reply = $request->input('reply');
        $feedback_id = $request->input('feedback_id');

        $date = date('Y-m-d H:i:s');
        $bool = ReplyForm::insert(['uid' => $userid, 'username' => $username, 'feedback_id' => $feedback_id, 'reply' => $reply, 'created_at' => $date]);
        // dd($bool);
        if ($bool) {
            return $this->json(0, '回复成功');
        } else {
            return $this->json(-1, '回复失败');
        }
    }

    public function show (Request $request)
    {
        $userid = $request->session()->get('userid');
        $data = FeedBack::where('user_id', $userid)->with('replyform')->get();
        $head_pic = User::where('id', $userid)->first();

        // echo "<pre>";
        // var_dump($data);
        // foreach($data as $v) {
        //     echo "回馈内容：“".$v->username."” 说：".$v->content."<br>";
        //     echo "回复内容：<br>";
        //     foreach($v->replyform as $reply){
        //         $style = ($reply->uid==0)?'style="color:red"':'';
        //         echo "<span ".$style.">“".$reply->username."” 说：".$reply->reply."</span><br>";
        //     }
        //     echo "<hr>";
        // }
        // $replyData = FeedBack::where('user_id', $id)->replyform();
        return view('Home/myfeedback', ['head_pic' => $head_pic, 'data' => $data]);

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
