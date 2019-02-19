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

Route::prefix('api')->group(function () {
    Route::get('/commands', 'CommandsController@index');
    Route::get('/faq', 'FaqController@index');
});

Route::get('/support', 'RedirectController@support');
Route::get('/invite', 'RedirectController@invite');

Route::get('/{any}', 'SpaController@index')->where('any', '.*');
