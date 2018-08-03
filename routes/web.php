<?php

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

/*$router->get('/', function () use ($router) {
    return $router->app->version();
});*/

$router->group(['prefix' => 'api/v1'], function() use($router){
    $router->get('/clients', 'ClientController@index');
    $router->post('/client', 'ClientController@create');
    $router->get('/client/{id}', 'ClientController@show');
    $router->put('/client/{id}', 'ClientController@update');
    $router->delete('/client/{id}', 'ClientController@destroy');
});
