<?php
namespace app\index\controller;

use app\facade\ArticleModel;

class Index extends Base
{
    public function index()
    {
        $map[] = ['state','=',1];
        $list = ArticleModel::getListPage(10,$map);

        $seo_title = '首页-';

        $this->assign('seo_title',$seo_title);

        $this->assign('list',$list);

        return $this->fetch('');
    }

}
