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

// Auth
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('me', 'AuthController@me');
        $router->post('refresh', 'AuthController@refresh');
        $router->post('logout', 'AuthController@logout');
    });
});

$router->group(['middleware' => 'auth'], function ()  use ($router) {
    // User
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('', 'UserController@index');
        $router->post('', 'UserController@store');
        $router->get('/{userId}', 'UserController@show');
        $router->put('/{userId}', 'UserController@update');
        $router->delete('/{userId}', 'UserController@destroy');
    });

    // Team
    $router->group(['prefix' => 'teams'], function () use ($router) {
        $router->get('', 'TeamController@index');
        $router->post('', 'TeamController@store');
        $router->get('/{teamId}', 'TeamController@show');
        $router->put('/{teamId}', 'TeamController@update');
        $router->delete('/{teamId}', 'TeamController@destroy');
    });

    // Athlete
    $router->group(['prefix' => 'athletes'], function () use ($router) {
        $router->get('/gender', 'AthleteController@gender');
        $router->get('/rates', 'AthleteController@rates');
        $router->get('', 'AthleteController@index');
        $router->post('', 'AthleteController@store');
        $router->get('/{athleteId}', 'AthleteController@show');
        $router->put('/{athleteId}', 'AthleteController@update');
        $router->delete('/{athleteId}', 'AthleteController@destroy');
    });

    // Group
    $router->group(['prefix' => 'groups'], function () use ($router) {
        $router->get('', 'GroupController@index');
        $router->post('', 'GroupController@store');
        $router->get('/{groupId}', 'GroupController@show');
        $router->put('/{groupId}', 'GroupController@update');
        $router->delete('/{groupId}', 'GroupController@destroy');
    });

    // Season
    $router->group(['prefix' => 'seasons'], function () use ($router) {
        $router->get('', 'SeasonController@index');
        $router->post('', 'SeasonController@store');
        $router->get('/{seasonId}', 'SeasonController@show');
        $router->put('/{seasonId}', 'SeasonController@update');
        $router->delete('/{seasonId}', 'SeasonController@destroy');
    });

    // Discipline
    $router->group(['prefix' => 'disciplines'], function () use ($router) {
        $router->get('', 'DisciplineController@index');
        $router->post('', 'DisciplineController@store');
        $router->get('/{disciplineId}', 'DisciplineController@show');
        $router->put('/{disciplineId}', 'DisciplineController@update');
        $router->delete('/{disciplineId}', 'DisciplineController@destroy');
    });
});
