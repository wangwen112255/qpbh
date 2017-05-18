<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/*
 * 获取客户端IP地址
 * @return string ip
 * */
function get_client_ip() {
    static $ip = NULL;
    if ($ip !== NULL) return $ip;
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos =  array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip   =  trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0';
    return $ip;
}

/**
 * ajax返回处理，code=200成功，code=100失败
 * @param $res
 * @param null $data
 * @param string $msg
 * @return array
 */
function toJson($res,$data=[],$msg='操作成功!'){
    if(true === $res){
        $rs = ['code'=>200, 'msg'=>$msg];
        if(!empty($data))$rs['data'] = $data;
        return $rs;
    } else {
        return ['code'=>100, 'msg'=>$res];
    }
}

/**
 * 获取树形菜单-多维数组(树形)
 * @param array $data
 * @param ind $pid
 * @param string $html
 * @return array $list
 */
function getTree($data=[], $pid=0, $html='', $n=0) {
    $html = $html?$html:'<i class="fa fa-ellipsis-h"></i>';
    $list = [];
    foreach ($data as $k=>$v) {
        if($v['pid'] == $pid) {
            $v['html'] = str_repeat($html, $n);
            $n++;
            $v['child'] = getTree($data, $v['id'], $html, $n);
            $list[] = $v;
            unset($data[$k]);
        }
    }
    return $list;
}

/**
 * 获取树形菜单列表-二维数组
 * @param array $data
 * @param ind $pid
 * @param string $html
 * @return array $list
 */
function getTreeList($data=[], $pid=0, $html='', $n=0) {
    $html = $html?$html:'<i class="fa fa-ellipsis-h"></i>';
    $list = [];
    foreach ($data as $k=>$v) {
        $n = $pid?$n:0;
        if($v['pid'] == $pid) {
            $v['html'] = str_repeat($html, $n);
            $list[] = $v;
            unset($data[$k]);
            $res = getTreeList($data, $v['id'], $html, $n+1);
            if($res){
                $n++;
            }
            $list = array_merge($list, $res);
        }
    }
    return $list;
}

/**
 * 根据子菜单环获取父级菜单
 * @param $pid
 * @param array $data
 * @return array
 */
function getParents($id, $data = [], $table='rule'){
    if($id==0)return $data;
    $parent = Db::name($table)->where('id',$id)->find();
    $data[] = $parent;
    if($parent['pid']==0){
        krsort($data);
        return $data;
    }else{
        return getParents($parent['pid'], $data, $table);
    }
}

/**
 * 加密字符串
 * @param $pass 字符串
 * @param $prefix 前缀
 * @return string 加密后字符串
 */
function encryPtion($pass, $prefix=''){
    return md5($prefix.$pass);
}

/**
 * 获取随机字符串
 * @param int $length 字符串长度
 * @return string
 */
function getRandStr($length = 5){
    $str = '0123456789abcdefghighlmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
    $len = strlen($str)-1;
    $code = '';
    for ($i=0; $i < $length; $i++) {
        $k = mt_rand(0,$len);
        $code .= substr($str, $k,1);
    }
    return $code;
}