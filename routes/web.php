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

Route::get('/', 'MainController@collaborator');

Route::post('/more-child', 'MainController@more_child');

Route::match(['get', 'post'], '/collaborators', 'CollaboratorsController@index')->name('collaborators');

Route::get('/positions-search', 'PositionsController@positions_search');

Route::get('/collaborators/create', 'CollaboratorsController@create')->name('collaborators-add');

Route::get('/boss-search', 'CollaboratorsController@boss_search');

Route::get('/collaborators/update/{id}', 'CollaboratorsController@update')->name('collaborator-update');

Route::get('/collaborators/delete/{id}', 'CollaboratorsController@delete')->name('collaborator-delete');

Route::get('/collaborators/view/{id}', 'CollaboratorsController@view')->name('collaborator-view');

Route::post('/save', 'CollaboratorsController@save')->name('save');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

