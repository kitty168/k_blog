<?php
// 应用公共文件

if (!function_exists('api_res')) {
    /**
     * @param $code
     * @param $msg
     * @param null $data
     * @return array
     */
    function api_res($code=200,$msg='success',$data=null)
    {
        $res = [
            \think\facade\Config::get('api.api_code_key','code')  => $code,
            \think\facade\Config::get('api.api_msg_key','msg')   => $msg,
            \think\facade\Config::get('api.api_data_key','data')  => $data
        ];
        return $res;
    }
}

if (!function_exists('api_json')) {
    /**
     * @param int $code
     * @param string $msg
     * @param null $data
     * @return \think\response\Json
     */
    function api_json($code=200,$msg='success',$data=null)
    {
        return json(api_res($code,$msg,$data));
    }
}

if(!function_exists('msubstr')){
    /**
     * 自定义字符串截取函数
     * @param $str
     * @param $start
     * @param $len
     * @param string $encoding
     * @param bool $flag
     * @return string
     */
    function msubstr($str,$start,$len,$encoding='utf-8',$flag=true){

        if(mb_strlen($str, $encoding) > $len){
            $_str = mb_substr($str, $start, $len, $encoding);
            return $flag ? $_str.'...' : $_str;
        }else{
            return $str;
        }
    }
}

if (!function_exists('url_web')) {
    /**
     * @param string $url
     * @param array $vars
     * @param bool $suffix
     * @param bool $domain
     * @return string
     */
    function url_web(string $url = '', array $vars = [], $suffix = true, $domain = false)
    {
        $url = url($url, $vars, $suffix, $domain);
        $url = str_replace('/'.config('app.default_app'),'',$url);
        return  $url;
    }
}