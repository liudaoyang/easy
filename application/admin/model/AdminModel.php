<?php
/**
 * Created by PhpStorm.
 * User: chenxing <1160576079@qq.com>
 * Date: 2017/12/8 11:19
 */

namespace app\admin\model;

use think\Model;
class AdminModel extends Model
{
    protected $table = 'admin';

    protected function getWhere($param)
    {
        $where = " 1=1 ";
        if (isset($param['timegap']) && !empty($param['timegap'])) {
            $time = getStarEndTime($param['timegap']);
            $where .= " and created between '{$time['start']}' and '{$time['end']}' ";
        }
        if (isset($param['name']) && !empty($param['name'])) {
            $where .= " and admin.name = '{$param['name']}' ";
        }
        if (isset($param['status']) && !empty($param['status'])) {
            $where .= " and status = '{$param['status']}' ";
        }
        return $where;
    }

    public function getAdminList($param)
    {
        $offset = isset($param['offset'])?$param['offset']:0;
        $limit = isset($param['limit'])?$param['limit']:20;
        $where = $this->getWhere($param);
        $sql   = " select admin.*,role.name as role_name from admin inner join role on admin.role_id = role.id where $where order by id desc limit $offset,$limit ";
        $rows = $this->query($sql);
        foreach ($rows as $k=>$v) {
            $rows[$k]['status'] = $v['status'] == 'live'?'正常':"禁用";
        }
        $total = $this->where($where)->count();
        return ['rows'=>$rows?:array(),'total'=>$total];
    }

    public function addAdmin($param)
    {

        $data = [
            'name' => $param['name'],
            'password' => encrypt($param['password']),
            'status'    => $param['status'],
            'role_id' => $param['role_id'],
        ];
        $res = $this->save($data);
        if (!$res) {
            return ['code'=>false, 'data'=>$this->getError()];
        }
        return ['code'=>true, 'data'=>'添加成功'];
    }

    public function editAdmin($param)
    {
        $data = [
            'name' => $param['name'],
            'password' => encrypt($param['password']),
            'status'    => $param['status'],
            'role_id' => $param['role_id'],
        ];
        $res = $this->where('id', $param['id'])->update($data);
        if (!$res) {
            return ['code'=>false, 'data'=>$this->getError()];
        }
        return ['code'=>true, 'data'=>'修改成功'];
    }

}