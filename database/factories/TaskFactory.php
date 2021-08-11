<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Project;
use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'project_id' => function () {
            return factory(Project::class)->create()->id;
        },
        'body' => $faker->sentence(4),
    ];
});
