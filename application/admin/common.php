<?php

/**
 * 将字符解析成数组
 * @param $str
 */
function parseParams($str)
{
    $arrParams = [];
    parse_str(html_entity_decode(urldecode($str)), $arrParams);
    return $arrParams;
}

/**
 * 子孙树 用于菜单整理
 * @param $param
 * @param int $pid
 */
function subTree($param, $pid = 0) {
    static $res = [];
    foreach($param as $key=>$vo){

        if( $pid == $vo['pid'] ){
            $res[] = $vo;
            subTree($param, $vo['id']);
        }
    }

    return $res;
}

/**
 * 整理菜单住方法
 * @param $param
 * @return array
 */
function prepareMenu($param) {
    $parent = [];
    $child = [];

    foreach($param as $key=>$vo) {

        if($vo['pid'] == 0){
            $vo['href'] = '#';
            $parent[] = $vo;
        }else{
            $vo['href'] = url($vo['control_name'] .'/'. $vo['action_name']);
            $child[] = $vo;
        }
    }

    foreach($parent as $key=>$vo){
        foreach($child as $k=>$v){

            if($v['pid'] == $vo['id']){
                $parent[$key]['child'][] = $v;
            }
        }
    }
    unset($child);

    return $parent;
}

/**
 * 获得日期段
 */
function getDateArr($dateStart, $dateEnd) {
	$res = [];
	for ($i = strtotime($dateStart); $i<=strtotime($dateEnd); $i += 3600*24) {
		$res[] = date('Y-m-d',$i);
	}
	return $res;
}

/**
 * 获取起始时间
 */
function getStarEndTime($timeStr) {
	$res = [];
	$res['start'] 	= substr($timeStr, 0,10) . ' 00:00:00';
	$res['end']		= substr($timeStr, -10) . ' 23:59:59';
	return $res;
}

/**
 * 密码加密
 */
function encrypt($str) {
	return md5('z_' . $str . '_d');
}

function orderSn(){
	return date('Ymd') . time() . rand(1000, 9999);
}

function p($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function getControllers($dir) {
    $pathList = glob($dir . '/*.php');
    $res = [];
    foreach($pathList as $key => $value) {
        $res[] = basename($value, '.php');
    }
    return $res;
}

function getActions($className, $base='\app\admin\controller\Base') {
    $methods = get_class_methods(new $className());
    $baseMethods = get_class_methods(new $base());
    $res = array_diff($methods, $baseMethods);
    return $res;
}
