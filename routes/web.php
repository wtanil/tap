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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'ProjectController@index');
// Route::get('/home', 'HomeController@index');


// Route::get('/project/create', 'HomeController@create');
// Route::post('/project', 'HomeController@store');
// Route::get('/project/{id}', 'HomeController@show');
// Route::get('/project/{id}/edit', 'HomeController@edit');
// Route::put('/project/{id}', 'HomeController@update');
// Route::delete('/project/{id}', 'HomeController@destroy');

Route::get('/project', 'ProjectController@index');
Route::get('/home', 'ProjectController@index');
Route::get('/project/create', 'ProjectController@create');
Route::post('/project', 'ProjectController@store');
Route::get('/project/{id}/edit', 'ProjectController@edit');
Route::put('/project/{id}/edit', 'ProjectController@update');
Route::get('/project/{id}/active/{active}', 'ProjectController@updateActive');
Route::put('/project/{id}/thumbnail', 'ProjectController@updateThumbnail');
Route::delete('/project/{id}', 'ProjectController@destroy');

// Route::get('/category/store', 'HomeController@createCategory');
Route::post('/category', 'ProjectController@filter');
Route::post('/project/search', 'ProjectController@search');

Route::get('/project/{id}/images/create', 'ImageController@create');
Route::post('/project/{id}/images', 'ImageController@store');
Route::get('/project/{projectId}/images/{imageId}/edit', 'ImageController@edit');
Route::put('/project/{projectId}/images/{imageId}/edit', 'ImageController@update');
Route::delete('/project/{projectId}/images/{imageId}', 'ImageController@destroy');
















