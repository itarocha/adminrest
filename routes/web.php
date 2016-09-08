<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//      //return view('welcome');
//      return "fala garoto";
// });

// Arquivos
Route::get('baixar','HomeController@getDownload');
//Route::get('arquivos','ArquivoController@index');
//Route::get('arquivos/{id}','ArquivoController@show');
Route::post('upload','ArquivoController@upload');
//Route::put('arquivos/{id}','ArquivoController@update');
//Route::delete('arquivos/{id}','ArquivoController@delete');



Route::get('/', 'HomeController@index');

// This is where the user gets redirected upon clicking the login button on the home page
Route::get('/login', 'HomeController@login');
Route::post('/filter', 'HomeController@filter');

// Shows a list of things that the user can do in the app
Route::get('/dashboard', 'AdminController@index');

// Shows a list of files in the users' Google drive
Route::get('/files', 'AdminController@files');

// Allows the user to search for a file in the Google drive
Route::get('/search', 'AdminController@search');

// Allows the user to upload new files
Route::get('/upload', 'AdminController@upload');
Route::post('/upload', 'AdminController@doUpload');
//Route::get('/baixar', 'AdminController@getDownload');


// Allows the user to delete a file
Route::get('/delete/{id}', 'AdminController@delete');

Route::get('/logout', 'AdminController@logout');
