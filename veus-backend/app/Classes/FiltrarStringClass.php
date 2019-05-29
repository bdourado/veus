<?php


namespace App\Classes;


class FiltrarStringClass
{

    private $campo = "";

    private $valor = "";

    public function __construct($filtro)
    {
        $this->filtrar($filtro);
    }

    private function filtrar($filtro)
    {
        $filtro = explode(':',$filtro);

        if (isset($filtro[0])){
            if ($filtro[0] == 'brand'){
                $this->campo = 'marcas';
            }else{
                $this->campo = $filtro[0];
            }

        }

        if (isset($filtro[1])){
            $this->valor = $filtro[1];
        }


    }

    /**
     * @return mixed
     */
    public function getCampo()
    {
        return $this->campo;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }


}