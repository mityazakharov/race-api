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

$router->group(['middleware' => 'auth'], function ()  use ($router) {
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

    // Team
    $router->get('teams', 'TeamController@index');
    $router->post('teams', 'TeamController@store');
    $router->get('teams/{teamId}', 'TeamController@show');
    $router->put('teams/{teamId}', 'TeamController@update');
    $router->delete('teams/{teamId}', 'TeamController@destroy');

    // Athlete
    $router->get('athletes/gender', 'AthleteController@gender');
    $router->get('athletes/rates', 'AthleteController@rates');
    $router->get('athletes', 'AthleteController@index');
    $router->post('athletes', 'AthleteController@store');
    $router->get('athletes/{athleteId}', 'AthleteController@show');
    $router->put('athletes/{athleteId}', 'AthleteController@update');
    $router->delete('athletes/{athleteId}', 'AthleteController@destroy');

    // Group
    $router->get('groups', 'GroupController@index');
    $router->post('groups', 'GroupController@store');
    $router->get('groups/{groupId}', 'GroupController@show');
    $router->put('groups/{groupId}', 'GroupController@update');
    $router->delete('groups/{groupId}', 'GroupController@destroy');

    // Season
    $router->get('seasons', 'SeasonController@index');
    $router->post('seasons', 'SeasonController@store');
    $router->get('seasons/{seasonId}', 'SeasonController@show');
    $router->put('seasons/{seasonId}', 'SeasonController@update');
    $router->delete('seasons/{seasonId}', 'SeasonController@destroy');
});
