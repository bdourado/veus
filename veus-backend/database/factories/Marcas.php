<?php

use Faker\Generator as Faker;

$factory->define(App\Marcas::class, function (Faker $faker) {
    return [
        'nome' => $faker->word,
    ];
});
