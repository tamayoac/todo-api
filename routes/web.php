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

$router->group(['prefix' => 'api'], function() use ($router) {
    $router->group(['middleware' => 'api-login'], function() use ($router) {
        $router->post('/login', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
    });
    $router->get('/todos','TodoController@index');
    $router->post('/todos','TodoController@store');
    $router->delete('/todos/{id}','TodoController@destory');
    // $router->post('/company','CompanyController@store');
    // $router->get('/company/{company}','CompanyController@show');
    // $router->put('/company/{company}','CompanyController@update');
    // $router->patch('/company/{company}','CompanyController@update');
   
});