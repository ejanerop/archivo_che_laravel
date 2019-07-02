<?php

use \Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/test', 'DocumentController@test')->name('test');

Route::resource('research_topic', 'ResearchTopicController');

Route::resource('user', 'UserController')->middleware('user.has.role:admin');

Route::resource('document', 'DocumentController');

Route::resource('document_type', 'DocumentTypeController');

Route::resource('subtopic', 'SubtopicController');

Route::get('/profile/{id}', 'UserController@profile')->name('user.profile');

Route::post('/pass_change/{id}', 'UserController@changePassword')->name('pass.change');