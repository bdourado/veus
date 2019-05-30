<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'marcas_id', 'preco', 'qtde'
    ];

    public function marcas()
    {
        return $this->belongsToMany(Marcas::class);
    }
}
