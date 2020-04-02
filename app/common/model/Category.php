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


class Category extends BaseModel
{

    //保存树形数组
    static protected $categoryTree = [];

    /**
     * 获取所有分类数据
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getCategoryAll() {
        return $this->where('delete_time','=',0)->order('sort')->select();
    }


    /**
     * @return array|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getCategoryLinkAll(){
        $dataAll = $this->getCategoryAll();
        return $this->getChilds($dataAll,0);
    }

    /**
     * 获取树形数组
     * @param array $cateData
     * @param int $pid
     * @return array
     */
    public function getCategoryTree($cateData,$pid=0){
        $tree = array();
        foreach ($cateData as $v) {
            if($v['pid'] == $pid) {
                $tree[]  = $v;
                $tree = array_merge($tree, $this->getCategoryTree($cateData,$v['id']));
            }
        }
        return $tree;
    }

    /**
     * 根据id获取子类
     * @param $data
     * @param $id
     * @return array
     */
    public function getChildById(&$data,$id){
        $childs=array();
        foreach ($data as $k => $v){
            if($v['pid']== $id){
                $childs[]=$v;
            }
        }
        return $childs;
    }

    /**
     * 获取父子级关系数据
     * @param $data
     * @param int $id
     * @return array|null
     */
    public function getChilds($data,$id=0){
        $childs= $this->getChildById($data,$id);
        if(empty($childs)){
            return null;
        }
        foreach ($childs as $k => $v){
            $rescurTree= $this->getChilds($data,$v['id']);
            if( null != $rescurTree){
                $childs[$k]['childs']=$rescurTree;
            }
        }
        return $childs;
    }

}