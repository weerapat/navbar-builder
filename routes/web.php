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
    return view('pages.index');
});

/* Route for navigation bar */
Route::group([
    'namespace' => 'NavigationBar',
    'prefix' => 'navigation-bar',
], function () {
    Route::get('/', 'NavigationBarController@index')->name('navigation-bar-index');
    Route::get('setting', 'NavigationBarController@getSetting');
    Route::put('setting', 'NavigationBarController@saveSetting');
});
