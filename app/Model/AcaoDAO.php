<?php

// https://laravel.com/api/5.3/Illuminate/Database/Query/Builder.html
namespace App\Model;

use DB;
use Laravel\Database\Exception;

class AcaoDAO {

  public function getRules(){
    return array('descricao' => 'required|min:3|max:255',);
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
              ->where('a.id_acao','=',$id)
              ->orderBy('a.id_acao');
    $retorno = $query->get();
    if ($retorno->count() > 0) {
      return $retorno;
    } else {
      return null;
    }
    //dd($query->toSql());
    //dd(DB::getQueryLog());
  }

  // http://v3.golaravel.com/api/class-Exception.html
  public function insert($array){
    try {
      $id = DB::table('acao')->insertGetId($array);
      return (object)array('id' => $id, 'status_code' => 200, 'mensagem' => 'Criado com sucesso');
    } catch (\Exception $e){
      return (object)array('id' => -1, 'status_code' => 500, 'mensagem' => $e->getMessage());
    }
  }

  // Sucesso = 1, Não = 0, Excessão = -1
  public function update($id, $array){
    $model = $this->getById($id);

    if (!$model){
      return (object)array('status_code'=>404,'mensagem'=>'Não encontrado');
    }
    //DB::beginTransaction();
    //dd($array);
    try {
      $affected = DB::table('acao')
                    ->where('id_acao',$id)
                    ->update($array);
        //DB::commit();
        $retorno = ($affected == 1) ? 200 : 204;
        if ($affected == 1) {
          return (object)array('status_code'=>200,'mensagem'=>'Alterado com sucesso');
        } else {
          return (object)array('status_code'=>204,'mensagem'=>'Registro não necessita ser modificado');
        }
    } catch (\Exception $e) {
        //DB::rollback();
        //Campo inválido, erro de sintaxe
        return (object)array('status_code'=>500,'mensagem'=>'Falha ao alterar registro. Erro de sintaxe ou violação de chave'.$e->getMessage());
    }
    return $retorno;
  }

  public function delete($id){
    $affected = DB::table('acao')
                ->where('id_acao',$id)
                ->delete();
    if ($affected == 1) {
      return (object)array('status_code'=>200,'mensagem'=>'Excluído com sucesso');
    } else {
      return (object)array('status_code'=>404,'mensagem'=>'Não encontrado');
    }
  }

  // private function modelolistagem($codemp, $codsec = null, $codprf = null) {
  //
  //   $query = DB::table('empfcn as f')
  //
  //   ->join('cli as c','c.codcli','=','f.codcli')
  //
  //   ->leftJoin('empsec as tbs', function ($join) {
  //       $join->on('tbs.codemp', '=', 'f.codemp')
  //            ->on('tbs.codsec', '=', 'f.codsec');
  //         })
  //
  //   ->leftJoin('empprf as tbp', function ($join) {
  //       $join->on('tbp.codemp', '=', 'f.codemp')
  //            ->on('tbp.codsec', '=', 'f.codsec')
  //            ->on('tbp.codprf', '=', 'f.codprf');
  //         })
  //
  //   ->leftJoin('sec as s','s.codsec', '=', 'f.codsec')
  //   ->leftJoin('prf as p','p.codprf', '=', 'f.codprf')
  //   ->leftJoin('clidet as cd','cd.codcli', '=', 'c.codcli')
  //
  //   ->select( 'f.codcli'
  //              , 'c.nomcli'
  //              , 'c.datnsc'
  //              , 'c.numcrtidt'
  //              , 'cd.endcli'
  //              , 'cd.cmpend'
  //              , 'cd.nombai'
  //              , 'cd.numcep'
  //              , 'cd.nomcid'
  //              , 'cd.estcli'
  //              , 'cd.nomcidnat'
  //              , 'cd.estcidnat'
  //              , 'cd.numddd'
  //              , 'cd.numtel'
  //              , 'cd.idtestciv'
  //              , 'c.idtsex'
  //              , 'f.codemp'
  //              , 'f.codsec'
  //              , 's.dscsec'
  //              , 'f.codprf'
  //              , 'p.dscprf'
  //              , 'f.idtatv'
  //              ,DB::raw("coalesce(tbs.idtatv,'N') as secidtatv")
  //              ,DB::raw("coalesce(tbp.idtatv,'N') as prfidtatv")
  //            );
  //
  //   $query = $query->where('f.codemp','=',$codemp);
  //
  //   if (isset($codsec)){
  //     $query = $query->where('f.codsec','=',$codsec);
  //   }
  //
  //   if (isset($codprf)){
  //     $query = $query->where('f.codprf','=',$codprf);
  //   }
  //
  //   $query = $query->orderBy('c.nomcli', 'asc');
  //
  //    $retorno = $query->get();
  //    //$retorno = $query->paginate(5); // Paginação com 5 registros por página
  //    //dd($retorno);
  //    return $retorno;
  // }


}
