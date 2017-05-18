<?php
/**
 * Created by mumu.
 * Date: 2016/11/10
 * Time: 13:18
 */
namespace app\admin\validate;
use think\Validate;
class Network extends Validate
{
    protected $rule = [
        ['name','require','请输入网点名称'],
        ['address','require','请输入网点地址'],
        ['tel', 'require','请输入网点电话'],
        ['province_id', 'require','请选择省市'],
        ['city_id', 'require','请选择城市'],
    ];
}