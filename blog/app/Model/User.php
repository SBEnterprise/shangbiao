<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //一个模型对应一张表， 如果模型名是User,对应表名是users
    protected $table = 'users';

    protected $primaryKey = 'id';
    public $timestamps = false;

    //关联
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
}
