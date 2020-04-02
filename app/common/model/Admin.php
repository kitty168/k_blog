<?php
/**
 * Name:
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/19
 * Time: 下午11:19
 * Created by 18php.com
 */

namespace app\common\model;

/**
 * Class Admin
 * @package app\common\model
 */
class Admin extends BaseModel
{
    /**
     * @param $admin_name
     * @param $password
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function authLogin($admin_name, $password)
    {
        return $this->where('admin_name','=',$admin_name)->where('password','=',md5($password))->find();
    }

}