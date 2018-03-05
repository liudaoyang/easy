<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

return [
    'view_mobile_prefix' => 'mb_',

    //模板参数替换
    'view_replace_str'       	 => array(
        '__CSS__'    			 => '/static/admin/css',
        '__JS__'    			 => '/static/admin/js',
        '__IMG__' 				 => '/static/admin/images',
        '__PLUGINS__'            => '/static/admin/plugins',
        '__MOBILE_JS__'			 => '/static/mobile/js',
        '__FROZENUI_CSS__'    	 => '/static/mobile/frozenui-1.3.0/css',
        '__FROZENUI_JS__'     	 => '/static/mobile/frozenui-1.3.0/js',
        '__FROZENUI_IMG__'		 => '/static/mobile/frozenui-1.3.0/img',
        '__FROZENUI_LIB__'		 => '/static/mobile/frozenui-1.3.0/lib',
    ),
    'no_check_role' => ['admin/index/index','admin/index/welcome'],//不用权限检查的接口
	// URL普通方式参数 用于自动生成
//  'url_common_param'       => true,
     'site_theme' => 'mobAdmin'
];
