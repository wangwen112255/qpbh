<?php

namespace app\common\model;

class Address extends Base
{
    public function getTypeAttr($value){
        $type = [0=>'国家',1=>'省',2=>'城市',3=>'区县'];
        return $type[$value];
    }

    /**
     * 更新数据
     * @param id
     * @param true/msg
     */
    public function edit($id){
        if(!$id){
            return toJson('数据不存在!');
        }
        $data = input('post.');
        $result = $this->validate(true)->allowField(true)->save($data,['id'=>$id]);
        if($result !== false){
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }
}
