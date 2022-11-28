<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Evento;
use App\Models\Criador;
use App\Models\Assunto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\LocalVendaIngresso;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EventosController extends Controller
{
    public function register(Request $request)
    {
        try {

            $request->validate([
                'criador_id' => 'required',
                'titulo_evento' => 'required|string',
                'decricao_evento' => 'required',
                'categoria_id' => 'required',
                'assunto_id' => 'required',
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
                Image::make($request->imagem_evento)->save(storage_path('app/public/images/eventos/' . $imagem_file));
            } else {
                $imagem_file = null;
            }

            $evento = Evento::create([
                'titulo_evento' => $request->titulo_evento,
                'imagem_evento' => $imagem_file,
                'criador_id' => $request->criador_id,
                'decricao_evento' => $request->decricao_evento,
                'categoria_id' => $request->categoria_id,
                'assunto_id' => $request->assunto_id,
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
                'evento' => $evento
            ];

            return response($response, 201);
        } catch (Exception $th) {
            return response()->json([
                "mensagem" => $th->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'criador_id' => 'required',
                'titulo_evento' => 'required|string',
                'decricao_evento' => 'required',
                'categoria_id' => 'required',
                'assunto_id' => 'required',
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

            $evento = Evento::findOrFail($id);

            if ($request->imagem_evento != $evento->imagem_evento) {
                if (Storage::exists('app/public/images/eventos/' . $evento->imagem_evento)) {
                    Storage::disk('public')->delete('app/public/images/eventos/' . $evento->imagem_evento);
                    //Storage::delete('app/public/images/eventos/' .$evento->imagem_evento);
                    // unlink(storage_path('app/public/images/eventos/' . $evento->imagem_file));

                    // $imagem_file = time() . '.' . explode('/', explode(':', substr($request->imagem_evento, 0, strpos($request->imagem_evento, ';')))[1])[1];
                    // Image::make($request->imagem_evento)->save(storage_path('app/public/images/eventos/' . $imagem_file));
                }

                $imagem_file = time() . '.' . explode('/', explode(':', substr($request->imagem_evento, 0, strpos($request->imagem_evento, ';')))[1])[1];
                Image::make($request->imagem_evento)->save(storage_path('app/public/images/eventos/' . $imagem_file));
            } else {
                $imagem_file = $evento->imagem_evento;
            }

            Evento::where('evento_id', $id)->update([
                'titulo_evento' => $request->titulo_evento,
                'imagem_evento' => $imagem_file,
                'criador_id' => $request->criador_id,
                'decricao_evento' => $request->decricao_evento,
                'categoria_id' => $request->categoria_id,
                'assunto_id' => $request->assunto_id,
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
                'msg' => "Evento editado com sucesso",
            ];

            return response($response, 201);
        } catch (Exception $th) {
            return response()->json([
                "mensagem" => $th->getMessage()
            ]);
        }
    }

    public function getEventosByIdCriador($id)
    {
        $criador = Criador::find($id);

        if ($criador) {

            $response = Evento::where('criador_id', $criador->criador_id)->get();

            return response($response, 200);
        } else {
            return response('criador não existe', 500);
        }
    }

    public function indexId($id, $criador_id)
    {
        $criador = Criador::find($criador_id);
        $evento = Evento::find($id);
        if ($criador->criador_id == $evento->criador_id) {
            $response = $evento;

            return response($response, 200);
        } else {
            return response('esse evento nao pertence a esse criador', 400);
        }
    }

    public function getById($id)
    {
        $evento = Evento::find($id);
        if ($evento) {
            $assunto = Assunto::find($evento->assunto_id);
            $categoria = Categoria::find($evento->categoria_id);
            $response = [
                "evento" => $evento,
                "assunto" => $assunto,
                "categoria" => $categoria,
            ];

            return response($response, 200);
        } else {
            return response('esse evento nao pertence a esse criador', 400);
        }
    }


    public function search($name)
    {

        $eventos = Evento::where('titulo_evento', 'LIKE', '%' . $name . '%');

        if ($eventos) {
            return response($eventos, 200);
        } else {
            return response('eventos nao encontrado', 400);
        }
    }

    public function getAllEventos()
    {
        return Evento::all();
    }

    public function getAEventosByLocalization($uf, $cidade)
    {
        $eventos = Evento::where('uf', '=', $uf)->where('cidade', '=', $cidade)->get();

        if ($eventos) {
            return response($eventos, 200);
        } else {
            return response('eventos nao encontrado', 400);
        }
    }

    public function deletar($id){

        $evento = Evento::find($id);

        if ($evento) {

            $ingressos = LocalVendaIngresso::where('evento_id', $evento->evento_id)->get();

            foreach ($ingressos as $value) {
               $value->delete();
            }

            $evento->delete();

            return response('Evento deletado com sucesso', 200);

        }else{
            return response('Evento não existe', 200);
        }
    }

    public function addview(Request $request){

        $evento = Evento::find($request->evento_id);
        $view = $evento->view + 1;
        if ($evento) {
            Evento::where('evento_id', $request->evento_id)->update([
                'view' => $view,
            ]);

            return response('View adicionado com sucesso', 200);

        }else{
            return response('Evento não existe', 200);
        }
    }
}
