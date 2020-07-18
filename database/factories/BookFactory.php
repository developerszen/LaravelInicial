<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

//Obtener GET
//Registror POST
//Actualizar PUT
//Eliminar DELETE

$factory->define(Book::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->unique()->sentence(4),
        'synopsis' => $faker->paragraph(6),
        'image' => $faker->randomElement([null, $faker->imageUrl(400, 400)]),
    ];
});
