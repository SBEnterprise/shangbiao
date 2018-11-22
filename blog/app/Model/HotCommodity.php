<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
* 操作热销商品表
*   lizhentao qq1214685942@gmail.com
* @return 外表，外键，内键（默认为id,可不写）
*/
class HotCommodity extends Model
{
    //连接热销商品的数据表
	protected $table = 'goods';

	//ORM默认操作的是id这个主键
	protected $primaryKey = 'id';

}
