<?php

use Faker\Generator as Faker;

$factory->define(App\Produtos::class, function (Faker $faker) {
    return [
        'nome' => $faker->word,
        'marcas_id' => function () {
            return factory(App\Marcas::class)->create()->id;
        },
        'qtde' => $faker->numberBetween(0,99),
        'preco' => $faker->randomFloat(2,0,999)
    ];
});
