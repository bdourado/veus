<?php

namespace App\Http\Controllers;

use App\Marcas;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    public function index()
    {
        $marcas = Marcas::all();
        return response()->json($marcas, 200);
    }
}
