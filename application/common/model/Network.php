<?php

namespace app\common\model;

class Network extends Base
{
    public function getStatusAttr($value){
        $status = [0=>'关闭',1=>'开启'];
        return $status[$value];
    }

    public function add($vali=true){
        $data = input('post.');
        $res = $this->validate($vali)->allowField(true)->save($data);
        if(false !== $res){
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }

    public function edit($id){
        $data = input('post.');
        $data['status'] = $data['status']?$data['status']:0;
        $res = $this->validate(true)->allowField(true)->save($data,['id'=>$id]);
        if(false !== $res){
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }
}
