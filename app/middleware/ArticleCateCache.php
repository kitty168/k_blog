<?php
/**
 * Name:
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/4/5
 * Time: 下午4:31
 * Created by 18php.com
 */

namespace app\middleware;


use app\facade\ArticleCateModel;
use think\facade\Cache;

class ArticleCateCache
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $response = $next($request);
        if($request->isPost() || $request->isDelete()){
            $cateMap[] = ['state','=',1];
            $articleCateList = ArticleCateModel::getListAll($cateMap);
            Cache::set('articleCateList',$articleCateList);
        }

        return $response;
    }

}