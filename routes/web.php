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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
    指定路由
    Route::post('projects', 'ProjectsController@store');

    // 指定路由名（方式一）
    Route::post('projects', 'ProjectsController@store')->name('projects.store');

*/

// 指定路由名（方式二）
// Route::post('projects', ['uses'=>'ProjectsController@store', 'as'=>'projects.store']);
// Route::patch('projects/{project}', ['uses'=>'ProjectsController@update', 'as'=>'projects.update']);
// Route::delete('projects/{project}', ['uses'=>'ProjectsController@destroy', 'as'=>'projects.destroy']);

Route::get('/', 'ProjectsController@index');

Route::resource('projects', 'ProjectsController');

Route::get('tasks/search', 'TasksController@search');
Route::get('tasks/charts', 'TasksController@charts')->name('tasks.charts');
Route::resource('tasks', 'TasksController');

Route::post('tasks/{task}/steps/complete', 'StepController@completeAll');
Route::patch('tasks/{task}/steps/{step}/toggle', 'StepController@toggle');
Route::delete('tasks/{task}/steps/clear', 'StepController@clearAll');
Route::resource('tasks.steps', 'StepController');

Route::post('tasks/{id}/check', 'TasksController@check')->name('tasks.check');