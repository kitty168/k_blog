<?php
/**
 * Name:
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/19
 * Time: 下午11:22
 * Created by 18php.com
 */

namespace app\facade;


use think\Facade;

/**
 * Class AdminModel
 * @package app\facade
 * @see \app\common\model\Admin
 * @mixin \app\common\model\Admin
 * @method array|\think\Model|null authLogin($admin_name, $password) static 登录验证
 * @method array|\think\Model|null getListPage($page_rows = 10, $map = [], $field = true, $order = 'id desc', $cache = false) static 获取列表带分页paginate
 */
class AdminModel extends Facade
{
    protected static function getFacadeClass()
    {
        return \app\common\model\Admin::class;
    }

}