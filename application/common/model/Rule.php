<?php

namespace app\common\model;

class Rule extends Base
{
    /**
     * @param $value
     * @return mixed
     * 获取原始数据用$u->getData('status');
     */
    public function getStatusAttr($value){
        $status = [0=>'隐藏', 1=>'显示'];
        return $status[$value];
    }

    /**
     * 添加菜单
     * @param $array
     * @return array
     */
    public function add($vali=true){
        $data = input('post.');
//        return toJson(json_encode($data));
        $res = $this->validate(true)->allowField(true)->save($data);
        if(false !== $res){
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }

    /**
     * 修改菜单
     * @param $id
     * @return array
     */
    public function edit($id){
        if(!$id){
            return toJson('数据不存在!');
        }
        $data = input('post.');
        if(isset($data['status'])){
            $data['status'] = isset($data['status'])?$data['status']:0;
        }
        $res = $this->allowField(true)->save($data,['id'=>$id]);

        if(false !== $res){
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }
}
