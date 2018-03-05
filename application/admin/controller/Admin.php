<?php
/**
 * Created by PhpStorm.
 * User: chenxing <1160576079@qq.com>
 * Date: 2017/12/8 10:14
 */

namespace app\admin\controller;


use app\admin\controller\Base;
use app\admin\model\AdminModel;
use app\admin\model\RoleModel;

class Admin extends Base
{
    public function index()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $adminModel = new AdminModel();
            $data = $adminModel->getAdminList($param);
            return json(['code'=>true, 'data'=>$data]);
        }
        return $this->loadtpl();
    }

    public function adminAddEdit()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $type = isset($param['type']) ? $param['type']: 'add';
            $adminModel = new AdminModel();
            $validate = $this->validate($param, 'AdminValidate');
            if (true !== $validate) {
                return json(['code'=>false, 'data'=> $validate]);
            }
            if ($type === 'edit') {
                if (!isset($param['id']) || empty($param['id'])) {
                    return json(['code'=>false, 'data'=>'id参数错误']);
                }
                $res = $adminModel->editAdmin($param);
                if (!$res['code']) {
                    return json(['code'=>false, 'data'=> $res['data']]);
                }
                return json(['code'=>true, 'data'=> $res['data']]);
            }
            //默认add
            $res = $adminModel->addAdmin($param);
            if (!$res['code']) {
                return json(['code'=>false, 'data'=> $res['data']]);
            }
            return json(['code'=>true, 'data'=> $res['data']]);

        }
        $roleModel = new RoleModel();
        $this->assign('role', $roleModel->select());
        return $this->loadtpl();
    }

    public function checkAdminUnique()
    {
        if (request()->isAjax()) {
            $name = input('param.name');
            $id   = input('param.id');
            $adminModel = new AdminModel();
            if ($id) {
                $res = $adminModel->where("id != $id and name = '$name'")->find();
            }else{
                $res = $adminModel->where('name', $name)->find();
            }
            if  ($res) {
                return false;
            }
            return true;
        }
    }

    public function getAdminInfo()
    {
        if (request()->isAjax()) {
            $id = input('param.id');
            if (!$id) {
                return json(['code'=>true, 'data'=>'id参数错误']);
            }
            $adminModel = new AdminModel();
            $data = $adminModel->where('id',$id)->find();
            return json(['code'=>true, 'data'=>$data]);
        }
    }

    public function adminDel()
    {
        if (request()->isAjax()) {
            $id = input('param.id');
            if ($id === 1) {
                return json(['code'=>false, 'data'=>'此超级管理员不可删除']);
            }
            if (!$id) {
                return json(['code'=>false, 'data'=>"id参数错误"]);
            }
            $adminModel = new AdminModel();
            $red = $adminModel->where('id', $id)->delete();
            return json(['code'=>true, 'data'=>'删除成功']);
        }
    }

}