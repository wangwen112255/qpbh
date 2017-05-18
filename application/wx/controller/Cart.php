<?php
/**
 * Created by mumu.
 * Date: 2016/12/29
 * Time: 16:48
 */
namespace app\wx\controller;
use app\common\model\Product;
use app\common\model\Productcate;

class Cart extends Base
{
    public function index()
    {
//
       return $this->fetch();
    }//

    public function lists(){

        return $this->fetch();
    }
}