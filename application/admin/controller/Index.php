<?php
/**
 * Created by mumu.
 * Date: 2016/11/7
 * Time: 11:00
 */
namespace app\admin\controller;
use app\common\model\Rule;

class Index extends Base
{
    public function index(){
        $data = Rule::where('status', 1)->order('order','desc')->select();
        $list = getTree($data);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function vie(){
        return 'aa';
    }
}