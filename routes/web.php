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

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function(){
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    Route::resource('/users', 'UserController');
    Route::resource('/requests', 'RequestController');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register/{id}',['uses' =>'Auth\RegisterController@index']);
Auth::routes();

Route::resource('/cabinet', 'CabinetController');
