<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $fillable = [
        'nome'
    ];

    public function produtos()
    {
        return $this->hasMany(Produtos::class);
    }
}
