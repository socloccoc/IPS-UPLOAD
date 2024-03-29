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
    return Redirect::to('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('importView', 'MyController@importView')->name('ip.upload');
    Route::get('ip-manager', 'IpController@ipManager')->name('ip.index');
    Route::get('ip-manager/{locale}', 'IpController@deleteIpByLocale')->name('ip.deleteIpByLocale');
    Route::post('import', 'MyController@import')->name('import');
});
Route::match(['get', 'post'], 'register', function () {
    return redirect('/login');
});

Route::match(['get', 'post'], 'password/reset', function () {
    return redirect('/login');
});

Route::match(['get', 'post'], 'password/email', function () {
    return redirect('/login');
});

Route::match(['get', 'post'], 'password/reset/{token}', function () {
    return redirect('/login');
});

Route::match(['get', 'post'], 'password/reset', function () {
    return redirect('/login');
});
