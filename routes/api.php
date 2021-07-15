<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth:api'], function () {
    
    Route::get('logout', 'AuthController@logout');

    Route::prefix('color')->group(function(){
        Route::get('list', 'ColorController@index');
        Route::get('{id}/get', 'ColorController@get');
        Route::post('create', 'ColorController@create');
        Route::patch('update', 'ColorController@update');
        Route::delete('delete', 'ColorController@delete');
    });

    Route::prefix('manufacturer')->group(function(){
        Route::get('list', 'ManufacturerController@index');
        Route::get('{id}/get', 'ManufacturerController@get');
        Route::post('create', 'ManufacturerController@create');
        Route::patch('update', 'ManufacturerController@update');
        Route::delete('delete', 'ManufacturerController@delete');
    });

    Route::prefix('car-model')->group(function(){
        Route::get('list', 'CarModelController@index');
        Route::get('{id}/get', 'CarModelController@get');
        Route::post('create', 'CarModelController@create');
        Route::patch('update', 'CarModelController@update');
        Route::delete('delete', 'CarModelController@delete');
    });

    Route::prefix('car')->group(function(){
        Route::get('list', 'CarController@index');
        Route::get('{id}/get', 'CarController@get');
        Route::post('create', 'CarController@create');
        Route::patch('update', 'CarController@update');
        Route::delete('delete', 'CarController@delete');
    });


});