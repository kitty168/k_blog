<?php
/**
 * Name: 自定义标签库
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/26
 * Time: 下午5:33
 * Created by 18php.com
 */

namespace app\common\taglib;


use think\template\TagLib;

class T extends TagLib
{
    protected $tags = [
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'articles'     => ['attr' => 'field,id,limit,cate_id,rank,order,paginate,arg'], //闭合标签，默认为不闭合
    ];

    /**
     * @param $tag
     * @param $content
     * @return string
     */
    public function tagArticles($tag, $content)
    {
        $id = $tag['id'] ?? 'vo';
        $arg = $tag['arg'] ?? 'list'.uniqid();
        $order = isset($tag['order']) ? "'{$tag['order']}'" : "'sort desc , update_time desc'";

        $field = "'*'";
        if (isset($tag['field']) && !empty($tag['field'])) {
            if (strpos($tag['field'], '$') === 0) {
                $field = $tag['field'];
                $this->autoBuildVar($field);
            } else {
                $field = "'{$tag['field']}'";
            }
        }
        $limit = 10;
        if (isset($tag['limit']) && !empty($tag['limit'])) {
            if (strpos($tag['limit'], '$') === 0) {
                $limit = $tag['limit'];
                $this->autoBuildVar($limit);
            } else {
                $limit = "{$tag['limit']}";
            }
        }

        $map=[];

        $cate_id = '';
        if (!empty($tag['cate_id'])) {
            if (strpos($tag['cate_id'], '$') === 0) {
                $cate_id = $tag['cate_id'];
                $this->autoBuildVar($cate_id);
            } else {
                $cate_id = "{$tag['cate_id']}";
            }
        }

        if('' !== $cate_id){
            $map['article_cate_id'] = ['in',$cate_id];
        }

        if (!empty($tag['rank'])) {
            $map[] = ['rank','=',$tag['rank']];
        }
        $mapStr = var_export($map,true);

        if(!empty($tag['paginate'])){
            //走分页逻辑
            $parseStr = <<<parse
<?php
    \$$arg = \app\\facade\\ArticleModel::getListPage(
    {$limit},
    {$mapStr},
    {$field},
    {$order}
);
?>
parse;
        }else{
            //不分页
            $parseStr = <<<parse
<?php
    \$$arg = \app\\facade\\ArticleModel::getListTop(
    {$limit},
    {$mapStr},
    {$field},
    {$order}
);
?>
parse;
        }

        $parseStr .= <<<parse
{volist name="{$arg}" id="{$id}"}
{$content}
{/volist}
parse;
        return $parseStr;
    }

}