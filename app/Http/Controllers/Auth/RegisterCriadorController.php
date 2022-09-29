<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criador;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class RegisterCriadorController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cpf_cnpj'=>'required|string|max:14',
            'data_nascimento'=>'required|date',
            'telefone'=>'required|string',
            'email' => 'required|string|email|max:255|unique:criadors',
            'password' => 'required|confirmed',
        ]);
                                       
        $user = Criador::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf_cnpj'=>$request->cpf_cnpj,
            'data_nascimento'=>$request->data_nascimento,
            'telefone'=>$request->telefone,
            'password' => bcrypt($request->password),
        ]);

        //Cria um token

        $token = $user->createToken('primeirotoken')->plainTextToken;

        //Monta um objeto de retorno

        $response = [
            'user' => $user,
            'token'=> $token,
            'vali'=> $validated

        ];

        return response($response,201);
    }
}
