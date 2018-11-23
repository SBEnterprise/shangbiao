<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
* 操作友情链接数据表
* 一个模型对应一张表
* @protected 受保护的方法
*/
class Friendlink extends Model
{
  
   //你真正要操作的表,因为友情链接模型默认操作的是friendlink表
	protected $table = 'friendlink';

	//ORM默认操作的是id这个主键
	protected $primaryKey = 'id';
	
}
