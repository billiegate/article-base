<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id'       => random_int(1, 2),
        'thumbnail'     => $faker->imageUrl(640, 480, 'animals', true),
        'title'         => $faker->sentence(),
        'description'   => $faker->paragraphs(4, true)
    ];
});