<?php
/**
 * Created by PhpStorm.
 * User: chenxing <1160576079@qq.com>
 * Date: 2017/12/8 10:16
 */

namespace app\admin\controller;


use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
        if (empty(session('admin_id'))) {
            $this->redirect('admin/login/index');
        }

        $m = strtolower(request()->module());
        $c = strtolower(request()->controller());
        $a = strtolower(request()->action());
        $nodeStr = $m . '/' . $c . '/' . $a;
        if (!in_array($nodeStr, config('no_check_role'))) {
            if (!in_array($nodeStr, session('role_node'))) {
                if (request()->isAjax()) {
                    return json(['code' => false, 'data' => '没有操作权限']);
                }
                $this->error('没有权限');
            }
        }
        $this->assign('menu', session('role_menu'));
    }

    public function loadtpl()
    {
        if (request()->isMobile()) {
            $tpl = (config('view_mobile_prefix')?:'mb_') . strtolower(request()->action());
            return $this->fetch($tpl);
        }
        return $this->fetch();
    }

}