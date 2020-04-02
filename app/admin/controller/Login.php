<?php
namespace app\admin\controller;

use app\common\controller\BaseController;
use app\facade\AdminModel;

class Login extends BaseController
{
    public function index()
    {
        return $this->apiReturn(404,'request error');
    }

    public function __call($name, $arguments)
    {
        return redirect(url('Login/login'));
    }

    public function login()
    {
        if(session('admin_info')){
            return redirect(url('Index/index'));
        }

        if($this->request->isPost()){

            $data['admin_name'] = input('admin_name','');
            $data['password'] = input('password','');
            if(!$data['admin_name'] || !$data['password']){
                return $this->apiReturn(300,'登录名或密码不能为空');
            }

            $info = AdminModel::authLogin($data['admin_name'],$data['password']);
            if($info){
                //验证成功
                unset($info['password']);
                session('admin_info',$info->toArray());
                $info->login_time = time();
                $info->login_ip = $this->request->ip();
                $info->login_count = ['inc',1];
                $info->save();
                return $this->apiReturn(200,'登录成功');
            }

            return $this->apiReturn(300,'用户名或密码错误');

        }
        $this->assign('title','后台登录');
        return $this->fetch();
    }

    public function logout()
    {
        session('admin_info',null);
        return redirect(url('Login/login'));
    }

}