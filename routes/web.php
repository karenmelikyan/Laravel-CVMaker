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

    Route::get('/personals/{name}/{last_name}/{address}/{phone}/{email}', 'AppController@personals');
    Route::get('/generics/{about}/{experience}/{skills}', 'AppController@generics');
    Route::post('/download', 'AppController@download');
    Route::get('/reset', 'AppController@reset');
//});








