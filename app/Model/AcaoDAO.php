<?php

// https://laravel.com/api/5.3/Illuminate/Database/Query/Builder.html
namespace App\Model;

use DB;
use Laravel\Database\Exception;

class AcaoDAO {


  public function getRules(){
    return array('descricao' => 'required|min:3|max:32',);
  }


  public function listagem(){
    $query = DB::table('acao as a')
              ->select('a.id_acao', 'a.descricao')
              ->orderBy('a.descricao');
    $retorno = $query->get();
    return $retorno;
  }


  public function getById($id){
    $query = DB::table('acao as a')
              ->select('a.id_acao', 'a.descricao')
              ->where('a.id_acao','=',$id);
    $retorno = $query->get();
    if ($retorno->count() > 0) {
      return $retorno;
    } else {
      return null;
    }
  }


  public function insert($array){
    try {
      $id = DB::table('acao')->insertGetId($array);
      return (object)array( 'id' => $id,
                            'status' => 200,
                            'mensagem' => 'Criado com sucesso');
    } catch (\Exception $e){
      return (object)array( 'id' => -1,
                            'status' => 500,
                            'mensagem' => $e->getMessage());
    }
  }


  public function update($id, $array){
    $model = $this->getById($id);

    if (!$model){
      return (object)array( 'status'=>404,
                            'mensagem'=>'Não encontrado');
    }
    try {
      $affected = DB::table('acao')
                    ->where('id_acao',$id)
                    ->update($array);
      $retorno = ($affected == 1) ? 200 : 204;
      if ($affected == 1) {
        return (object)array(   'status'=>200,
                                'mensagem'=>'Alterado com sucesso');
      } else {
          return (object)array( 'status'=>204,
                                'mensagem'=>'Registro não necessita ser modificado');
      }
    } catch (\Exception $e) {
        //Campo inválido, erro de sintaxe
        return (object)array('status'=>500,
            'mensagem'=>'Falha ao alterar registro. Erro de sintaxe ou violação de chave'
            .$e->getMessage());
    }
    return $retorno;
  }


  public function delete($id)
  {
    $affected = DB::table('acao')
                ->where('id_acao',$id)
                ->delete();
    if ($affected == 1) {
      return (object)array( 'status'=>200,
                            'mensagem'=>'Excluído com sucesso');
    } else {
      return (object)array( 'status'=>404,
                            'mensagem'=>'Não encontrado');
    }
  }
}
