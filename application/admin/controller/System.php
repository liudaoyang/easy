<?php
// +----------------------------------------------------------------------
// | hlh 系统管理
// +----------------------------------------------------------------------
// | Author: chenxing <1160576079@qq.com>
// +----------------------------------------------------------------------
// | date: 2017-07-25 10:21:46
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\NodeModel;

class System extends Base {

	public function nodeList() {
        if (request()->isAjax()) {
            $param = input('param.');
            $nodeModel = new NodeModel();
            $data = $nodeModel->getNodeList($param);
            return json(['code'=>true, 'data'=>$data]);
        }
        return $this->fetch();
    }

    public function nodeAddEdit() {
        $param = input('param.');
        $type  = isset($param['type'])?$param['type']:'add';
        $nodeModel = new NodeModel();
        if (request()->isAjax()) {
            $data = [
                'node_name'     => $param['node_name'],
                'module_name'   => 'Admin',
                'control_name'  => $param['control_name'],
                'action_name'   => $param['action_name'],
                'is_menu'       => $param['is_menu'],
                'pid'           => $param['pid'],
                'style'         => $param['style'],
                'order'         => $param['order']
            ];
            $result = $this->validate($data, 'NodeValidate');
            if ($result !== true) {
                return json(['code'=> false, 'data'=> $result]);
            }
            if ($type == 'edit') {
                $res = $nodeModel->editNode($param['id'], $data);
                if ($res['code'] === false) {
                    return json(['code'=>false, 'data'=> $res['data']]);
                }
                return json(['code'=>true, 'data'=> $res['data']]);
            }
            $res = $nodeModel->addNode($data);
            if ($res['code'] === false) {
                return json(['code'=>false, 'data'=> $res['data']]);
            }
            return json(['code'=>true, 'data'=> $res['data']]);
        }

        $controllers = getControllers('../application/admin/controller');
        $this->assign('controls',$controllers);
        if ($type == 'edit') {
            $id = input('get.id');
            $data = $nodeModel->where('id', $id)->find();
            $this->assign('data', $data);
        }
        return $this->fetch();
    }

    public function getActions() {
	    if (request()->isAjax()) {
            $control = input('param.control_name');
            $data = getActions('app\admin\controller' . '\\' . $control);
            return json(['code'=>true, 'data'=>$data]);
        }
    }

    public function getParentNode() {
        if (request()->isAjax()) {
            $nodeModel = new NodeModel();
            $data = $nodeModel->where('pid = 0')->select();
            return json(['code'=>true, 'data'=>$data]);
        }
    }

   
}
