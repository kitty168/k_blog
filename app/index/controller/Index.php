<?php
namespace app\index\controller;

use app\facade\ArticleModel;

class Index extends Base
{
    public function index()
    {
        $map[] = ['state','=',1];
        $list = ArticleModel::getListPage(10,$map);

        $this->assign('list',$list);

        return $this->fetch('');
    }

}
