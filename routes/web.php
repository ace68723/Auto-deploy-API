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
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1','namespace' => '\App\Http\Controllers'], function($router)
{

  $router->POST('/auth/login', 'AuthController@loginPost');

  $router->group(['middleware' => 'auth:api'], function($router)
  {
      $router->post('project','ProjectController@createProject');
    	$router->get('project','ProjectController@index');

      $router->post('server','ServerController@createServer');
      $router->get('server','ServerController@index');
      $router->put('server/{id}','ServerController@deleteServer');

      $router->get('mapping','RelationController@index');
  });

  $router->post('githook','ProjectController@githook');
});
