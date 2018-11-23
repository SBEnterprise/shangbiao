<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FeedBack;
use App\Model\ReplyForm;
use App\Model\User;

/**
 * @param $id 意见表的id
 * @author yaoqi
 * @description 对用户的意见的业务处理
 */
class ReplyFormController extends Controller
{
    /**
     * @param $id 意见表的id
     * @author yaoqi
     * @description 展示用户和后台客服的回复
     */
    public function show (Request $request, $id)
    {
        $replyData = ReplyForm::select(['uid', 'username', 'reply', 'created_at', 'updated_at'])->where('feedback_id', $id)->get()->toArray();
        if (empty($replyData)) {
            die('你还没有回复用户的意见');
        }
        foreach($replyData as $v){
            $id = $v['uid'];
        }
        $userData = User::select(['head_pic', 'user_name'])->where('id', $id)->first();
        
        return view('Admin/feedback/reply-show', ['userData' => $userData, 'replyData' => $replyData]);
    }

    /**
     * @param $id 意见表的id
     * @author yaoqi
     * @description 展示意见回复的页面
    */
    public function edit($id)
    {
        $data = FeedBack::select(['id', 'user_id', 'username'])->where('id', $id)->first();
        // dd($data);
        return view('Admin/feedback/reply-edit', ['data' => $data]);
    }

    /**
     * @param $request
     * @author yaoqi
     * @description 对用户的意见进行回复
    */
    public function insert (Request $request)
    {
        $uid = $request->input('user_id');
        $feedback_id = $request->input('feedback_id');
        $username = $request->input('username');
        // $username = 'system';
        $reply = $request->input('reply');
        $date = date('Y-m-d H:i:s');
        $bool = ReplyForm::insert([
            'uid' => $uid,
            'feedback_id' => $feedback_id,
            'username' => $username,
            'reply' => $reply,
            'updated_at' => $date,
        ]);
        if ($bool) {
            return $this->json(0, '回复成功');
        } else {
            return $this->json(-1, '回复失败');
        }
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
