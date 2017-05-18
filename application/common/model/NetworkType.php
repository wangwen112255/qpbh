<?php
/**
 * Created by mumu.
 * Date: 2016/12/22
 * Time: 11:56
 */
namespace app\common\model;
class NetworkType extends Base
{
    public function getStatusAttr($value){
        $status = [0=>'禁用', 1=>'启用'];
        return $status[$value];
    }

    public function getList($where){
        $where = $where?$where:[];
        $list = $this->where($where)->select();
        var_dump($list);
        return $list;
    }
}