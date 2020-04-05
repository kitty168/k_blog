<?php
namespace app\admin\controller;

use app\common\controller\BaseController;
use think\Db;

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

    protected function updateState($mod)
    {
        if($this->request->isPost()){
            $id    = input('post.id/d', 0);
            $state = input('post.state/d',0);
            if(!in_array($state,[0,1])){
                return $this->apiReturn(300,'参数错误');
            }

            $mod::update(['state'=>$state],['id'=>$id]);

            return $this->apiReturn(200,'状态'.config('sys.state')[$state]);
        }
        return $this->apiReturn(300,'非法请求');
    }

}