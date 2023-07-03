<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'employee_id'=>10001,
        'employee_code'=>'EMP_ONE',
        'employee_name'=>$faker->name(),
        'nrc_number'=>$faker->creditCardNumber(),
        'password'=>Hash::make('asdffdsa'),
        'email_address' =>$faker->safeEmail(),
        'gender'=>$faker->numberBetween(1,2),
        'date_of_birth'=>$faker->dateTimeBetween('-40 years','-5 years'),
        'marital_status'=>$faker->numberBetween(1,3),
        'address'=>$faker->address(),
    ];
});
