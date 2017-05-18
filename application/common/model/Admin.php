<?php
/**
 * Created by mumu.
 * Date: 2016/11/7
 * Time: 16:23
 */
namespace app\common\model;
class Admin extends Base
{
    protected $name = 'member';

    /**
     * @关联管理组
     */
//    public function userGroup()
//    {
//        return $this->hasOne('Group_access','user_id');
//    }

    /**
     * 状态自动转换
     * @param status
     * @return status
     * 获取原始数据用$u->getData('status');
     */
    public function getStatusAttr($value){
        $status = [0=>'禁用', 1=>'启用'];
        return $status[$value];
    }


    /**
     * 添加数据
     * @param array
     * @return array
     */
    public function add($valid = 'member.add'){
        $data = input('post.');
        $data['regip'] = get_client_ip();
        $data['regtime'] = date('Y-m-d H:i:s', time());
        $data['encode'] = getRandStr();
        $data['password'] = encryPtion($data['password'],$data['encode']);
        $result = $this->validate($valid)->allowField(true)->save($data);
        if(false !== $result){
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
    public function edit($id){
        if(!$id){
            return toJson('数据不存在!');
        }
        $data = input('post.');
        $result = $this->validate('member.edit')->allowField(true)->save($data,['id'=>$id]);
        if($result !== false){
            return toJson(true);
        }else{
            return toJson($this->getError());
        }
    }

    /**
     * 删除数据
     * @param id
     * @param true/msg
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
     * 更新密码
     * @param array
     * @return array
     */
    public function setPassword(){
        $id = input('post.userid');
        $data = [];
        $data['encode'] = getRandStr();
        $data['password'] = encryPtion(input('post.password'), $data['encode']);
        $res = $this->allowField(true)->save($data,['id'=>$id]);
        if(false !== $res){
            return toJson(true);
        }
        return toJson($this->getError());
    }
}