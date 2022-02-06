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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'ActionController@index');
Route::get('AddAcount', 'ActionController@AddAcount')->name('AddAcount');
Route::get('AddProject', 'ActionController@AddProject')->name('AddProject');
Route::get('AddJop', 'ActionController@AddJop')->name('AddJop');
Route::get('AddTask', 'ActionController@AddTask')->name('AddTask');




