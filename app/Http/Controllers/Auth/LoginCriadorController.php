<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criador;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class LoginCriadorController extends Controller
{
    public function login(Request $request)
    {
    
     $request -> validate([
         
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
 
         $token = $user->createToken('primeirotoken')->plainTextToken;
 
         $response = [
             'criador' => $user,
             'token'=> $token
         ];
 
         return response($response,201);
 
    }

    public function logout()
    {
 
     auth()->user()->tokens()->delete();
     
     return response([
         'message' => 'Logout feito com succeso e exclusao dos tokens'
     ]);
 
    }
}
