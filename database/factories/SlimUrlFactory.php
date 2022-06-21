<?php

use D0ggy\LaraSlimUrl\Models\SlimUrl;
use Faker\Generator as Faker;

$factory->define(SlimUrl::class, function (Faker $faker) {
    return [
        'url' => $faker->url(),
        'slim_url' => $faker->randomElements(str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 6, false),
    ];
});
