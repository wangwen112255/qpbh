<?php
/**
 * Created by mumu.
 * Date: 2016/12/27
 * Time: 9:39
 */
namespace app\admin\controller;
use app\common\model\Productcateattr as M;
use app\common\model\Productcate;

class Productcateattr extends Base
{
    protected $beforeActionList = [
        '_beforeCreate' =>  ['only'=>'create,edit'],
    ];
    public function index(){
        $list  = M::paginate();
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function _beforeCreate(){
        $m = new M();
        $list = $m->select();
        $catelist = Productcate::select();
        $catelist = getTreeList($catelist,0,' — ');
        $data = [];
        $id = request()->param('id');
        if($id){
            $data = $m->getById($id);
            request()->instance()->get(['cate_id'=>$data->cate_id]);
            request()->instance()->get(['pid'=>$data->attr_pid]);
        }
        $this->assign('data', $data);
        $this->assign('list',$list);
        $this->assign('catelist',$catelist);
        $this->fetch('create');
    }

    public function save(){
        $m = new M();
        $id = request()->param('id');
        if($id){
            $res = $m->up();
        } else {
            $res = $m->add();
        }
        return $res;
    }

    public function update(){
        $m = new M();
        $res = $m->up();
        return $res;
    }

    public function delete($id)
    {
        $m = new M();
        $count = $m->where('pid='.$id)->count();
        if($count > 0){
            return toJson('有子类，无法删除');
        }

        $res = $m->delete($id);
        return $res;
    }

    public function getByCateId(){
        $cate_id = request()->param('cate_id');
        if(!$cate_id){
            return toJson('数据不存在');
        }
        $m = new M();
        $list = $m->where('cate_id', $cate_id)->select();
        return toJson(true, json_encode($list));
    }

}