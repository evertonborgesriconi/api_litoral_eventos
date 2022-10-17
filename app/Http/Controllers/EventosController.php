<?php

namespace App\Http\Controllers\Auth\Criador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function register(Request $request)
    {
        $criador= Criador::find($request->id_criador);

        if($criador){
            $request->validate([
                'imagem_evento' => 'required|image',
                'id_criador'=> 'required',
                'titulo_evento'=>'required|string',
                'decricao_evento'=>'required',
                'categoria'=>'required',
                'assunto'=>'required',
                'data_inicio' => 'required|date',
                'hora_inicio' => 'required|time',
                'data_termino' => 'required|date',
                'hora_termino' => 'required|time',
                'cep' => 'required',
                'cidade' => 'required',
                'uf' => 'required',
                'lat' => 'required',
                'lng' => 'required',
            ]);

            if ($request->hash_file('imagem_evento')) {
            $imagePath = $request->imagem_evento->store('eventos');
            $request->imagem_evento = $imagePath;
            }

                        
            $evento = Evento::create([
                'titulo_evento' => $request->titulo_evento,
                'id_criador'=> $request->id_criador,
                'imagem_evento' => $request->imagem_evento,
                'decricao_evento'=>$request->decricao_evento,
                'categoria'=>$request->categoria,
                'assunto'=>$request->assunto,
                'data_inicio' => $request->data_inicio,
                'hora_inicio' => $request->hora_inicio,
                'data_termino' => $request->data_termino,
                'hora_termino' => $request->data_inicio,
                'cep' => $request->cep,
                'logradouro' => $request->logradouro,
                'bairro' => $request->bairro,
                'numero' => $request->numero,
                'cidade' => $request->cidade,
                'uf' => $request->uf,
                'lat' => $request->lat,
                'lng' => $request->lng,
            
            ]);

            $response = [
                'msg' => "Evento cadastrado com sucesso",
                'evento'=> $evento
            ];

            return response($response,201);
        }
     
        return response('criador não existe', 500);
    }

    public function getEventos($id)
    {
        $criador= Criador::find($id);

        if ($criador) {
            
            $response = $criador->eventos;
              
            return response($response, 200);
        }else{
            return response('criador não existe', 500);
        }
    }

    public function search($name){

        $evento= Evento::where('nome','like','%'.$name.'%')->get();

        

        if ($evento) {
          return response($evento, 200);
        }else{
            return response('eventos nao encontrado', 400);
        }

        //ou tambem

        //$produto= Produto::findOrFail($id);
    }
}
