<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @author yaoqi 意见表模型
 * @description 使用模型关联查询用户表的数据，根据意见表查询回复表的数据
 */
class FeedBack extends Model
{
    protected $table = 'feedback';

    protected $primarykey = 'id';

    public function user()
    {
        return $this->hasOne('App\Model\User', 'id', 'user_id');
    }

    public function replyform () {
        return $this->hasMany('App\Model\ReplyForm', 'feedback_id', 'id');
    }
}
