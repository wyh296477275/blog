<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
    Route::get('/', function () {
        return view('welcome');
    });

    Route::any('admin/login','Admin\LoginController@login');

    Route::get('admin/code','Admin\LoginController@code');
//    Route::get('admin/crypt','Admin\LoginController@crypt');


Route::group(['middleware'=>['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::get('quit','loginController@quit');
});
Route::any('admin/pass','Admin\IndexController@pass');
