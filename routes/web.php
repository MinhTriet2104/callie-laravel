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
Route::get('/', 'NewspaperController@index');

Route::resource('/category', 'CategoryController');
Route::get('/category/{id}', 'CategoryController@show')->name('category.show');

Route::get('/newspaper/manage', 'NewspaperController@manage')->middleware('admin');
Route::resource('/newspaper', 'NewspaperController');
Route::get('/newspaper', 'NewspaperController@index');
Route::post('/newspaper/store', 'NewspaperController@store')->name('newspaper.store');
Route::get('/newspaper/create', 'NewspaperController@create')->name('newspaper.create');
Route::get('/newspaper/{id}/{slug}', 'NewspaperController@show')->name('newspaper.show');
Route::get('/newspaper/{id}/edit', 'NewspaperController@edit')->name('newspaper.edit');
Route::patch('/newspaper/{id}/update', 'NewspaperController@update')->name('newspaper.update');
Route::delete('/newspaper/{id}/destroy', 'NewspaperController@destroy')->name('newspaper.destroy');

Route::get('/loadmore', function() {
  return view('layouts.pages.newspaper.loadmore');
});

Route::get('/loadmoreAdmin', function() {
  return view('layouts.pages.newspaper.loadmoreAdmin');
});

Route::get('/user/login', 'UserController@login')->name('user.login');
Route::get('/user/signup', 'UserController@signup')->name('user.signup');

Route::post('/user/store', 'UserController@store')->name('user.store');
Route::post('/user/checkLogin', 'UserController@checkLogin')->name('user.checkLogin');
Route::get('/user/logout', 'UserController@logout')->name('user.logout');
Route::get('/user/show/{id}', 'UserController@show')->name('user.show');
Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
Route::patch('/user/{id}/update', 'UserController@update')->name('user.update');

Route::get('/checkEmail', function() {
  return view('layouts.pages.user.checkMail');
});

Route::get('/checkUsername', function() {
  return view('layouts.pages.user.checkUsername');
});

Route::get('/comment', 'CommentController@store');