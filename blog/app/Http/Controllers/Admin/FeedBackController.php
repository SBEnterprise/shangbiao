<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FeedBack;

/**
 * @author yaoqi <383495167@qq.com>
 * @description 用户意见反馈的业务处理
 */
class FeedBackController extends Controller
{

    /**
     * @param  int  $id
     * @author yaoqi
     * @return 页面 data数据库查询的数据
     * @description意见编辑页面
     */
    public function show ($id)
    {
        $data = FeedBack::where('id', $id)->first();
        return view('Admin/feedback/feedback-edit', ['data'=>$data]);
    }

    /**
     * 搜索+分页+展示用户意见列表
     * @param  int  $id  $title 要搜索的标题 $content 要搜索的内容 $count 总数据条数
     * @author yaoqi
     * @return 页面 要查询的数据 title content 页面加载需要的数据 contentData
     */
    public function action (Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');

        $map[] = ['id', '>', 1];
        if ($title) {
            $map[] = ['title', 'like', '%'.$title.'%'];
        }
        if ($content) {
            $map[] = ['content', 'like', '%'.$content.'%'];
        }
        $contentList = FeedBack::select(['id', 'user_id', 'username', 'content', 'created_at', 'updated_at'])->where($map)->orderby('id', 'desc')->paginate(3);
        // dd($contentList->id);
        $count = FeedBack::count('id');
        return view('Admin/feedback/feedback-list',
            [
                'count'=> $count,
                'contentData'=>$contentList,
                'title'=>$title,
                'content'=>$content,
            ]
        );
    }

    /**
     * 删除用户可能违规的意见
     * @param  int  $id
     * @author yaoqi
     * @return json数据
     */
    public function del ($id) {
        $bool = FeedBack::where('id', $id)
                ->delete();

        if ($bool) {
            return $this->json(0, '删除成功');
        } else {
            return $this->json(-1, '删除失败');
        }
    }

    /**
     * 回复用户意见
     * @param  int  $id
     * @author yaoqi
     * @return json数据
     */
    public function update (Request $request) {
        $id = $request->input('id');
        $reply = $request->input('reply');
        // dd($reply);
        $date = date('Y-m-d H:i:s');
        $bool = FeedBack::where('id', $id)->update(['reply'=>$reply, 'updated_at' => $date]);
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
