<?php

use Illuminate\Http\Request;

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


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

	//Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
  //Route::post('authenticate', 'AuthenticateController@authenticate');
  //Route::get('pessoas',['uses' => 'AuthenticateController@xis']);

Route::get('acoes','AcaoController@index');
Route::get('acoes/{id}','AcaoController@show');
Route::post('acoes','AcaoController@save');
Route::put('acoes/{id}','AcaoController@update');
Route::delete('acoes/{id}','AcaoController@delete');
