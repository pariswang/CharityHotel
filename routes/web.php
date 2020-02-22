<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 首页
Route::get('/', 'IndexController@index');

// 查找房源（酒店列表）
Route::get('hotel_list', 'HotelController@list');

// 查看申请（没有指定酒店的申请单列表）
Route::get('apply_list', 'ApplyController@list');

// 用户登录（医护、志愿者、后勤保障人员）
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');

// 用户注册
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function (){
    // 有对应酒店的申请
    Route::get('apply_hotel', 'ApplyController@apply_hotel');

    // 无对应酒店的申请
    Route::get('apply', 'ApplyController@apply');
});

Route::get('/home', function () {
    return view('index');
});
