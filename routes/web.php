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

//Auth::routes(['register' => false, 'logout' => false]);

Route::get('admin/login', function () {
    return view('login');
});
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(array('middleware' => 'guest'), function()
{
    Route::post('postlogin', 'Auth\LoginController@postLogin');
});


Route::group(['prefix' => 'admin', 'middleware' => 'role'], function () {
        Route::resource('/', 'Admin\AdminController');
        Route::resource('/users', 'Admin\UsersController');
        Route::resource('/roles', 'Admin\RoleController');
        Route::resource('/users/edit', 'Admin\UsersController@edit');
        Route::resource('/posts', 'Admin\PostController');
        Route::resource('/ads', 'Admin\AdsController');
        Route::resource('/news', 'Admin\NewsController');
        Route::resource('/commercials', 'Admin\CommercialsController');
        Route::resource('/registrations', 'Admin\RegistrationController');
        Route::get('/users/delete/{id}', 'Admin\UsersController@delete');
        Route::get('/roles/delete/{id}', 'Admin\RoleController@delete');
        Route::get('/posts/delete/{id}', 'Admin\PostController@delete');
        Route::get('/ads/delete/{id}', 'Admin\AdsController@delete');
        Route::get('/news/delete/{id}', 'Admin\NewsController@delete');
        Route::get('/commercials/delete/{id}', 'Admin\CommercialsController@delete');
        Route::get('/registrations/delete/{id}', 'Admin\RegistrationController@delete');
});

//Route::group(['prefix' => 'site','middleware' => ['role:Novinar']], function () {
//    Route::get('/',function(){
//        return view('site.index');
//    });
//});
Route::get('/', 'HomeController@index');
Route::post('/storesite', 'Admin\RegistrationController@storesite');
