<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
    });

    Route::middleware('auth:api')
        ->prefix('auth')
        ->group(function () {
            Route::post('logout', 'AuthController@logout');
            Route::post('refresh' , 'AuthController@refresh');
            Route::post('me', 'AuthController@me');
        });

    Route::post('/articles/import', 'ArticlesController@import');
    Route::get('/articles', 'ArticlesController@index');
    Route::get('/categories', 'CategoriesController@index');
});
