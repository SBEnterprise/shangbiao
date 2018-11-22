<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comment';
    protected $primaryKey = 'comment_id';

    public function commentContent() 
    {
    	return $this->hasOne('App\Model\User','id','uid')
    			->select('id','user_name','head_pic');
    }
}
