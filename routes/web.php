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

// $router->get('/hello', function() use($router){
//     return "Hello world";
// });

// $router->get('/{route:.*}/', function(){
//     return view('app');
// });
$router->get('/', function() use ($router) {
    return view('index');
});
$router->get('api/chats', 'ChatController@index');
$router->post('api/chat', 'ChatController@store');
// $app->delete('api/comment/{id}', 'CommentController@destroy');