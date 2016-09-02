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

// Ações
Route::get('acoes','AcaoController@index');
Route::get('acoes/{id}','AcaoController@show');
Route::post('acoes','AcaoController@save');
Route::put('acoes/{id}','AcaoController@update');
Route::delete('acoes/{id}','AcaoController@delete');

// Empresas
Route::get('empresas','EmpresaController@index');
Route::get('empresas/{id}','EmpresaController@show');
Route::post('empresas','EmpresaController@save');
Route::put('empresas/{id}','EmpresaController@update');
Route::delete('empresas/{id}','EmpresaController@delete');

// Tarefas
Route::get('tarefas','TarefaController@index');
Route::get('tarefas/{id}','TarefaController@show');
Route::post('tarefas','TarefaController@save');
Route::put('tarefas/{id}','TarefaController@update');
Route::delete('tarefas/{id}','TarefaController@delete');

// Grupos de Usuários
Route::get('gruposusuarios','GrupoUsuarioController@index');
Route::get('gruposusuarios/{id}','GrupoUsuarioController@show');
Route::post('gruposusuarios','GrupoUsuarioController@save');
Route::put('gruposusuarios/{id}','GrupoUsuarioController@update');
Route::delete('gruposusuarios/{id}','GrupoUsuarioController@delete');

// Usuários
Route::get('usuarios','UsuarioController@index');
Route::get('usuarios/{id}','UsuarioController@show');
Route::post('usuarios','UsuarioController@save');
Route::put('usuarios/{id}','UsuarioController@update');
Route::delete('usuarios/{id}','UsuarioController@delete');

// Arquivos
//Route::get('arquivos','ArquivoController@index');
//Route::get('arquivos/{id}','ArquivoController@show');
Route::post('arquivos','ArquivoController@save');
//Route::put('arquivos/{id}','ArquivoController@update');
//Route::delete('arquivos/{id}','ArquivoController@delete');
