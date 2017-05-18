<?php

namespace app\common\model;

class Group extends Base
{
    /**
     * @param $value
     * @return mixed
     * 获取原始数据用$g->getData('status');
     */
    public function getStatusAttr($value){
        $status = [0=>'禁用', 1=>'启用'];
        return $status[$value];
    }
    /**
     * 添加数据
     * @param $value
     * @return array
     */
    public function add($vali='group'){
        $data = input('post.');
        $res = $this->validate($vali)->allowField(true)->save($data);
        if(false !== $res){
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }

    /**
     * 更新数据
     * @param $id
     * @return array
     */
    public function edit($id){
        if(!$id){
            return toJson('数据不存在!');
        }
        $data = input('post.');
        $data['status'] = isset($data['status'])?$data['status']:0;
        $result = $this->allowField(true)->save($data,['id'=>$id]);
        if($result !== false){
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }

    /**
     * @param $id
     * @return array
     */


}
