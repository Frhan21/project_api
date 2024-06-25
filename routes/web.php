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
    return $router->app->version();
});

// Sample Router
$router->get('/sample', 'SampleController@index');
$router->post('/sample', 'SampleController@store');
$router->get('/sample/{id}', 'SampleController@show');
$router->delete('/sample/{id}', 'SampleController@destroy');


// Sensor Router
$router->get('/sensor','SensorController@index');
$router->get('/sensor/{id}', 'SensorController@show');
$router->post('/sensor', 'SensorController@store');
