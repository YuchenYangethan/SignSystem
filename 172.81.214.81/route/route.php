<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yang
// +----------------------------------------------------------------------

Route::get('/','index/index/index');//->middleware('Login');
Route::get('getTime','index/index/getTime');//->middleware('Login');
Route::get('getPath','index/index/getPath');//->middleware('Login');
Route::get('go/:url/order','index/index/order');//->middleware('Login');
Route::rule('login','user/index/login','GET|POST');
Route::rule('register','user/index/register','GET|POST');
Route::get('logout','user/index/logout');
