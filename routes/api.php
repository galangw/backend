<?php

use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;

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


$router->get('/stories', ['uses' => 'StoryController@index']);
$router->get('/stories/{id}', ['uses' => 'StoryController@show']);
$router->post('/stories', ['uses' => 'StoryController@store']);
$router->put('/stories/{id}', ['uses' => 'StoryController@update']);
$router->delete('/stories/{id}', ['uses' => 'StoryController@destroy']);

$router->get('/stories/{storyId}/chapters', ['uses' => 'ChapterController@index']);
$router->get('/stories/{storyId}/chapters/{chapterId}', ['uses' => 'ChapterController@show']);
$router->post('/stories/{storyId}/chapters', ['uses' => 'ChapterController@store']);
$router->put('/stories/{storyId}/chapters/{chapterId}', ['uses' => 'ChapterController@update']);
$router->delete('/stories/{storyId}/chapters/{chapterId}', ['uses' => 'ChapterController@destroy']);
