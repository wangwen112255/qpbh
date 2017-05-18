<?php

namespace app\admin\controller;

use app\common\model\Address as M;
use think\Request;

class Address extends Base
{
    protected $m;
    public function _initialize()
    {
        parent::_initialize();
        $this->m = new M();
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = $this->m->where('pid', 0)->paginate();
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
        $res = $this->m->add();
        return $res;
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $data = $this->m->getById($id);
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
        $res = $this->m->edit($id);
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
        return toJson(true);
    }

    /**
     * 获取子级地址
     * @param $id
     * @return mixed
     */
    public function childlist($id){
        $ajax = Request::instance()->isAjax();
        if($ajax){
            $list = $this->m->where('pid', $id)->select();
        } else {
            $list = $this->m->where('pid', $id)->paginate();
        }

        if(count($list) == 1 && $ajax){
            $listNew = $this->m->where('pid=' . $list[0]['id'])->select();
            if($listNew){
                $list = $listNew;
            }
        }

        if ($ajax){
            return toJson(true,$list);
        }

        $this->assign('list', $list);
        return $this->fetch();
    }
}
