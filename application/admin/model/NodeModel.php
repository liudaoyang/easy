<?php
/**
 * Created by PhpStorm.
 * User: chenxing <1160576079@qq.com>
 * Date: 2017/12/8 15:33
 */

namespace app\admin\model;

use think\Model;
class NodeModel extends Model
{

    protected $table = "node";

    public function getMenu($rule = '')
    {
        $where = " is_menu=1 ";
        if ($rule) {
            $where .= " and id in($rule) ";
        }
        $result = db('node')->where($where)->order(['order'=> 'asc', 'id'=> 'asc'])->select();
        $menu = prepareMenu($result);
        return $menu;
    }

    public function getRoleNode($rule = '')
    {
        $where = " 1=1 ";
        if ($rule) {
            $where .= " and id in($rule) ";
        }
        $node = $this->where($where)->order(['order'=> 'asc', 'id'=> 'asc'])->select();
        $res  = [];
        foreach ($node as $k => $v ) {
            if ($v['pid'] === 0) {
                continue;
            }
            $res[] = strtolower($v['module_name'] . '/' . $v['control_name'] . '/' . $v['action_name']);
        }
        return $res;
    }

    public function getNodes($roleId)
    {
        $node = $this->field('id,pid,node_name')->select();
        $roleModel = new RoleModel();
        $rule =  $roleModel->where('id', $roleId)->value('rule');
        $ruleArr = explode(',', $rule);
        foreach ($node as $k=>$v) {
            $node[$k]['name'] = $v['node_name'];
            $node[$k]['pId'] = strval($v['pid']);
            $node[$k]['id'] = strval($v['id']);
            unset($node[$k]['node_name']);
            unset($node[$k]['pid']);
            if (in_array($v['id'], $ruleArr)) {
                $node[$k]['checked'] = 1;
            }
        }
        return $node?:[];
    }

    public function getNodeList($param) {
        $limit 		= $param['pageSize'];
        $offset 	= ($param['pageNumber'] - 1) * $limit;
        $where		= '1=1';
        $data 		= $this->where($where)->limit($offset, $limit)->select();
        $total	    = $this->where($where)->count();
        return ['rows' => $data, 'total'=>$total];
    }

    public function addNode($param) {
        $data = $this->where("node_name = '{$param['node_name']}' and module_name = '{$param['module_name']}' and action_name = '{$param['action_name']}' ")
            ->count();
        if ($data) {
            return ['code'=> false, 'data'=> '接口已存在'];
        }
        $res = $this->save($param);
        if ($res === false) {
            return ['code'=>false, 'data'=>$this->getError()];
        }
        return ['code'=>true, 'data'=>'添加成功'];
    }

    public function editNode($id, $param) {

        $res = $this->where('id', $id)->update($param);
        if ($res === false) {
            return ['code'=>false, 'data'=>$this->getError()];
        }
        return ['code'=>true, 'data'=>'编辑成功'];
    }

}