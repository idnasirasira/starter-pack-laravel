<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\Models\User::class)->create()->id,
        'title'  => $faker->sentence,
    ];
});
