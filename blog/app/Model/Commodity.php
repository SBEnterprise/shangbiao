<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
   //商品属性表
    protected $table = 'goods_property';
	//ORM默认操作的是id这个主键
	protected $primaryKey = 'id';
}
