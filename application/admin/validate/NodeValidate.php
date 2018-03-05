<?php
// +----------------------------------------------------------------------
// | hlh
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2022 http://baiyf.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\validate;

use think\Validate;

class NodeValidate extends Validate
{
    protected $rule = [
        ['node_name', 'require', '节点名称能为空'],
        ['module_name', 'require', '模板名称不能为空'],
        ['control_name', 'require', '控制器名称不能为空'],
        ['action_name', 'require', '方法名称不能为空'],
    ];

}