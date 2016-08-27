<?php

// https://laravel.com/api/5.3/Illuminate/Database/Query/Builder.html
namespace App\Model;

use DB;

class AcaoDAO {

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

  public function insert($array){
    //['email' => 'john@example.com', 'votes' => 0]

    $id = DB::table('acao')->insertGetId(
      $array
    );
    return $id;
  }

  // Sucesso = 1, Não = 0, Excessão = -1
  public function update($id, $array){
    $model = $this->getById($id);
    $retorno = $model ? 200 : 404;
    if ($retorno == 404) {
      return $retorno;
    }
    //DB::beginTransaction();
    try {
      $affected = DB::table('acao')
                    ->where('id_acao',$id)
                    ->update($array);
        //DB::commit();
        $retorno = ($affected == 1) ? 200 : 204;
        // 200 = ok
        // 204 = nada alterado. Conteúdo da alteração era idêntico
    } catch (\Exception $e) {
        //DB::rollback();
        //Campo inválido, erro de sintaxe
        $retorno = 500;
    }
    return $retorno;
  }

  public function delete($id){
    return DB::table('acao')
            ->where('id_acao',$id)
            ->delete();
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
