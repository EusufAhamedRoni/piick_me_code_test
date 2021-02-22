<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    //key Management
    Route::group(['middleware'=>['admin']],function(){
        Route::get('/', 'PageController@homeView')->name('homeView');
        Route::post('client/licence_key/generate', 'ClientController@licenceKeyGenerate')->name('key.generate');
        Route::post('client/licence_key/save', 'ClientController@licenceKeySave')->name('key.save');
        Route::get('client/{id}', 'ClientController@getClient')->name('getClient');

        //
        Route::get('create/client/permission','ClientController@createPermission')->name('create.permission');
        Route::post('update/client/permission','ClientController@updatePermission')->name('update.permission');

        Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('adminLogout');

    });
    //
    Route::get('/home', 'HomeController@index')->name('home')->middleware('isActive');
    //
    //client area //apply Key
    Route::get('active/licence_key', 'userAreaController@activeKey')->name('active.key');
    Route::post('apply/licence_key', 'userAreaController@setExpireDate')->name('apply.key');
    Route::get('get/licence_key', 'userAreaController@getKey')->name('get.key');
    Route::get('generate/licence_key', 'userAreaController@generateLicenceKey')->name('generate.key');
    Route::post('save/licence_key', 'userAreaController@licenceKeySave')->name('save.key');
});
