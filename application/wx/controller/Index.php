<?php
/**
 * Created by mumu.
 * Date: 2016/12/29
 * Time: 16:48
 */
namespace app\wx\controller;
use app\common\model\Product;
use app\common\model\Productcate;

class Index extends Base
{
    public function index()
    {
//
        $item=Productcate::select();
        //$item = Productcate::hasWhere('prods', ['status' => 1])->order('id', 'ASC')->distinct(true)->select();
        $this->assign('item',$item);
        $hotlist=Product::limit(12)
            ->order('sale_month', 'desc')
            ->select();
        $promotelist=Product::limit(12)
            ->order('addtime', 'desc')
            ->select();
        $this->assign('hotlist',$hotlist);
        $this->assign('promotelist',$promotelist);

       return $this->fetch();
    }//

    public function lists(){

        return $this->fetch();
    }
}