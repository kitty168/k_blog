<?php
namespace app\index\controller;

use app\facade\ArticleModel;

class Article extends Base
{
    public function lst($id=0)
    {
        $map[] = ['state','=',1];
        $map[] = ['article_cate_id','=',$id];
        $list = ArticleModel::getListPage(10,$map);

        $this->assign('list',$list);

        return $this->fetch('');
    }

    public function detail($id)
    {
        $info = ArticleModel::find($id);
        $this->assign('info',$info);
        return $this->fetch();
    }


}
