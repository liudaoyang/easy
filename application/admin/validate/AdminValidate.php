<?php
/**
 * Created by PhpStorm.
 * User: chenxing <1160576079@qq.com>
 * Date: 2017/12/8 11:25
 */

namespace app\admin\validate;


use think\Validate;

class AdminValidate extends Validate
{
    protected $rule = [
        ['name','require|chsDash|token','用户名必填|用户名填写有误'],
        ['password','require|min:6','密码必填|密码最小6位数'],
    ];
}