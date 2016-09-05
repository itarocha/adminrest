<?php

namespace App\Http\Controllers;

//use App\Model\AcaoDAO;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Response;
use Validator;

class ArquivoController extends BaseController
{
  //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $dao;

    // public function __construct(AcaoDAO $dao)
    // {
    //   $this->dao = $dao;
    // }

    public function __construct()
    {
    }

    // private function validaErros(Array $campos){
    //   $erros = array();
    //   $validator = Validator::make($campos, $this->dao->getRules());
    //
    //    if ($validator->fails()) {
    //      $erros = $validator->errors()->all();
    //    }
    //    return $erros;
    // }

    // GET
    // api/acoes
    // public function index()
    // {
    //   $retorno = $this->dao->listagem();
    //   return response()->json(['data'=>$retorno],200);
    // }

    // GET
    // api/acoes/123
    // public function show($id)
    // {
    //   $retorno = $this->dao->getById($id);
    //   if (!is_null($retorno)) {
    //     return response()->json(['data'=>$retorno],200);
    //   }
    //   return response()->json(['data'=>[]],404);
    // }

    // public function getDownload(){
    //   $path = public_path()."/download/musica.mp3";
    //
    //   //dd($path);
    //
    //   //PDF file is stored under project/public/download/info.pdf
    //   // https://www.sitepoint.com/web-foundations/mime-types-complete-list/
    //   $file= public_path(). "/download/musica.mp3";
    //   $headers = array(
    //     'Content-Type: audio/mpeg3',
    //   );
    //   return Response::download($path, 'filename.mp3', $headers);
    // }




    // POST
    // api/acoes {descricao:"texto"}
    public function upload(Request $request)
    {

      //curl -F/--form <name=content> Specify HTTP multipart POST data (H)

      // Para isso funcionar, habilite a linha "extension=php_fileinfo.dll" em php.ini.
      // Provavelmente na linha 994

      // Para mandar via curl
      // curl -F "titulo='Arquivo'" -F "arquivo=@d:\file1.jpg" "outro=@d:\outrofile.jpg" http://localhost:8000/arquivos


      // $path = $request->file('avatar')->storeAs(
      //     'avatars', $request->user()->id
      // );

      // $path = Storage::putFileAs(
      //     'avatars', $request->file('avatar'), $request->user()->id
      // );

      // Storage::makeDirectory($directory);
      // Storage::deleteDirectory($directory);
      // $size = Storage::size('file1.jpg');
      // $time = Storage::lastModified('file1.jpg');
      //use Illuminate\Http\File;
      // Automatically calculate MD5 hash for file name...
      //Storage::putFile('photos', new File('/path/to/photo'));

      // Manually specify a file name...
      //Storage::putFile('photos', new File('/path/to/photo'), 'photo.jpg');
      //$contents = Storage::get('file.jpg');
      //$exists = Storage::disk('s3')->exists('file.jpg');

      // Documentação
      // http://v3.golaravel.com/api/class-Symfony.Component.HttpFoundation.File.UploadedFile.html

      //dd($request);
      $arquivos=array();
      if ($request->hasFile('arquivo')){
        $a = array();
        $file = $request->file('arquivo');
        $a['mimeType'] = $file->getClientMimeType();
        $a['clientOriginalName'] = $file->getClientOriginalName();
        $a['size'] = $file->getClientSize().' bytes ';
        $a['maxFilesize'] = $file->getmaxFilesize(); // upload_max_filesize=20M
        $a['linkTarget'] = $file->getLinkTarget();
        $a['isValid'] = $file->isValid();

        // getMaxFilesize( )
        // Returns the maximum size of an uploaded file as configured in php.ini
        // Grava no diretório  .\storage\app\arquivos
        $a['path'] = $request->file('arquivo')->store('arquivos');

        // $file->move('uploads', $file->getClientOriginalName());

        return response()->json($a,200);
      }

      // $erros = $this->validaErros($all);
      // if (count($erros) > 0){
      //     return response()->json([ 'id'=>-1,
      //                               'status_code'=>400,
      //                               'erros'=>$erros]
      //                               ,400);
      // }
      // $retorno = $this->dao->insert($all);
      //
      // if ($retorno->id == -1){
      //   return response()->json(['data'=>[$retorno]],500);
      // } else {
      //   return response()->json(['data'=>[$retorno]],200);
      // }
    }

    // PUT
    // api/acoes/123 {descricao:"texto"}
    // public function update(Request $request, $id)
    // {
    //   $all = $request->all();
    //
    //   $erros = $this->validaErros($all);
    //   if (count($erros) > 0){
    //       return response()->json([ 'id'=>-1,
    //                                 'status_code'=>400,
    //                                 'erros'=>$erros]
    //                                 ,400);
    //   }
    //
    //   $retorno = $this->dao->update($id,$all);
    //
    //   $status_code = ($retorno->status_code == 204) ? 200 : $retorno->status_code;
    //   $url = ($status_code == 200) ? $request->url() : '';
    //
    //   return response()->json(['data'=>['rota'=>$url,
    //                                     'mensagem'=>$retorno->mensagem]]
    //                             ,$status_code);
    // }

    // DELETE
    // api/acoes/123
    // public function delete($id)
    // {
    //   $retorno = $this->dao->delete($id);
    //   return response()->json(['data'=> ['mensagem'=>$retorno->mensagem]]
    //                           ,$retorno->status_code);
    // }
}


// `'google' => [
// 'driver' => 's3',
//  'key' => 'xxx',
//  'secret' => 'xxx',
//  'bucket' => 'qrnotesfiles',
//  'base_url'=>'https://storage.googleapis.com'
// ],`
