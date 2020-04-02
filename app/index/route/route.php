<?php
/**
 * Name:
 * User: Kitty.Cheng
 * Mail: kitty.cheng@18php.com
 * Date: 2020/3/26
 * Time: 下午2:07
 * Created by 18php.com
 */

use think\facade\Route;

Route::get('kitty', function () {
    return 'kitty';
});

Route::get('cate/:id','Article/lst')->name('cate');
Route::get('article/:id','Article/detail')->name('article');