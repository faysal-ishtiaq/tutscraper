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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::resource('sites', 'SiteController');
        Route::resource('categories', 'CategoryController');
        Route::get('/categories/{category}/listPages', 'CategoryController@listPages');
        Route::get('/sites/{site}/publish', 'CategoryController@publish');
    });
});

Route::get('/sites/{site}', 'SiteController@show');
Route::get('/categories/{category}', 'CategoryController@show');