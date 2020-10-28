<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () use ($router) {
    return config('app.name') . ' → ' . $router->app->version();
});

// TODO: api version & throttle
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth'], function () {
    Route::post('me', 'AuthController@me');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('logout', 'AuthController@logout');

    // User
    Route::get('users', 'UserController@index');
    Route::post('users', 'UserController@store');
    Route::get('users/{userId}', 'UserController@show');
    Route::put('users/{userId}', 'UserController@update');
    Route::delete('users/{userId}', 'UserController@destroy');
});
