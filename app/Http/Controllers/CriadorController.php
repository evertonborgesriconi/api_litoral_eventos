<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criador;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class CriadorController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cpf_cnpj' => 'required|string|max:14',
            'data_nascimento' => 'required|date',
            'telefone' => 'required|string',
            'email' => 'required|string|email|max:255|unique:criadors',
            'password' => 'required|confirmed',
        ]);

        $user = Criador::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf_cnpj' => $request->cpf_cnpj,
            'data_nascimento' => $request->data_nascimento,
            'telefone' => $request->telefone,
            'password' => bcrypt($request->password),
        ]);

        //Cria um token

        $token = $user->createToken('accesstoken')->plainTextToken;

        //Monta um objeto de retorno

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {

        $request->validate([

            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //checka o email do usuario

        $user = Criador::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Credenciais invalidas'
            ], 401);
        }

        $token = $user->createToken('accesstoken')->plainTextToken;

        $response = [
            'criador' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cpf_cnpj' => 'required|string|max:14',
            'data_nascimento' => 'required|date',
            'telefone' => 'required|string',
            'email' => 'required|string|email|max:255|unique:criadors',
            'password' => 'required|confirmed',
        ]);

        Criador::where('criador_id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'cpf_cnpj' => $request->cpf_cnpj,
            'data_nascimento' => $request->data_nascimento,
            'telefone' => $request->telefone,
            'password' => bcrypt($request->password),
        ]);

        //Monta um objeto de retorno

        $response = [
            'msg' => "Dados do criador editado com sucesso",

        ];

        return response($response, 201);
    }

    public function logout()
    {

        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Logout feito com succeso e exclusao dos tokens'
        ]);
    }

    public function indexId($id)
    {
        $criador = Criador::find($id);

        if ($criador) {

            $response = $criador;

            return response($response, 200);
        } else {
            return response('criador não existe', 500);
        }
    }

    public function tokenValidation(Request $request,)
    {

        $request->validate([
            'id' => 'required',
        ]);

        $criador = auth()->user();

        if ($criador->criador_id == $request->id) {
            $response = [
                'status' => 1,
                'criador' => $criador
            ];

            return response($response, 200);
        } else {
            $response = [
                'status' => 2,

            ];
            return response($response, 200);
        }
    }
}
