<?php
/**
 * Created by mumu.
 * Date: 2016/12/22
 * Time: 13:46
 */
namespace app\admin\validate;
use think\Validate;
class NetworkType extends Validate
{
    protected $rule = [
        ['name','require','请输入类别名称'],
    ];
}