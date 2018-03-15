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

Route::get('/', ['as' => 'login', 'uses' => function() {
    return view('app');
}]);

Route::group(['prefix' => 'test', 'as' => 'test.', 'namespace' => 'Test'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'TestController@index']);
});
Route::group(['prefix' => 'api', 'as' => 'api.', 'namespace' => 'Api'], function () {
    Route::get('init', ['as' => 'init', 'uses' => 'IndexController@init']);
    Route::post('login', ['as' => 'login', 'uses' => 'IndexController@login']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'IndexController@logout']);
    Route::group(['middleware' => ['auth']], function(){
        Route::post('file/upload', ['as' => 'file.upload', 'uses' => 'IndexController@upload']);
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('list', ['as' => 'list', 'uses' => 'UserController@lists']);
            Route::post('add', ['as' => 'add', 'uses' => 'UserController@add']);
            Route::post('{user}/edit', ['as' => 'edit', 'uses' => 'UserController@edit']);
            Route::get('{user}/info', ['as' => 'info', 'uses' => 'UserController@info']);
        });
        Route::group(['prefix' => 'avatar', 'as' => 'avatar.'], function () {
            Route::get('list', ['as' => 'list', 'uses' => 'AvatarController@lists']);
            Route::post('add', ['as' => 'add', 'uses' => 'AvatarController@add']);
        });
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('list', ['as' => 'list', 'uses' => 'AccessController@lists']);
            Route::post('add', ['as' => 'add', 'uses' => 'AccessController@add']);
            Route::post('{access}/edit', ['as' => 'edit', 'uses' => 'AccessController@edit']);
        });
        Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
            Route::get('list', ['as' => 'list', 'uses' => 'RoleController@lists']);
            Route::post('add', ['as' => 'add', 'uses' => 'RoleController@add']);
            Route::post('{role}/edit', ['as' => 'edit', 'uses' => 'RoleController@edit']);
        });
    });

});
