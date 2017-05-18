<?php
/**
 * Created by mumu.
 * Date: 2016/11/7
 * Time: 16:54
 */
namespace app\admin\validate;
use think\Validate;
class Group extends Validate
{
    protected $rule = [
        ['title' ,'unique:group|require','用户组已添加|请输入用户组名称'],
    ];
}