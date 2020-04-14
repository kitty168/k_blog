<?php
/**
 * Name:
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/23
 * Time: 下午5:01
 * Created by 18php.com
 */

namespace app\api\controller;


use think\facade\Filesystem;
use think\facade\Config;

class Upload extends Base
{
    public function index()
    {
        return 123;
    }

    /**
     * 单文件上传
     * @return \think\response\Json
     */
    public function upload()
    {
        $validate['file'] = [
            'fileSize' => 1024 * 1024 * 2,
            'fileMime' => ['image/jpeg','image/png','image/gif','image/ico'],
            'fileExt' => ['jpg','png','gif','jpeg','ico'],
        ];

        $saveName = '';

        $path = input('path/s','images');
        $file = request()->file('file');

        try {
            $url = Config::get('filesystem.disks.public.url') . DIRECTORY_SEPARATOR;
            validate($validate)->check(['file' => $file]);
            $saveName = Filesystem::disk('public')->putFile( $path, $file);
            $saveName = $url . $saveName;
            $code = 200;
            $msg = '上传成功';
        } catch (\think\exception\ValidateException $e) {
            $code = 300;
            $msg = $e->getMessage();
        }

        // 上传到本地服务器
        return $this->apiReturn($code,$msg,['path'=>$saveName]);
    }
}