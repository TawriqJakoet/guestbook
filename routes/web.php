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

Route::resource('/comments', 'CommentsController', ['except' =>['show']]);
Route::get('/comments/{comment}', 'CommentsController@reply')->name('comments.reply');
Route::post('/comments/{comment}', 'CommentsController@storeReply')->name('comments.storeReply');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:admin-user')->group(function(){

	Route::resource('/users', 'UsersController', ['except' =>['show', 'create', 'store']]);

});