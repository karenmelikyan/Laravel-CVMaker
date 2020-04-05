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

//Route::middleware(['isUser'])->group(function(){
    Route::post('/registration', 'AppController@registration');
    Route::post('/login', 'AppController@login');
    Route::post('/logout', 'AppController@logout');
    Route::post('/personals', 'AppController@personals');
    Route::post('/generics', 'AppController@generics');
    Route::post('/download', 'AppController@download');
    Route::post('/reset', 'AppController@reset');
//});



