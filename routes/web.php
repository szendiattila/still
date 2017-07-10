<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('tasks', 'TaskController', ['except' => ['create', 'edit', 'show']]);
Route::patch('tasks/{task}/toggle', 'TaskController@toggleFinished');
Route::get('tasks/toggle-visibility', 'TaskController@toggleVisibility');
