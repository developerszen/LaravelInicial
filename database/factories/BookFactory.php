<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->sentence(3),
        'synopsis' => $faker->paragraph(),
        'image' => $faker->imageUrl(400, 400)
    ];
});