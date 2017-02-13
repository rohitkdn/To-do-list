<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'View\\TaskController@index' );
        Route::post('/', 'View\\TaskController@store');
        Route::put('/{task}', 'View\\TaskController@update');
        Route::delete('/{task}', 'View\\TaskController@destroy');
        Route::patch('/{task}', 'View\\TaskController@restore');
    });
    Route::get('/login', 'Auth\\AuthController@showLoginForm');
    Route::post('/login', 'Auth\\AuthController@login');
    Route::get('/signup', 'Auth\\AuthController@showRegistrationForm');
    Route::post('/signup', 'Auth\\AuthController@register');
    Route::get('/logout', 'Auth\\AuthController@logout');
/*
    Route::group(['prefix' =>'/api', 'middleware' => 'api'], function () {
    Route::post('/authenticate', 'Api\\AuthController@authenticate');

    Route::group(['middleware' => 'auth.api'], function () {
        Route::get('/tasks', ['as' => 'task.index', 'uses' => 'Api\\TaskController@index']);
        Route::get('/tasks/{task}', ['as' => 'task.show', 'uses' => 'Api\\TaskController@show']);
        Route::post('/tasks', ['as' => 'task.store', 'uses' => 'Api\\TaskController@store']);
        Route::put('/tasks/{task}', ['as' => 'task.update', 'uses' => 'Api\\TaskController@update']);
        Route::delete('/tasks/{task}',  ['as' => 'task.destroy', 'uses' => 'Api\\TaskController@destroy']);
    });
});

Route::get('/', 'View\\AuthController@index');
Route::get('/tasks', 'View\\TaskController@index');
*/