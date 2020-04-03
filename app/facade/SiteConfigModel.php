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

use app\common\model\SiteConfig;
use think\Facade;

/**
 * Class SiteConfigModel
 * @see SiteConfig
 * @mixin SiteConfig
 * @package app\facade
 */
class SiteConfigModel extends Facade
{
    protected static function getFacadeClass()
    {
        return SiteConfig::class;
    }

}