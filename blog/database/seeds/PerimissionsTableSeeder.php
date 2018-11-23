<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $permission = [
	    	[
	    		'name' => 'feedback-list',
	    		'display_name' => 'system-base-List',
	    		'description' => '用户意见列表',
	    	],
	    	[
	    		'name' => 'feedbackreply-edit',
	    		'display_name' => 'feedbackreply-Edit',
	    		'description' => '用户意见回复添加',
	    	],
	    	[
	    		'name' => 'feedbackmember-show',
	    		'display_name' => 'feedbackmember-Show',
	    		'description' => '意见反馈会员信息展示',
	    	],
	    	[
	    		'name' => 'feedback-delete',
	    		'display_name' => 'feedback-Delete',
	    		'description' => '意见删除',
	    	],
	    	[
	    		'name' => 'order-list',
	    		'display_name' => 'order-List',
	    		'description' => '订单列表',
	    	],
	    	[
	    		'name' => 'order-edit',
	    		'display_name' => 'order-Edit',
	    		'description' => '订单修改',
	    	],
	    	[
	    		'name' => 'img-list',
	    		'display_name' => 'img List',
	    		'description' => '图片管理列表',
	    	],
	    	[
	    		'name' => 'img-create',
	    		'display_name' => 'img Create',
	    		'description' => '图片添加',
	    	],
	    	[
	    		'name' => 'img-delete',
	    		'display_name' => 'img Delete',
	    		'description' => '图片删除',
	    	],
	    	[
	    		'name' => 'integral-list',
	    		'display_name' => 'integral List',
	    		'description' => '积分管理列表',
	    	],
	    	[
	    		'name' => 'integral-edit',
	    		'display_name' => 'integral Edit',
	    		'description' => '积分管理修改',
	    	],
	    	[
	    		'name' => 'integral-delete',
	    		'display_name' => 'integral Delete',
	    		'description' => '积分管理删除',
	    	],
	    	[
	    		'name' => 'integral-rules-list',
	    		'display_name' => 'integral-rules List',
	    		'description' => '积分规则列表',
	    	],
	    	[
	    		'name' => 'integral-rules-create',
	    		'display_name' => 'integral-rules Create',
	    		'description' => '积分规则添加',
	    	],
	    	[
	    		'name' => 'integral-rules-edit',
	    		'display_name' => 'integral-rules Edit',
	    		'description' => '积分规则修改',
	    	],
	    	[
	    		'name' => 'integral-rules-delete',
	    		'display_name' => 'integral-rules Delete',
	    		'description' => '积分规则删除',
	    	],
	    	[
	    		'name' => 'carousel-list',
	    		'display_name' => 'carousel List',
	    		'description' => '轮播图列表',
	    	],
	    	[
	    		'name' => 'carousel-create',
	    		'display_name' => 'carousel Create',
	    		'description' => '轮播图添加',
	    	],
	    	[
	    		'name' => 'carousel-edit',
	    		'display_name' => 'carousel Edit',
	    		'description' => '轮播图修改',
	    	],
	    	[
	    		'name' => 'carousel-status',
	    		'display_name' => 'carousel Status',
	    		'description' => '轮播图状态更新',
	    	],
	    	[
	    		'name' => 'carousel-delete',
	    		'display_name' => 'carousel Delete',
	    		'description' => '轮播图删除',
	    	],
	    ];
	    foreach ($permission as $value) {
        	Permission::create($value);
        }
    }
}
