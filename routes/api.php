<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('user', function (Request $request) {
        return $request->user();
    });
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('articles', 'ArticleController@index');
    Route::get('article/{id}', 'ArticleController@show');
    Route::post('article', 'ArticleController@store');
    Route::put('article/{id}', 'ArticleController@update');
    Route::delete('article/{id}', 'ArticleController@destroy');
});
