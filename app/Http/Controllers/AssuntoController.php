<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assunto;

class AssuntoController extends Controller
{
    public function index()
    {
       
        return Assunto::all();
        
    }
}
