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

Auth::routes();
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/categories/{category}', 'HomeController@showItemsByCategory')->name('show_items_by_category');
Route::resource('item', 'ItemController', ['only' => [
    'show'
]]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'UserController@show')->name('user_show');
    Route::post('/profile', 'UserController@update')->name('user_update');
    Route::post('/profile/update_password', 'UserController@updatePassword')->name('password_update');
});
