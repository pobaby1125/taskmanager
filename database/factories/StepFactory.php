<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Step;
use Faker\Generator as Faker;
use App\Task;

$factory->define(Step::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'completion' => $faker->boolean(),
        'task_id' => Task::all()->random()->id
    ];
});
