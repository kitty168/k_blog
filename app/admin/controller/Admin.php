<?php
/**
 * Name: 管理员控制器
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/20
 * Time: 下午3:15
 * Created by 18php.com
 */

namespace app\admin\controller;


use app\facade\AdminModel;

class Admin extends Base
{
    /**
     * @return string
     * @throws \Exception
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * @return \think\response\Json
     */
    public function getList()
    {
        $pageNum = input('get.pageNum/d',1);
        $pageSize = input('get.pageSize/d',10);
        $map = $this->buildMap();
        $list = AdminModel::getList($pageNum,$pageSize,$map);
        $list['map'] = $map;
        return $this->apiReturn(200,'success',$list);
    }

    /**
     * @return array
     */
    protected function buildMap()
    {
        $admin_name = input('get.admin_name/s','');
        $s_time = input('get.s_time/s','');
        $e_time = input('get.e_time/s','');

        $map = [];
        $s_time && $map[] = ['create_time','>=',strtotime($s_time)];
        $e_time && $map[] = ['create_time','<=',strtotime($e_time)+86400-1];
        $admin_name && $map[] = ['admin_name','like','%'. $admin_name .'%'];

        return $map;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function lst()
    {
        $map = [];
        $list = AdminModel::getListPage(10,$map);

        $this->assign('list',$list);

        return $this->fetch();
    }

    /**
     * @return string|\think\response\Json
     * @throws \Exception
     */
    public function add()
    {
        if($this->request->isPost()){
            $data['admin_name'] = input('post.admin_name/s','');
            $data['mobile'] = input('post.mobile/s','');
            $data['email'] = input('post.email/s','');
            $password = input('post.password/s','');
            $data['password'] = md5($password);

            AdminModel::create($data);

            return $this->apiReturn(200,'添加管理员成功');
        }

        return $this->fetch();
    }

    /**
     * @return string|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function edit()
    {
        if($this->request->isPost()){
            $data['id'] = input('post.id/d',0);
            $data['mobile'] = input('post.mobile/s','');
            $data['email'] = input('post.email/s','');
            $password = input('post.password/s','');
            $password && $data['password'] = md5($password);

            AdminModel::update($data);

            return $this->apiReturn(200,'更新管理员成功');
        }

        $id = input('get.id/d',0);
        $info = AdminModel::find($id);

        $this->assign('info', $info);
        return $this->fetch();
    }

    public function delete()
    {
        if($this->request->isDelete()){
            $id = input('post.id/d',0);
            AdminModel::destroy($id);
            return $this->apiReturn(200,'管理员彻底删除成功');
        }
        return $this->apiReturn(403,'非法请求');
    }

}