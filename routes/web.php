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

Route::get('test', 'BubbleController@index')->name('index');
Route::get('import/{item}', 'BubbleController@import')->name('import');
Route::get('normalize', 'BubbleController@normalize')->name('import');
Route::get('importTopics', 'BubbleController@insertTopics')->name('import');
Route::get('articles/{name}', 'BubbleController@getArticles')->name('import');


Route::get('/', function () {
    return view('welcome');
});



