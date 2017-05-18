<?php
/**
 * Created by mumu.
 * Date: 2016/11/10
 * Time: 13:18
 */
namespace app\admin\validate;
use think\Validate;
class Rule extends Validate
{
    protected $rule = [
        ['title','require','请输入用户组名称'],
        ['name', 'require','请输入URL地址'],
    ];
}