<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocalVendaIngresso;
use App\Models\Evento;

class LocalIngressoController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nome_local' => 'required|string|max:255',
            'endereco'=>'required|string|max:255',
            'evento_id'=>'required'
        ]);

        $local = LocalVendaIngresso::create([
            'nome_local' => $request->nome_local,
            'endereco' => $request->endereco,
            'evento_id'=>$request->evento_id,
        ]);

        $response = [
            'msg' => "Local cadastrado com sucesso",
            'local'=> $local
        ];

        return response($response,201);
    }

    public function getLocalByEvento($id)
    {
        $evento = Evento::find($id);

        if ($evento) {

            $response = LocalVendaIngresso::where('evento_id', $evento->evento_id)->get();

            return response($response, 200);
        } else {
            return response('evento não existe', 500);
        }
    }

    public function deletar($id){

        $local = LocalVendaIngresso::find($id);

        if ($local) {

            $local->delete();

            return response('Local deletado com sucesso', 200);

        }else{
            return response('Local não existe', 200);
        }
    }
}
