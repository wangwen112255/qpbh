<?php
/**
 * Created by mumu.
 * Date: 2016/12/29
 * Time: 16:48
 */
namespace app\wx\controller;
use app\common\model\Productcate;
use app\common\model\Product;
class Products extends Base
{
    public function lists($id)
    {
//        $cateList = Productcate::hasWhere('prods', ['status' => 1])->order('id', 'DESC')->distinct(true)->select();
//        dump($cateList);
//       dump($cateList);
//        $data=array();
//        foreach ($cateList as $v) {
//         $data[]=$v->prods;
         //}
        $list=Productcate::find($id);
        $itemlist=$list->prods()->order('sale_all','DESC')->select();
        $this->assign('itemlist',$itemlist);
        return $this->fetch();

     }




    public function detail($id){
      //  dump($id);

        Product::where('id', $id)->setInc('click_all');
        $detail=Product::find($id);
        $this->assign('detail',$detail);
        ///echo $detail->name;
       // $price=$detail->attr[0]->attr_price;
       // $this->assign('price',$price);
        //echo $detail->name;
       return $this->fetch();
    }
    public function search(){
        //  $id=$_GET['id'];
//        $detail=Product::find(4);
//        $this->assign('detail',$detail);
//        ///echo $detail->name;
//        $price=$detail->attr[0]->attr_price;
//        $this->assign('price',$price);
//        //echo $detail->name;
//        return $this->fetch();
        $search=input('param.search');
        $searchlist=Product::where('name','like',"%$search%")->select();
        if($searchlist){
        $this->assign('itemlist',$searchlist);}
        else{
            $this->assign("notice",'已经尽力了，没有搜索到该商品，换个词查找一下吧');
        }
       return $this->fetch('lists');
    }
    public function more($info){
        if($info=='hot'){
            $hotlist=Product::limit(30)
                ->order('sale_all', 'desc')
                ->select();


            $this->assign('itemlist',$hotlist);

        }else if($info=='promote'){
            $promotelist=Product::limit(30)
                ->order('addtime', 'desc')
                ->select();
            $this->assign('itemlist',$promotelist);
        }
return $this->fetch('lists');
    }
}