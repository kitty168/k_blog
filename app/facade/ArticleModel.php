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

use app\common\model\Article;
use think\Facade;

/**
 * Class ArticleModel
 * @see Article
 * @mixin Article
 * @package app\facade
 */
class ArticleModel extends Facade
{
    protected static function getFacadeClass()
    {
        return Article::class;
    }

}