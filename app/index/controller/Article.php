<?php
namespace app\index\controller;

use app\facade\ArticleCateModel;
use app\facade\ArticleModel;

class Article extends Base
{
    public function lst($id=0)
    {
        $map[] = ['state','=',1];
        $map[] = ['article_cate_id','=',$id];
        $list = ArticleModel::getListPage(10,$map);

        $cateInfo = ArticleCateModel::find($id);

        $seo_title = $cateInfo->cate_name . '-';

        $this->assign('seo_title',$seo_title);
        $this->assign('cateInfo',$cateInfo);
        $this->assign('list',$list);

        return $this->fetch();
    }

    public function detail($id)
    {
        $info = ArticleModel::find($id);
        $info->clicks += 1;
        $info->save();

        $seo_title = $info->title . '-'. $info->article_cate->cate_name . '-';

        $this->assign('seo_title',$seo_title);
        $this->assign('info',$info);
        return $this->fetch();
    }


}
