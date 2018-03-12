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

Route::get('/', function () {
    return view('app');
});
Route::group(['prefix' => 'test', 'name' => 'test', 'namespace' => 'Test'], function () {
    Route::get('/', ['name' => 'index', 'uses' => 'TestController@index']);
});
Route::group(['prefix' => 'api', 'name' => 'api', 'namespace' => 'Api'], function () {
    Route::get('init', ['name' => 'init', 'uses' => 'IndexController@init']);
    Route::post('login', ['name' => 'login', 'uses' => 'IndexController@login']);
    Route::get('logout', ['name' => 'logout', 'uses' => 'IndexController@logout']);
    Route::get('user/list', ['name' => 'user.list', 'uses' => 'UserController@pager']);
    Route::post('user/add', ['name' => 'user.add', 'uses' => 'UserController@add']);
});
