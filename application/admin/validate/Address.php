<?php
/**
 * Created by mumu.
 * Date: 2016/11/10
 * Time: 13:18
 */
namespace app\admin\validate;
use think\Validate;
class Address extends Validate
{
    protected $rule = [
        ['name','require','请输入地区名称'],
    ];
}