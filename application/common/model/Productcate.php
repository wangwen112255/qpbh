<?php
/**
 * Created by mumu.
 * Date: 2016/12/27
 * Time: 9:40
 */
namespace app\common\model;
class Productcate extends Base
{
    protected $table = 'qp_product_cate';
    public function prods()
    {
        return $this->hasMany('Product','cate_id')->field("");
    }
}