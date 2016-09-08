<?php

// https://laravel.com/api/5.3/Illuminate/Database/Query/Builder.html
namespace App\Model;

use DB;
use Laravel\Database\Exception;

class GrupoUsuarioDAO {


  public function getRules(){
    return array('descricao' => 'required|min:8|max:64',);
  }


  public function listagem(){
    $query = DB::table('grupo_usuario as tb')
              ->select('tb.id_grupo_usuario', 'tb.descricao')
              ->orderBy('tb.descricao');
    $retorno = $query->get();
    return $retorno;
  }


  public function getById($id){
    $query = DB::table('grupo_usuario as tb')
              ->select('tb.id_grupo_usuario', 'tb.descricao')
              ->where('tb.id_grupo_usuario','=',$id);
    $retorno = $query->get();
    if ($retorno->count() > 0) {
      return $retorno;
    } else {
      return null;
    }
  }


  public function insert($array){
    try {
      $id = DB::table('grupo_usuario')->insertGetId($array);
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
      $affected = DB::table('grupo_usuario')
                    ->where('id_grupo_usuario',$id)
                    ->update($array);
      $retorno = ($affected == 1) ? 200 : 204;
      if ($affected == 1) {
        return (object)array(   'status_code'=>200,
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
    $affected = DB::table('grupo_usuario')
                ->where('id_grupo_usuario',$id)
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
