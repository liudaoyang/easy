<?php
/**
 * Created by PhpStorm.
 * User: chenxing <1160576079@qq.com>
 * Date: 2017/12/8 11:25
 */

namespace app\admin\validate;


use think\Validate;

class LoginValidate extends Validate
{
    protected $rule = [
        ['name','require','用户名必填'],
        ['password','require','密码必填'],
        ['code','require','验证码必填']
    ];
}