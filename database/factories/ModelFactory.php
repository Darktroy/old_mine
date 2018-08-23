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

//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    static $password;
//
//    return [
//        'name' => $faker->name,
//        'email' => $faker->safeEmail,
//        'password' => $password ?: $password = bcrypt('123456'),
//        'remember_token' => str_random(10),
//        'image' => $faker->name,
//        'type' => 1
//    ];
//});

$factory->define(App\Call::class, function (Faker\Generator $faker) {

    $for = ['v','i','e'];
    $gender = ['f','m','o'];
    $places = ['o','f','b'];
    return [
        'title' => $faker->sentence(5),
        'for' => $for[rand(0,2)],
        'person' => $faker->name,
        'email' => $faker->companyEmail,
        'task_details' => $faker->text,
        'deadline' => $faker->dateTimeThisDecade,
        'selection' => $faker->dateTimeThisDecade,
        'number' => rand(1,300),
        'working_hours' => rand(1,9),
        'gender' => $gender[rand(0,2)],
        'from' => $faker->dateTimeThisDecade,
        'to' => $faker->dateTimeThisDecade,
        'workplace' => $places[rand(0,2)],
        'benefits'=>$faker->text,
        'more'=>$faker->text,
        'user_id'=>174,
        'status' => rand(0,1),
        'activate' => rand(0,1)
    ];
});

//$factory->define(App\UserCall::class, function(Faker\Generator $faker) {
//    return [
//        'user_id' => 174,
//        'call_id' => $faker->randomElement(App\Call::pluck('id')->toArray()),
//    ];
//});
