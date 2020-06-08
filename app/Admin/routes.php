<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', 'UsersController');
    $router->resource('roles', 'RolesController');
    $router->resource('permissions', 'PermissionsController');
    $router->resource('topics', 'TopicsController');
    $router->post('upload_image', 'TopicsController@uploadImage');
});
