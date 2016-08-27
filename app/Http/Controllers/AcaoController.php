<?php

namespace App\Http\Controllers;


// use App\User;
// use Validator;
// use App\Http\Controllers\Controller;

use App\Model\AcaoDAO;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class AcaoController extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $dao;

    public function __construct(AcaoDAO $dao)
    {
      $this->dao = $dao;
    }

    // APROVADO!!!
    public function index()
    {
      $retorno = $this->dao->listagem();
      //$retorno = 'Teste';
      return response()->json(['data'=>$retorno],200);
    }

    // APROVADO!!!
    public function show($id)
    {
      $retorno = $this->dao->getById($id);
      //$retorno = 'Teste';
      if (!is_null($retorno)) {
        return response()->json(['data'=>$retorno],200);
      }
      return response()->json(['data'=>[]],404);
    }

    // TRATAR RETORNO ADEQUADAMENTE
    public function save(Request $request)
    {
      $all = $request->all();
      //$descricao = $request->input('descricao');

      $retorno = $this->dao->insert($all);

      //request->json()->all();
      //$retorno = $this->dao->getById($id);
      //$retorno = 'POST';
      return response()->json(['data'=>['id'=>$retorno]],200);
    }

    // APROVADO!!!
    public function update(Request $request, $id)
    {
      $all = $request->all();
      //$descricao = $request->input('descricao');
      //request->json()->all();
      //$retorno = $this->dao->getById($id);
      //$retorno = 'PUT';
      $retorno = $this->dao->update($id,$all);
      switch ($retorno) {
        case 200:
        case 204:
            return response()->json(['data'=>['rota'=>$request->url(), 'mensagem'=>'Sucesso '.$retorno]],200);
            break;
        case 404:
          return response()->json(['data'=>['rota'=>'', 'mensagem'=>'Não encontrado']],$retorno);
          break;
        case 500:
          return response()->json(['data'=>['rota'=>'', 'mensagem'=>'Erro de sintaxe']],$retorno);
          break;
        default:
          # code...
          return response()->json(['data'=>['rota'=>'', 'mensagem'=>'Erro não identificado']],$retorno);
          break;
      }
    }

    // TRATAR RETORNO ADEQUADAMENTE
    public function delete($id)
    {
      $retorno = $this->dao->delete($id);
      //$request->path()
      return response()->json(['data'=>['mensagem'=>"Excluído com sucesso"]],200);
    }

}

//$route = Route::current();
//$name = Route::currentRouteName();
//$action = Route::currentRouteAction();
