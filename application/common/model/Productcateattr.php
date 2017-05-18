<?php
/**
 * Created by mumu.
 * Date: 2016/12/27
 * Time: 9:40
 */
namespace app\common\model;
class Productcateattr extends Base
{
    protected $table = 'qp_product_cate_attr';

    public function cate()
    {
        return $this->belongsTo('Productcate','cate_id');
    }
}