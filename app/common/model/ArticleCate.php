<?php
/**
 * Name:
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/22
 * Time: 上午1:34
 * Created by 18php.com
 */

namespace app\common\model;


class ArticleCate extends BaseModel
{
    public function article()
    {
        return $this->hasMany(Article::class,'article_cate_id','id');
    }

}