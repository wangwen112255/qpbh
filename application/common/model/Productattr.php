<?php
/**
 * Created by mumu.
 * Date: 2016/12/27
 * Time: 9:40
 */
namespace app\common\model;
class Productattr extends Base
{
    protected $table = 'qp_product_attr';

    public function cateattr()
    {
        return $this->belongsTo('Productcateattr','cate_attr_id');
    }
}