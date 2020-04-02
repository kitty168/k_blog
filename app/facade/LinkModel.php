<?php 
/**
 * Name:
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/22
 * Time: 上午1:36
 * Created by 18php.com
 */

namespace app\facade;

use think\Facade;

/**
 * Class LinkModel
 * @package app\facade
 */
class LinkModel extends Facade
{
    protected static function getFacadeClass()
    {
        return \app\common\model\Link::class;
    }

}