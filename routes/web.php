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

$router->get('/', function () use ($router) {
    return view('delivery.index');
});

$router->group(['prefix' => 'api/v1'], function() use($router){
    $router->get('/clients', 'ClientController@index');
    $router->post('/clients', 'ClientController@create');
    $router->get('/clients/{id}', 'ClientController@show');
    $router->put('/clients/{id}', 'ClientController@update');
    $router->delete('/clients/{id}', 'ClientController@destroy');
});
