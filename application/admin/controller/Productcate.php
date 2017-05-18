<?php
/**
 * Created by mumu.
 * Date: 2016/12/27
 * Time: 9:39
 */
namespace app\admin\controller;
use app\common\model\Productcate as M;

class Productcate extends Base
{
    protected $beforeActionList = [
        '_beforeCreate' =>  ['only'=>'create,edit'],
    ];
    public function index(){
        $list  = M::paginate();
        $list = getTree($list);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function _beforeCreate(){
        $m = new M();
        $list = $m->where('pid=0')->select();
        $data = [];
        $id = request()->param('id');
        if($id){
            $data = $m->getById($id);
            request()->instance()->get(['cate_id'=>$data->pid]);
        }
        $this->assign('data', $data);
        $this->assign('list',$list);
        $this->fetch('create');
    }

    public function save(){
        $m = new M();
        if(request()->param('id')){
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

}