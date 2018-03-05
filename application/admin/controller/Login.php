<?php
/**
 * Created by PhpStorm.
 * User: chenxing <1160576079@qq.com>
 * Date: 2017/12/8 10:59
 */

namespace app\admin\controller;


use app\admin\model\NodeModel;
use think\Controller;
use org\Verify;

class Login extends Controller
{
    public function index()
    {
        if (request()->isMobile()) {
            $tpl = (config('view_mobile_prefix')?:'mb_') . strtolower(request()->action());
            return $this->fetch($tpl);
        }
        return $this->fetch();
    }

    public function login()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $result = $this->validate($param, 'LoginValidate');
            if (true !== $result) {
                return json(['code'=> false, 'data'=> $result]);
            }
            $verify = new Verify();
            if (!$verify->check($param['code'])) {
                return json(['code'=> false, 'data'=> '验证码错误']);
            }
            $data = db('admin')->where('name', $param['name'])->find();
            if (!$data) {
                return json(['code'=> false, 'data' => '用户不存在']);
            }
            if ($data['password'] != encrypt($param['password'])) {
                return json(['code'=> false, 'data'=>'密码不正确']);
            }
            if ($data['status'] !== 'live') {
                return json(['code' => false, 'data'=> '该账号被禁']);
            }

            $update = db('admin')->where('id', $data['id'])->update(['login_ip' => request()->ip(),'login_time'=>date('Y-m-d H:i:s',time())]);
            $role   = db('role')->where('id', $data['role_id'])->find();

            session('admin_id', $data['id']);
            session('admin_name', $data['name']);
            session('role_id', $data['role_id']);
            session('role_name', $role['name']);
            session('role_rule', $role['rule']);

            $node = new NodeModel();
            $roleNode = $node->getRoleNode(session('role_rule'));
            $roleMenu = $node->getMenu(session('role_rule'));
            session('role_node', $roleNode);
            session('role_menu', $roleMenu);

            return json(['code' => true, 'data'=>url('admin/index/index')]);
        }
    }

    public function checkVerify()
    {
        $verify = new Verify();
        $verify->imageH = 32;
        $verify->imageW = 100;
        $verify->length = 4;
        $verify->useNoise = false;
        $verify->fontSize = 14;
        return $verify->entry();
    }

    public function loginOut()
    {
        session('admin_id', null);
        $this->redirect('admin/login/index');
    }


}