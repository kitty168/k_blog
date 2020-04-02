<?php
/**
 * Name:
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/26
 * Time: 下午7:41
 * Created by 18php.com
 */

namespace app\admin\controller;


use app\facade\CategoryModel;

class Category extends Base
{
    protected $categoryTree = [];

    public function initialize(){
        parent::initialize();

        //获取分类树，设置缓存
        $categoryAll = CategoryModel::getCategoryAll();
        $this->categoryTree = CategoryModel::getCategoryTree($categoryAll);

    }

    //分类列表
    public function lst(){

        $this->assign('categoryTree',$this->categoryTree);

        return view();
    }



    /**
     * 新增
     */
    public function add(){
        if($this->request->isPost()) {
            $res['status'] = 0;

            $data['pid'] = input('pid',0);
            $data['title'] = input('title',0);
            $data['note'] = input('note','');
            $data['sort'] = input('sort','');
            $data['url'] = input('url','');
            $data['seo_url'] = input('seo_url','');
            $data['target'] = input('target','');
            $data['state'] = input('state','');
            $data['create_time'] = $data['update_time'] = time();
            $level = $data['pid'] > 0 ? CategoryModel::where('id','=',$data['pid'])->value('level')+1 : 0;
            $data['level'] = $level;
            if(CategoryModel::create($data)){
                $res['status'] = 1;
                $res['msg'] = '操作成功';
            }else{
                $res['msg'] = '操作失败';
            }
            return json($res);
        }

        $this->assign('categoryTree',$this->categoryTree);
        return view();
    }

    /**
     * 更新
     */
    public function edit(){
        if($this->request->isPost()){
            $res['status'] = 0;

            $data['id'] = input('id',0);
            $data['pid'] = input('pid',0);
            $data['title'] = input('title',0);
            $data['note'] = input('note','');
            $data['sort'] = input('sort','');
            $data['url'] = input('url','');
            $data['seo_url'] = input('seo_url','');
            $data['target'] = input('target','');
            $data['state'] = input('state','');
            $data['update_time'] = input('update_time',0);

            $level = $data['pid'] > 0 ? CategoryModel::where('id','=',$data['pid'])->value('level')+1 : 0;
            $data['level'] = $level;

            if('false' !== CategoryModel::update($data)){
                $res['status'] = 1;
                $res['msg'] = '操作成功';
            }else{
                $res['msg'] = '操作失败';
            }
            return json($res);
        }

        $id = input('id', 0);

        $info = CategoryModel::getInfo($id);

        $this->assign('categoryTree',$this->categoryTree);
        $this->assign('info',$info);

        return view();
    }

    /**
     * 删除
     * @return mixed
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function delete(){
        if ($this->request->isDelete()) {
            $id = input('post.id/d', 0);
            CategoryModel::destroy($id);
            return $this->apiReturn(200, '彻底删除成功');
        }
        return $this->apiReturn(403, '非法请求');
    }

}