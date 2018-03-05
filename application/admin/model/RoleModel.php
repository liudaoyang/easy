<?php
/**
 * Created by PhpStorm.
 * User: chenxing <1160576079@qq.com>
 * Date: 2017/12/8 15:36
 */

namespace app\admin\model;


use think\Model;

class RoleModel extends Model
{
    protected $table = 'role';

    protected function getWhere($param)
    {
        $where = " 1=1 ";
        if (isset($param['name']) && !empty($param['name'])) {
            $where .= " and name = '{$param['name']}' ";
        }
        return $where;
    }

    public function getRoleList($param)
    {
        $offset = isset($param['offset'])?$param['offset']:0;
        $limit = isset($param['limit'])?$param['limit']:20;
        $where = $this->getWhere($param);
        $data = $this->where($where)->order('id desc')->limit("$offset, $limit")->select();
        $total = $this->where($where)->count();
        return ['rows'=>$data?:array(),'total'=>$total];
    }

    public function addRole($param)
    {
        $data = [
            'name' => $param['name']
        ];
        $res = $this->save($data);
        return ['code'=>true, 'data'=>'操作成功'];
    }

    public function editRole($param)
    {
        if (is_array($param['rule'])) {
            $param['rule'] = explode(',', $param['rule']);
        }
        $res = $this->where('id', $param['id'])->update($param);
        if ($res) {
            return ['code'=>true, 'data'=>'操作成功'];
        }else{
            return ['code'=>false, 'data'=>'操作失败'];
        }
    }

}