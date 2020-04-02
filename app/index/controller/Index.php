<?php
namespace app\index\controller;

use app\facade\ArticleModel;

class Index extends Base
{
    public function index()
    {
        $list = ArticleModel::getListPage(10);

        $this->assign('list',$list);

        return $this->fetch('');
    }

}
