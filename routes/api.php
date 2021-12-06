<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// TODO: Need to protect routes with an API key which identifies the User
// accessing the route... except maybe the route for registering ...
Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    // Sections
    Route::apiResource('sections', 'SectionController');

    // Messages
    Route::apiResource('messages', 'MessageController');

    // Topics
    Route::get('/topics/{topic}/thread', 'TopicThreadController@show');
    Route::apiResource('topics', 'TopicController');


    // Users
    Route::get('/users/{user}/profile', 'UserProfileController@show');
    Route::patch('/users/{user}/profile', 'UserProfileController@update');
    Route::apiResource('users', 'UserController');
});
