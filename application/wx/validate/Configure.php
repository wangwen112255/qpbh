<?php
/**
 * Created by mumu.
 * Date: 2016/11/10
 * Time: 13:18
 */
namespace app\admin\validate;
use think\Validate;
class Configure extends Validate
{
    protected $rule = [
        ['title','require','请输入配置项名称'],
        ['name', 'require|unique:configure','请输入参数名|参数名已存在'],
    ];
}