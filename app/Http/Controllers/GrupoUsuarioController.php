<?php

namespace App\Http\Controllers;

use App\Model\GrupoUsuarioDAO;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Validator;

class GrupoUsuarioController extends BaseController
{
  //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $dao;

    public function __construct(GrupoUsuarioDAO $dao)
    {
      $this->dao = $dao;
    }

    private function validaErros(Array $campos){
      $erros = array();
      $validator = Validator::make($campos, $this->dao->getRules());

       if ($validator->fails()) {
         $erros = $validator->errors()->all();
       }
       return $erros;
    }

    // GET
    // api/gruposusuarios
    public function index()
    {
      $retorno = $this->dao->listagem();
      return response()->json(['data'=>$retorno],200);
    }

    // GET
    // api/gruposusuarios/123
    public function show($id)
    {
      $retorno = $this->dao->getById($id);
      if (!is_null($retorno)) {
        return response()->json(['data'=>$retorno],200);
      }
      return response()->json(['data'=>[]],404);
    }

    // POST
    // api/gruposusuarios {descricao:"texto"}
    public function save(Request $request)
    {
      $all = $request->all();
      $erros = $this->validaErros($all);
      if (count($erros) > 0){
          return response()->json([ 'id'=>-1,
                                    'status_code'=>400,
                                    'erros'=>$erros]
                                    ,400);
      }
      $retorno = $this->dao->insert($all);

      if ($retorno->id == -1){
        return response()->json(['data'=>[$retorno]],500);
      } else {
        return response()->json(['data'=>[$retorno]],200);
      }
    }

    // PUT
    // api/gruposusuarios/123 {descricao:"texto"}
    public function update(Request $request, $id)
    {
      $all = $request->all();

      $erros = $this->validaErros($all);
      if (count($erros) > 0){
          return response()->json([ 'id'=>-1,
                                    'status_code'=>400,
                                    'erros'=>$erros]
                                    ,400);
      }

      $retorno = $this->dao->update($id,$all);

      $status_code = ($retorno->status_code == 204) ? 200 : $retorno->status_code;
      $url = ($status_code == 200) ? $request->url() : '';

      return response()->json(['data'=>['rota'=>$url,
                                        'mensagem'=>$retorno->mensagem]]
                                ,$status_code);
    }

    // DELETE
    // api/gruposusuarios/123
    public function delete($id)
    {
      $retorno = $this->dao->delete($id);
      return response()->json(['data'=> ['mensagem'=>$retorno->mensagem]]
                              ,$retorno->status_code);
    }
}
