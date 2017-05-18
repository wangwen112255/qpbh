<?php
/**
 * Created by mumu.
 * Date: 2016/11/7
 * Time: 16:54
 */
namespace app\admin\validate;
use think\Validate;
class Member extends Validate
{
    protected $rule = [
        ['username' ,'unique:member|require|min:5|max:50','用户名已注册|请输入用户名|不能低于5个字符|不能超过50个字符'],
        ['phone' ,'unique:member|require','手机号被占用|请输入手机号'],
        ['realname' ,'require|min:2','请输入真实姓名|不能低于2个字符'],
        ['password', 'require|min:5','请输入密码|密码最少5个字符'],
    ];

    protected $scene = [
        'add'   =>  ['username','realname','phone','password'],
        'edit'  =>  ['username','realname'],
    ];
}