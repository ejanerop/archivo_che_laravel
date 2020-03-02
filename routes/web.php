<?php

use \Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/storage/{folder}/{filename}', 'FileController@getFile')->name('file');
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/test', 'DocumentController@test')->name('test');

Route::resource('research_topic', 'ResearchTopicController');

Route::resource('user', 'UserController')->middleware('user.has.role:admin');

Route::resource('document', 'DocumentController');
Route::get('/document_filter', 'DocumentController@filter')->name('document.filter');

Route::resource('document_type', 'DocumentTypeController');

Route::resource('subtopic', 'SubtopicController');

Route::resource('log', 'LogController')->only([
    'index', 'show'
]);
Route::get('/log_stats', 'LogController@stats')-> name('log.stats');
Route::get('/log_filter', 'LogController@filter')-> name('log.filter');



Route::resource('petition', 'PetitionController')->only(['index', 'create', 'store', 'show', 'destroy']);
Route::get('/petition/accept/{id}', 'PetitionController@acceptPetition')->name('petition.accept');
Route::get('/petition/deny/{id}', 'PetitionController@denyPetition')->name('petition.deny');

Route::get('/profile/{id}', 'UserController@profile')->middleware('user.profile')->name('user.profile');

Route::post('/pass_change/{id}', 'UserController@changePassword')->middleware('user.profile')->name('pass.change');
