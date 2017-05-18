<?php
/**
 * Created by mumu.
 * Date: 2016/12/26
 * Time: 17:29
 */
namespace app\common\model;

class Product extends Base
{
    protected $autoWriteTimestamp = 'datetime';
    protected $createTime = 'addtime';
    protected $updateTime = 'updatetime';
    public function getStatusAttr($value){
        $status = [0=>'禁用', 1=>'启用'];
        return $status[$value];
    }

    public function cate()
    {
        return $this->belongsTo('Productcate','cate_id');
    }

    public function attr()
    {
        return $this->hasMany('Productattr','prod_id');
    }

    public function add($vali=false){
        $data = input('post.');
        $res = $this->validate($vali)->allowField(true)->save($data);
        if(false !== $res){
            $cateAttr = new Productattr();
            $cateAttrId = $data['cate_attr_id'];
            $cateAttrValue = $data['attr_value'];
            $cateAttrPrice = $data['attr_price'];
            if(is_array($cateAttrId)){
                $proData = [];
                $proData['prod_id'] = $this->id;
                foreach ($cateAttrId as $k=>$v){
                    $cateAttr = new Productattr();
                    $proData['cate_attr_id'] = $v;
                    $proData['attr_value'] = $cateAttrValue[$k];
                    $proData['attr_price'] = $cateAttrPrice[$k];
                    $cateAttr->allowField(true)->save($proData);
                }
            }
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }

    public function up($vali=false){
        $id = request()->param('id');
        if(!$id){
            return toJson('数据不存在!');
        }
        $data = input('post.');
        $result = $this->validate($vali)->allowField(true)->save($data,['id'=>$id]);
        if($result !== false){
            $cateAttr = new Productattr();
            $cateAttrId = $data['cate_attr_id'];
            $cateAttrValue = $data['attr_value'];
            $cateAttrPrice = $data['attr_price'];
            if(is_array($cateAttrId)){
                $proData = [];
                $proData['prod_id'] = $this->id;
                foreach ($cateAttrId as $k=>$v){
                    $cateAttr = new Productattr();
                    $proData['cate_attr_id'] = $v;
                    $proData['attr_value'] = $cateAttrValue[$k];
                    $proData['attr_price'] = $cateAttrPrice[$k];
                    $cateAttr->allowField(true)->save($proData);
                }
            }
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }
}