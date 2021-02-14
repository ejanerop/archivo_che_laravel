<?php

use Illuminate\Support\Facades\Route;

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



Route::resource('author', 'API\ApiAuthorController')->only(['index', 'store', 'update', 'destroy']);
Route::resource('user', 'API\ApiUserController')->only(['index', 'store', 'show', 'update', 'destroy'])->middleware('cors');
Route::resource('document_type', 'API\ApiDocumentTypeController')->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('research_topic', 'API\ApiResearchTopicController')->only(['index', 'store', 'show', 'update', 'destroy']);

//Users routes------------------------------------------------------------------------------------------
Route::get('/trashed', 'API\ApiUserController@trashed');
Route::post('/trashed/{id}', 'API\ApiUserController@recover');
Route::post('/pass_change/{id}', 'API\ApiUserController@changePassword');
Route::get('/role', 'API\ApiUserController@roles');
