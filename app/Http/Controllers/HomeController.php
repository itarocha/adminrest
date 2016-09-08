<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Googl;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $text = '<p><strong>Lorem</strong> ipsum dolor <h2>Hello</h2></p>';
        return view('login')->with('text',$text);
    }


    public function filter(Request $request){

      //dd($request->all());
      //dd($request->input('produto'));

      $produtos = $request->input('produto');

      $texto = '';

      //dd($produtos);

      foreach($produtos as $produto){
        if ($produto){
          echo($produto.'<br/>');
        }
      }

      $campos = array(  (object) array('descricao' => 'Nome', 'valor' => 'Itamar'),
                        (object) array('descricao' => 'Cidade', 'valor' => 'Uberlândia'),
                        (object) array('descricao' => 'Bairro', 'valor' => 'Jaraguá'),
                      );

      //dd($campos);

      $itens = $request->input('q');
      if ($itens) {
        dd($itens);
        foreach($itens as $item){
          // if ($item['valor']){
          //   echo($item['valor'].'<br/>');
          // }
        }
      }


      return view('login')->with('campos',$campos);
    }


    public function getDownload(){
      //https://laravel.com/docs/5.3/helpers#method-storage-path
      //dd(storage_path('app/arquivos'));

      //$path = public_path()."/download/e568db12f6abfe4cf4a7d6c87381d132.mpga";

      //$path = public_path()."/download/musica.mp3";
      $path = storage_path('app/arquivos')."/e568db12f6abfe4cf4a7d6c87381d132.mpga";

      //dd($path);

      //PDF file is stored under project/public/download/info.pdf
      // https://www.sitepoint.com/web-foundations/mime-types-complete-list/
      //$file= public_path(). "/download/musica.mp3";
      $headers = array(
        'Content-Type: audio/mpeg3',
      );
      return Response::download($path, 'nuevamusik.mp3', $headers);
    }

    public function login(Googl $googl, Request $request)
    {
        $client = $googl->client();

        if ($request->has('code')) {

              $client->authenticate($request->input('code'));

            $token = $client->getAccessToken();

            $plus = new \Google_Service_Plus($client);

            $google_user = $plus->people->get('me');
            $id = $google_user['id'];

            $email = $google_user['emails'][0]['value'];
            $first_name = $google_user['name']['givenName'];
            $last_name = $google_user['name']['familyName'];

            session([
                'user' => [
                    'email' => $email,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'token' => $token
                ]
            ]);

            return redirect('/dashboard')
                ->with('message', ['type' => 'success', 'text' => 'You are now logged in.']);

        } else {
            $auth_url = $client->createAuthUrl();
            return redirect($auth_url);
        }
   }
}
