<?php

namespace app\admin\controller;

use app\common\model\Rule as M;

class AuthRule extends Base
{
    protected $m;
    public function _initialize()
    {
        parent::_initialize();
        $this->m = new M();
    }

    /**
     * 显示资源列表
     * @return \think\Response
     */
    public function index()
    {
        $data = $this->m->order('id','desc')->select();
        $list = getTreeList($data);
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 显示创建资源表单页.
     * @return \think\Response
     */
    public function create($pid=0)
    {
        $treeList = $this->m->where('status', 1)->select();
        $this->assign('list', $treeList);
        $this->assign('pid', $pid);

        return $this->fetch();
    }

    /**
     * 保存新建的资源
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        $res = $this->m->add();
        return $res;
    }

    /**
     * 显示编辑资源表单页.
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $treeList = $this->m->where('status', 1)->select();
        $data = $this->m->get($id);
        $this->assign('data', $data);
        $this->assign('list', $treeList);
        return $this->fetch();
    }

    /**
     * 保存更新的资源
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update($id)
    {
        $res = $this->m->edit($id);
        return $res;
    }

    /**
     * 删除指定资源
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $res = $this->m->delete();
        return $res;
    }

    /**
     * 更新状态
     * @param $id
     * @return array
     */
    public function setStatus($id)
    {
        if(!$id){
            return toJson('数据不存在!');
        }
        $user = M::get($id);
        $user->status = $user->getData('status')?0:1;
        $user->save();
        return toJson(true, $user->status);
    }

    /**
     * 设置排序
     * @return array
     */
    public function setOrder(){
        $res = $this->update(input('post.id'));
        return $res;
    }


    public function access($id){
        $this->assign('group_id', $id);
        return $this->fetch();
    }

    //图标页面
    public function icon(){
       return $this->fetch();
    }
}
