<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criador;
use App\Models\Evento;
use Image;

class EventosController extends Controller
{
    public function register(Request $request)
    {

    

            try {

                $request->validate([
                    'id_criador'=> 'required',
                    'titulo_evento'=>'required|string',
                    'decricao_evento'=>'required',
                    'categoria'=>'required',
                    'assunto'=>'required',
                    'data_inicio' => 'required|date',
                    'hora_inicio' => 'required',
                    'data_termino' => 'required|date',
                    'hora_termino' => 'required',
                    'cep' => 'required',
                    'cidade' => 'required',
                    'uf' => 'required',
                    'lat' => 'required',
                    'lng' => 'required',
    
                ]);
                      
                     if ($request->imagem_evento) {
                        $imagem_file = time() . '.' . explode('/', explode(':', substr($request->imagem_evento, 0, strpos($request->imagem_evento, ';')))[1])[1];

                        Image::make($request->imagem_evento)->save(public_path('images/eventos/' . $imagem_file));
                     }else{
                        $imagem_file = null;
                     }
                     
    
                    $evento = Evento::create([
                        'titulo_evento' => $request->titulo_evento,
                        'imagem_evento' => $imagem_file,
                        'id_criador'=> $request->id_criador,
                        'decricao_evento'=>$request->decricao_evento,
                        'categoria'=>$request->categoria,
                        'assunto'=>$request->assunto,
                        'data_inicio' => $request->data_inicio,
                        'hora_inicio' => $request->hora_inicio,
                        'data_termino' => $request->data_termino,
                        'hora_termino' => $request->hora_termino,
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
                
            } catch (Exception $th) {
                return response()->json([
                    "mensagem"=>$th->getMessage()
                ]);
            }

           
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
