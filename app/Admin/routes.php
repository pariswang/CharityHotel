<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('auth/register', 'AuthController@register');
    $router->resource('hospital', HospitalController::class);
    $router->resource('hotel', HotelController::class);
    $router->resource('subscribe', SubscribeController::class);
    $router->resource('user', UserController::class);

});
