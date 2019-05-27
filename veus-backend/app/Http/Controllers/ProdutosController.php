<?php

namespace App\Http\Controllers;

use App\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $busca = $request->query('busca');
        $filtro = $request->query('filtro');

        $itensPorPagina = 10;

        if (!empty($busca) and empty($filtro)) {

            $produtos = Produtos::where('nome', $busca)
                ->orWhere('marca',$busca)
                ->orWhere('qtde',$busca)
                ->orWhere('preco',$busca)
                ->orderBy('id', 'asc')
                ->paginate($itensPorPagina);

        }else if(empty($busca) and !empty($filtro)){

            $produtos = Produtos::orderBy($filtro, 'asc')
                ->paginate(10);

        }else if(!empty($busca) and !empty($filtro)){

            $produtos = Produtos::where('nome', $busca)
                ->orWhere('marca',$busca)
                ->orWhere('qtde',$busca)
                ->orWhere('preco',$busca)
                ->orderBy($filtro, 'asc')
                ->paginate($itensPorPagina);

        }else{
            $produtos = Produtos::paginate($itensPorPagina);
        }

        return response()->json($produtos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produtos = new Produtos();
        $produtos->fill($request->all());
        $produtos->save();

        return response()->json($produtos, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function show(Produtos $produtos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function edit(Produtos $produtos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function update($product, Request $request, Produtos $produtos)
    {
        $produto = $produtos->find($product);

        if(!$produto) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $produto->fill($request->all());
        $produto->save();

        return response()->json($produto);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function destroy($product, Produtos $produtos)
    {
        $produto = $produtos->find($product);

        if(!$produto) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $produto->delete();
    }
}
