<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

use Auth;



class LoginController extends Controller
{
  

public function login(Request $request)
  {

    
    $username=$request->get('username');
    $password=$request->get('password');

    $endpoint = "https://login.telco.com.ar/users/login";
    $client = new Client();
   
    try {
    $respuesta = $client->request('POST', $endpoint,
        ['headers' => [
        'Content-Type' => 'application/json'], 
        'body' => json_encode([
            'username' => $username,
            'password' => $password,
            'sistema_id' => '1'
        ])
      ]);
       //esto devuelve un formato de arreglo
    $login = json_decode($respuesta->getBody(), true);
    return $login;
    } catch (ClientException $e) {
        echo Psr7\Message::toString($e->getRequest());
        echo Psr7\Message::toString($e->getResponse());
    }
   
  }




}
