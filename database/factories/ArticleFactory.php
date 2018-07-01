<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'image' => $faker->image(storage_path('app/public/images/articles'),400,300,null, false),
        'body' => $faker->text(200)
    ];
});
