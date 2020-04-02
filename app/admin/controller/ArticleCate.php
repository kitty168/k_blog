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


use app\facade\ArticleCateModel;

class ArticleCate extends Base
{

    public function lst()
    {

        $list = ArticleCateModel::getListPage();

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
            $data['cate_name'] = input('post.cate_name/s','');
            $data['description'] = input('post.description/s','');
            $data['sort'] = input('post.sort/d',10);
            $data['state'] = input('post.state/d',0);

            if(ArticleCateModel::create($data)){
                return $this->apiReturn(200,'操作成功');
            }
            return $this->apiReturn(300,'操作失败');
        }
        return $this->fetch();
    }

    /**
     * @return string|\think\response\Json
     * @throws \Exception
     */
    public function edit(){

        $id = input('id/d',0);

        if($this->request->isPost()){
            $data['id'] = $id;
            $data['cate_name'] = input('post.cate_name/s','');
            $data['description'] = input('post.description/s','');
            $data['sort'] = input('post.sort/d',10);
            $data['state'] = input('post.state/d',0);

            if(ArticleCateModel::update($data)){
                return $this->apiReturn(200,'操作成功');
            }
            return $this->apiReturn(300,'操作失败');
        }

        $info = ArticleCateModel::find($id);

        $this->assign('info', $info);

        return $this->fetch();
    }


    public function delete()
    {
        if($this->request->isDelete()){
            $id = input('post.id/d',0);
            ArticleCateModel::destroy($id);
            return $this->apiReturn(200,'彻底删除成功');
        }
        return $this->apiReturn(403,'非法请求');
    }



}