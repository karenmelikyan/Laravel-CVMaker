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

Route::get('/', 'AppController@index');
Route::get('/registration/{username}/{password}/{passConf}', 'AppController@registration');
Route::get('/login/{username}/{password}', 'AppController@login');
Route::get('/logout', 'AppController@logout');

//Route::middleware(['CheckSession'])->group(function(){
    Route::post('/upload', 'AppController@upload');
    Route::get('/personals/{name}/{last_name}/{address}/{phone}/{email}', 'AppController@personals');
    Route::get('/generics', 'AppController@generics');
    Route::get('/download', 'AppController@download');
//});

Route::get('/test', 'AppController@test');
Route::post('/test', 'AppController@test');






