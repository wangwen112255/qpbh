<?php
/**
 * Created by mumu.
 * Date: 2016/11/7
 * Time: 16:27
 */
namespace app\common\model;
use think\Model;
class Base extends Model
{
    /**
     * 添加数据
     * @param array
     * @return array
     */
    public function add($vali=false){
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
     * @param id
     * @param true/msg
     */
    public function up($vali=false){
        $id = request()->param('id');
        if(!$id){
            return toJson('数据不存在!');
        }
        $data = input('post.');
        $result = $this->validate($vali)->allowField(true)->save($data,['id'=>$id]);
        if($result !== false){
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }

    /**
     * 删除数据
     * @param id
     * @return array
     */
    public function delete(){
        $id = input('post.id');
        $result = $this->where('id', $id)->delete();
        if(false !== $result){
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }

    /**
     * 获取数据
     * @param id
     * @return array
     */
    public function getById($id){
        $data = $this->get($id);
        return $data;
    }
}