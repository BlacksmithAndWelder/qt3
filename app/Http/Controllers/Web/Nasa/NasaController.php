<?php

namespace App\Http\Controllers\Web\Nasa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class NasaController extends Controller
{
    public function detalhe(){
        try{
            
            $response = Http::withHeaders([ 
                'Accept'=> '*/*',
            ])->withOptions([
                'verify' => false
            ])->get('https://api.nasa.gov/planetary/apod?api_key=v1hq9QBJCJ0KMFnCL9soFRgPWfbluwHXhJyrkTC2'); 
            
            $NasaDetalhe = json_decode($response->body());
            return view('nasa.detalhe', compact('NasaDetalhe'));
        } catch (\Throwable $th) {
            
            Session::put('classe', 'danger');
            Session::put('mensagem', 'Não foi possível realizar requisição API -Nasa!');
            return view('nasa.detalhe');
        }
    }
}
