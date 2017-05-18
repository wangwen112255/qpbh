<?php
/**
 * Created by mumu.
 * Date: 2016/12/26
 * Time: 17:24
 */
namespace app\admin\controller;
use app\common\model\Product as M;
use app\common\model\Productcate;
use app\common\model\Productcateattr;
use app\common\model\Productattr;
class Product extends Base
{
    protected $m;
    protected $beforeActionList = [
        '_beforeCreate' =>  ['only'=>'create,edit'],
    ];
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->m = new M();
    }

    public function index()
    {
        $list = $this->m->order('id', 'DESC')->paginate();
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function _beforeCreate(){
        $catelist = Productcate::select();
        $catelist = getTreeList($catelist, 0, '—');
        $data = [];
        $cateAttrList=[];
        $id = request()->param('id');
        if($id){
            $data = $this->m->getById($id);
            $cateAttrList = Productcateattr::where('cate_id', $data->cate_id)->select();
        }
        $this->assign('data', $data);
        $this->assign('catelist',$catelist);
        $this->assign('cateAttrList',$cateAttrList);
        $this->fetch('create');
    }

    public function save(){
//        return toJson(json_encode(request()->param()));
        if(input('id')){
            $res = $this->m->up();
        } else {
            request()->instance()->post(['addtime'=>date('Y-m-d H:i:s',time())]);
            $res = $this->m->add();
        }
        return $res;
    }

    public function delete($id)
    {
        $m = new M();
        $res = $m->delete($id);
        return $res;
    }

    public function deleteAttr($id)
    {
        $attr = new Productattr();
        $res = $attr->delete($id);
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
}