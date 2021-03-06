<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/*$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});*/

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    return [
        'name' => $faker->name,
        'doc' => $faker->cpf(false),
        'bithdate' => $faker->dateTime(),
        'email' => $faker->email
    ];
});

$factory->define(App\Address::class, function() {
    return [
        'lograudoro' => 'R Almirante Brasil',
        'numero' => '100',
        'cep' => '06720-080',
        'cidade' => 'Cotia',
        'complemento' => '',
        'bairro' => 'Parque Mirante da Mata',
        'id_cliente' => 1
    ];
});
