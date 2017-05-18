<?php
/**
 * Created by mumu.
 * Date: 2016/11/7
 * Time: 14:56
 */
namespace app\admin\controller;
use app\common\model\Admin as M;
class Admin extends Base
{
    public function index()
    {
        $list = M::paginate();
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function create()
    {
        return view('create');
    }

    public function save()
    {
        $m = new M();

        $res = $m->add();
        return $res;
    }

    public function edit($id)
    {
        $m = new M();
        $data = $m->getById($id);
        $this->assign('data', $data);
        return $this->fetch();
    }

    public function update($id)
    {
        $m = new M();
        $res = $m->edit($id);
        return $res;
    }

    public function delete()
    {
        $m = new M();
        $res = $m->delete();
        return $res;
    }

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

    public function setPassword($id=0){
        if(input('post.password')){
            $m = new M();
            $res = $m->setPassword();
            return $res;
        }
        $this->assign('id', $id);
        return $this->fetch();
    }
}