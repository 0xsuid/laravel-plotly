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

// Route::get('/welcome', function () {
//     return view('welcome');
// });


Route::post('/csv',  'FileUpload@csvFileUpload');

// Route::get('/plotData/{url_hash}', 'Graphplot@index');

Route::get('/{vue}', 'FileUpload@index')->where('vue', '.*');