<?php

namespace app\admin\controller;

use think\Request;
use app\common\model\Group as M;
class Group extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = M::paginate();
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        $m = new M();
        $res = $m->add();
        return $res;
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $m = new M();
        $data = $m->getById($id);
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update($id)
    {
        $m = new M();
        $res = $m->edit($id);
        return $res;
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $m = new M();
        $res = $m->delete($id);
        return $res;
    }

    /**
     * 更新状态
     *
     * @param $id
     * @return array
     */
    public function setStatus($id)
    {
        if(!$id){
            return returnMsg('数据不存在!');
        }
        $user = M::get($id);
        $user->status = $user->getData('status')?0:1;
        $user->save();
        return returnMsg(true, $user->status);
    }
}
