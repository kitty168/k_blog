<?php
namespace app\common\model;

use think\facade\Config;
use think\Model;

class BaseModel extends Model
{

    /**
     * @param \think\Model $model
     * @return mixed|void
     */
    public static function onBeforeInsert($model)
    {
        $model->setAttr('create_time',time());
        $model->setAttr('update_time',time());
    }

    /**
     * @param \think\Model $model
     * @return mixed|void
     */
    public static function onBeforeUpdate($model)
    {
        $model->setAttr('update_time',time());
    }

    /**
     * @param $field
     * @return string
     */
    protected function execField(&$field)
    {
        $action = 'field';
        if (isset($field['_except'])) {
            unset($field['_except']);
            $action = 'withoutField';
        }
        return $action;
    }

    /**
     * @param int $limit
     * @param array $map
     * @param bool $field
     * @param string $order
     * @param bool $cache
     * @return mixed
     */
    public function getListTop($limit = 10, $map = [], $field = true, $order = '', $cache = false)
    {
        $action = $this->execField($field);
        return $this->$action($field)->where($map)->order($order)->limit($limit)->cache($cache)->select();
    }


    /**
     * @param int $page_rows
     * @param array $map
     * @param bool $field
     * @param string $order
     * @param bool $cache
     * @return mixed
     */
    public function getListPage($page_rows = 10, $map = [], $field = true, $order = 'id desc', $cache = false)
    {
        $action = $this->execField($field);
        return $this->$action($field)->where($map)->order($order)->cache($cache)->paginate($page_rows);
    }


    /**
     * @param int $page_num
     * @param int $page_size
     * @param array $map
     * @param bool $field
     * @param string $order
     * @param bool $cache
     * @return array
     */
    public function getList($page_num = 1, $page_size = 10, $map = [], $field = true, $order = '', $cache = false)
    {
        $action = $this->execField($field);
        $list  = $this->$action($field)->where($map)->page($page_num, $page_size)->order($order)->cache($cache)->select();

        $total = $this->where($map)->count();
        return ['list' => $list, 'total' => $total];
    }

    /**
     * @param array $map
     * @param bool $field
     * @param string $order
     * @param bool $cache
     * @return mixed
     */
    public function getListAll($map = [], $field = true, $order = '', $cache = false)
    {
        $action = $this->execField($field);
        return $this->$action($field)->where($map)->order($order)->cache($cache)->select();
    }

    /**
     * @param array $map
     * @param bool $field
     * @return mixed
     */
    public function getInfo($map = [] ,$field = true)
    {
        $action = $this->execField($field);
        if(is_numeric($map)) {
            return $this->$action($field)->find($map);
        }

        return $this->$action($field)->where($map)->find();
    }

}