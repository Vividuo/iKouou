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
Route::group(['prefix' => 'api', 'name' => 'api', 'namespace' => 'Api',  'middleware' => 'crs'], function () {
    Route::get('init', ['name' => 'init', 'uses' => 'IndexController@init']);
});
