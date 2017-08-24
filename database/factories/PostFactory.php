<?php

use Faker\Generator;
use App\Model\Post;
use App\Model\User;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Post::class, function (Generator $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'author_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
