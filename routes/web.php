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

$router->get('/todos/{user}','TodoController@index');
$router->post('/todos/{user}','TodoController@store');
$router->get('/todos/{user}/{todo}','TodoController@show');
$router->put('/todos/{user}/{todo}','TodoController@update');
$router->patch('/todos/{user}/{todo}','TodoController@udpate');
$router->delete('/todos/{user}/{todo}','TodoController@destory');

