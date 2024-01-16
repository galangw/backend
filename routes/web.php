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

$router->get('/', function () {
    return redirect('/stories');
});
$router->get('stories', 'StoryController@index');
$router->get('/stories/create', 'StoryController@create');
$router->get('/stories/{id}', 'StoryController@show');
$router->get('/stories/{id}/edit', 'StoryController@edit');
$router->post('/stories', 'StoryController@store');
$router->put('/story/{id}', 'StoryController@update');
$router->delete('/stories/{id}', 'StoryController@destroy');
$router->get('/stories/{id}/chapters/create', 'ChapterController@create');
$router->get('/stories/{storyId}/chapters', 'ChapterController@index');
$router->get('/stories/{storyId}/chapters/{chapterId}', 'ChapterController@show');
$router->get('/stories/{storyId}/chapters/{chapterId}/edit', 'ChapterController@edit');
$router->post('/stories/{storyId}/chapters', 'ChapterController@store');
$router->put('/stories/{storyId}/chapters/{chapterId}', 'ChapterController@update');
$router->delete('/stories/{storyId}/chapters/{chapterId}', 'ChapterController@destroy');
