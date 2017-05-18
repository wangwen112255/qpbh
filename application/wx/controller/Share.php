<?php
/**
 * Created by mumu.
 * Date: 2016/12/29
 * Time: 16:48
 */
namespace app\wx\controller;
use app\common\model\Product;
use app\common\model\Productcate;

class Share extends Base
{
    public function index()
    {
//
        return $this->fetch();
    }//

    public function desc(){

        return $this->fetch();
    }

    public function group(){

        return $this->fetch();
    }

    public function order(){

        return $this->fetch();
    }

    public function ways(){

        return $this->fetch();
    }

    public function setting(){

        return $this->fetch();
    }
}