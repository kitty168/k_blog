<?php
/**
 * Name:
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/22
 * Time: 上午1:27
 * Created by 18php.com
 */

namespace app\admin\controller;


use app\common\tool\Upload;
use app\facade\ArticleCateModel;
use app\facade\ArticleModel;

class Article extends Base
{
    protected static $mod = ArticleModel::class;

    public function lst()
    {

        $list = ArticleModel::getListPage();

        $this->assign('list',$list);

        return $this->fetch();
    }

    /**
     * @return string|\think\response\Json
     * @throws \Exception
     */
    public function add(){

        if($this->request->isPost()){
            $time = time();
            $data = $this->buildParams();

            if(ArticleModel::create($data)){
                return $this->apiReturn(200,'操作成功');
            }
            return $this->apiReturn(300,'操作失败');
        }
        $cateMap[] = ['state','=',1];
        $articleCateList = ArticleCateModel::getListAll($cateMap);
        $this->assign('articleCateList',$articleCateList);
        return $this->fetch();
    }

    protected function buildParams()
    {
        $data['title'] = input('post.title/s','');
        $data['description'] = input('post.description/s','');
        $data['details'] = input('post.details/s','');
        $data['img'] = input('post.img/s','');
        $data['sort'] = input('post.sort/d',10);
        $data['state'] = input('post.state/d',0);
        $data['article_cate_id'] = input('post.article_cate_id/d',0);

        return $data;
    }

    /**
     * @return string|\think\response\Json
     * @throws \Exception
     */
    public function edit(){
        $id = input('id/d',0);

        if($this->request->isPost()){
            $data = $this->buildParams();
            $data['id'] = $id;

            if(ArticleModel::update($data)){
                return $this->apiReturn(200,'操作成功');
            }
            return $this->apiReturn(300,'操作失败');
        }

        $info = ArticleModel::find($id);

        $cateMap[] = ['state','=',1];
        $articleCateList = ArticleCateModel::getListAll($cateMap);
        $this->assign('articleCateList',$articleCateList);

        $this->assign('info', $info);

        return $this->fetch();
    }


    public function delete()
    {
        if($this->request->isDelete()){
            $id = input('post.id/d',0);
            ArticleModel::destroy($id);
            return $this->apiReturn(200,'彻底删除成功');
        }
        return $this->apiReturn(403,'非法请求');
    }

    /**
     * @return \think\response\Json
     */
    public function softDelete()
    {
        if($this->request->isDelete()){
            $id = input('post.id/d',0);
            ArticleModel::where('id','=',$id)->update(['delete_time',time()]);
            return $this->apiReturn(200,'彻底删除成功');
        }
        return $this->apiReturn(403,'非法请求');
    }



}