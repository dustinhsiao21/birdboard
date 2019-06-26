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

Route::group(['middleware' => 'auth'], function () {
    Route::get('projects', 'ProjectController@index')->name('project.index');
    Route::get('projects/create', 'ProjectController@create')->name('project.create');
    Route::get('projects/{project}', 'ProjectController@show')->name('project.show');
    Route::post('projects/{project}/update', 'ProjectController@update')->name('project.update');
    Route::post('projects', 'ProjectController@store')->name('project.store');    

    Route::post('projects/{project}/task', 'TaskController@create')->name('project.task.create');
    Route::post('projects/{project}/task/{task}', 'TaskController@update')->name('project.task.update');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
