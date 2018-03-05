<?php
/**
 * Created by PhpStorm.
 * User: chenxing <1160576079@qq.com>
 * Date: 2017/12/12 15:31
 */

namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\RoleModel;
use app\admin\model\NodeModel;

class Role extends Base
{
    public function getRoles()
    {
        if (request()->isAjax()) {
            $roleModel = new RoleModel();
            $data = $roleModel->select();
            return json(['code'=>true, 'data'=>$data]);
        }
    }

    public function index()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $roleModel = new RoleModel();
            $data = $roleModel->getRoleList($param);
            return json(['code'=>true, 'data'=>$data]);
        }
        return $this->loadtpl();
    }

    public function giveAccess()
    {
        $param = input('param.');
        if (!isset($param['id']) || empty($param['id'])) {
            return ['code'=>false, 'data'=>'id参数错误'];
        }
        $nodeModel = new NodeModel();
        if('get' == $param['type']){
            $node = $nodeModel->getNodes($param['id']);
            return json(['code' => true, 'data' => $node]);
        }
        if('give' == $param['type']){
            $param = [
                'id' => $param['id'],
                'rule' => $param['rule']
            ];
            $roleModel = new RoleModel();
            $res = $roleModel->editRole($param);
            return json(['code' => $res['code'], 'data' => $res['data']]);
        }
    }

    public function roleAddEdit()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $type = isset($param['type'])?$param['type']:'add';
            if (!isset($param['name']) || empty($param['name'])) {
                return ['code'=>false, 'data'=>'请填写名称'];
            }
            $roleModel = new RoleModel();
            if  ($type === 'edit') {
                $res = $roleModel->editRole($param);
                return json(['code'=>$res['code'], 'data'=>$res['data']]);
            }
            $res = $roleModel->addRole($param);
            return json(['code'=>$res['code'], 'data'=>$res['data']]);
        }
        return $this->loadtpl();
    }

    public function roleDel()
    {
        if (request()->isAjax()) {
            $id = input('param.id');
            if (!$id) {
                return ['code'=>false, 'data'=>'id参数错误'];
            }
            $roleModel = new RoleModel();
            $res = $roleModel->where('id', $id)->delete();
            return json(['code'=>true, 'data'=>'删除成功']);
        }
    }

    public function getRoleInfo()
    {
        if (request()->isAjax()) {
            $id = input('param.id');
            if (!$id) {
                return json(['code'=>true, 'data'=>'id参数错误']);
            }
            $roleModel = new RoleModel();
            $data = $roleModel->where('id', $id)->find();
            return json(['code'=>true, 'data'=>$data]);
        }
    }
}