<?php

namespace app\common\model;

class Configure extends Base
{
    public function getStatusAttr($value){
        $status = [0=>'禁用',1=>'启用'];
        return $status[$value];
    }

    public function edit($id){
        $data = input('post.');
        $data['status'] = isset($data['status'])?$data['status']:0;
        $result = $this->allowField(true)->save($data,['id'=>$id]);
        if($result !== false){
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }
}
