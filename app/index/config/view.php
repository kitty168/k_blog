<?php
/**
 * Name: 模板配置
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/19
 * Time: 下午3:24
 * Created by 18php.com
 */

$theme = 'default';

$theme_dir = '/static/themes/'.$theme;

return [
    'view_path' => '../view/themes/' . $theme . DIRECTORY_SEPARATOR,
    'tpl_replace_string' => [
        '__PUBLIC__' => '/',
        '__STATIC__' => '/static',
        '__LIB__'    => '/static/lib',

        '__THEMES__' => '/static/themes',
        '__THEME__' => $theme_dir,
        '__JS__' => $theme_dir .'/js',
        '__CSS__' => $theme_dir .'/css',
        '__IMAGES__' => $theme_dir .'/images',
        '__FONTS__' =>  $theme_dir .'/fonts',
        '__IMG__' => '//static/storage/',
    ]
];