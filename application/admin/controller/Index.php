<?php
/**
 * Created by PhpStorm.
 * User: chenxing <1160576079@qq.com>
 * Date: 2017/12/8 10:48
 */

namespace app\admin\controller;

use app\admin\controller\Base;

class Index extends Base
{
    public function index() {
        return $this->loadtpl();
    }

    public function welcome() {
        $notifi     = require(APP_PATH . '/admin/notification.php');
        $updateLog  = require(APP_PATH . '/admin/updatelog.php');
        $this->assign('notifi', $notifi);
        $this->assign('updateLog', $updateLog);
        return $this->fetch();
    }
}