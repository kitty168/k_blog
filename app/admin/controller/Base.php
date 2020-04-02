<?php
namespace app\admin\controller;

use app\common\controller\BaseController;

class Base extends BaseController
{
    protected $middleware = ['checkLogin'];

    protected $admin_info;

    protected function initialize()
    {
        $admin_info = session('admin_info');
//        dump($admin_info);
    }

    public function __call($name, $arguments)
    {
        return 'base error:'.$name;
    }

}