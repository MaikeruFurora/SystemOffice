<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transfer;
use Faker\Generator as Faker;

$factory->define(Transfer::class, function (Faker $faker) {
    return [
        "t_id"=>$faker->ean8,
        "t_date"=>$faker->randomElement($array = array ('01/','02/','03/','04/','05/','06/','07/','08/','09/','10/','11/','12/')).$faker->randomElement($array = array ('01/','02/','03/','04/','05/','06/','07/','08/','09/','10/','11/','12/')).$faker->randomElement($array = array ('16','17','18','19','20')),
        "t_fname"=>$faker->firstName($gender = null|'male'|'female'),
        "t_mname"=>$faker->firstName($gender = null|'male'|'female'),
        "t_lname"=>$faker->lastName,
        "t_sname"=>$faker->lastName,
        "t_kapisanan"=>$faker->randomElement($array = array ('kadiwa','Buklod','Binhi')),
        "t_gender"=>$faker->randomElement($array = array ('Male','Female')),
        "t_distrito"=>$faker->city,
        "t_dcode"=>$faker->buildingNumber,
        "t_lokal"=>$faker->streetName,
        "t_lcode"=>$faker->buildingNumber,
        "t_status"=>"In",
        // "t_status"=>$faker->randomElement($array = array ('In','Out')),
    ];
});
