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


$router->group(['prefix' => 'api', 'namespace' => 'Api'], function () use ($router) {

    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout', [
        'middleware' => 'auth',
        'uses'       => 'AuthController@logout'
    ]);
    $router->get('me', [
        'middleware' => 'auth',
        'uses'       => 'UserController@show'
    ]);

    // LINKS
    $router->get('links', 'LinkController@index');
    $router->post('links', 'LinkController@store');
    $router->put('links/{link}', 'LinkController@update');
    $router->get('links/{link}', 'LinkController@show');
    $router->delete('links/{link}', 'LinkController@destroy');

    // USER LINKS
    $router->get('user/links', 'UserLinkController@index');

});

$router->get('r/{link}', 'LinkController@show');

$router->get('/{route:.*}/', function ()  {
    return view('app');
});
