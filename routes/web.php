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


Route::get('/' , 'FrontEnd@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('welcome' , 'FrontEnd@index');
Route::get('admin','FrontEnd@admin');
Route::resource('categories', 'CategoriesController');
Route::resource('articles', 'ArticlesController');
