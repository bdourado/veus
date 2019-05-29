<?php

namespace App\Http\Controllers;

use App\Produtos;
use App\Classes\FiltrarStringClass;
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
        $busca = $request->query('q');
        $filtro = $request->query('filter');

        $itensPorPagina = 10;

        if (!empty($filtro)) {
            $filtrarStringClass = new FiltrarStringClass($filtro);

            $campo = $filtrarStringClass->getCampo();
            $valor = $filtrarStringClass->getValor();

            $produtos = Produtos::select('produtos.*', 'marcas.nome as marca')
                ->join('marcas', 'produtos.marca_id', '=', 'marcas.id')
                ->where('produtos.nome', 'like', '%' .  $busca. '%')
                ->where($campo.'.nome', $valor)
                ->orderBy('id', 'asc')
                ->paginate($itensPorPagina);

            return response()->json($produtos, 200);
        }


        $produtos = Produtos::select('produtos.*', 'marcas.nome as marca')
            ->join('marcas', 'produtos.marca_id', '=', 'marcas.id')
            ->where('produtos.nome', 'like', '%' .  $busca. '%')
            ->orderBy('id', 'asc')
            ->paginate($itensPorPagina);

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
    public function show($product,Produtos $produtos)
    {
        $produto = $produtos->find($product);
        return response()->json($produto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function edit($product, Produtos $produtos)
    {
        $produto = $produtos->find($product);
        return response()->json($produto);
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
