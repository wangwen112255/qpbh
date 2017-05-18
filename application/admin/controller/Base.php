<?php
/**
 * Created by mumu.
 * Date: 2016/11/7
 * Time: 11:01
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{
    public function _initialize()
    {

    }

    public function create()
    {
        return view('create');
    }

    public function edit($id)
    {
        return view('create');
    }

    public function save()
    {
        $m = new M();
        $res = $m->add();
        return $res;
    }
}