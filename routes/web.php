<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/22
 * Project: CharityHotel
 * Github: https://github.com/pariswang/CharityHotel
 */

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

// 说明页
Route::view('hotel_staff', 'desc.hotel');
Route::view('help_seeker_staff', 'desc.help_seeker');
Route::view('advisory', 'desc.advisory');
Route::view('disclaimer', 'desc.disclaimer');

// 查找房源（酒店列表）
Route::get('hotel_list', 'HotelController@list');
Route::get('hotel_detail', 'HotelController@detail');

// 查看申请（没有指定酒店的申请单列表）
Route::get('apply_list', 'ApplyController@list');
Route::get('apply_detail', 'ApplyController@detail');

// 用户登录（医护、志愿者、后勤保障人员）
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');

// 用户注册
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::get('registerHotel', 'Auth\RegisterController@showHotelRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function (){
    // 有对应酒店的申请
    Route::get('apply_hotel', 'ApplyController@apply_hotel');
    Route::post('apply_hotel', 'ApplyController@apply_hotel_submit');

    // 无对应酒店的申请
    Route::get('apply', 'ApplyController@apply');
    Route::post('apply', 'ApplyController@apply_hotel_submit');

    Route::post('apply/cancel', 'ApplyController@cancel');
    // 医护人员个人中心
    Route::get('profile', 'ProfileController@index');
});