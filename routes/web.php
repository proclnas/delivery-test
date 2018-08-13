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
    
    // Import csv
    $router->post('/clients/import', 'ClientController@import');

    // Entregas
    $router->get('/clients/entregas', 'ClientController@entregas');

    // Truncate clients
    $router->get('/clients/truncate', 'ClientController@truncate');

    // Export
    $router->get('/clients/export', 'ClientController@export');

    $router->get('/address', 'AddressController@index');
    $router->post('/address', 'AddressController@create');
    $router->get('/address/{id}', 'AddressController@show');
    $router->put('/address/{id}', 'AddressController@update');
    $router->delete('/address/{id}', 'AddressController@destroy');

    // Truncate addresses
    $router->get('/address/truncate', 'AddressController@truncate');
});
