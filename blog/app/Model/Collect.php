<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{

    protected $table = 'sb_goods_collect';
    protected $primaryKey = 'id';

    public function collectGoods()
    {
    	return $this->hasOne('App\Model\Goods','id','goods_id')
    				->select('id','goods_pic','price','present_price','goods_name');
    }
}
