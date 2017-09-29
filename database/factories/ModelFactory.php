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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    static $password;
//
//    return [
//        'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
//        'remember_token' => str_random(10),
//    ];
//});
//
//$factory->define(App\User::class, function(Faker\Generator $faker){
//    $time = $faker->dateTimeThisMonth;
//    return [
//        'name' => $faker->name,
//        'email' => $faker->email,
//        'password' => bcrypt(str_random(10)),
//        'phone' => $faker->regexify('/^0?(13[0-9]|15[012356789]|18[0-9]|14[57])[0-9]{8}$/'),
//        'created_at' => $time,
//        'updated_at' => $time,
//    ];
//});

$factory->define(App\Quiz::class, function(Faker\Generator $faker){
    $time = $faker->dateTimeThisMonth;
    return [
        'type' => $faker->numberBetween(0,4),
        'title' => $faker->bothify('???'),
        'content' => $faker->bothify('Content ????'),
        'addr' => $faker->regexify('/^([1-2][0-5]{2}\.){3}[1-2][0-5]{2}$/'),
        'value' => $faker->numberBetween(100,500),
        'flag' => $faker->regexify('/^flag\{\w{20}\}$/'),
        'created_at' => $time,
        'updated_at' => $time,
    ];
});
