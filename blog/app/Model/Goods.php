<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';

    protected $primarykey = 'id';

    public function detail()
    {
        return $this->hasOne('App\Model\Detail', 'gid','id');
    }

    public function goodsAttr() 
    {
    	return $this->hasOne('App\Model\Detail', 'gid', 'id')->select('gid','series','movement');
    }
}
