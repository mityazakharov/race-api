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

$router->get('/', function () use ($router) {
    return config('app.name') . ' → ' . $router->app->version();
});

$router->post('register', 'AuthController@register');
$router->post('login', 'AuthController@login');

$router->group(['middleware' => 'auth'], function ($router) {
    // Auth
    $router->post('me', 'AuthController@me');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('logout', 'AuthController@logout');

    // User
    $router->get('users', 'UserController@index');
    $router->post('users', 'UserController@store');
    $router->get('users/{userId}', 'UserController@show');
    $router->put('users/{userId}', 'UserController@update');
    $router->delete('users/{userId}', 'UserController@destroy');
});
