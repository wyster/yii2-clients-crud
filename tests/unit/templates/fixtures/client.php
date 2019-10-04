<?php

// users.php file under the template path (by default @tests/unit/templates/fixtures)
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$faker->languageCode = 'Ru_RU';
return [
    'name' => $faker->firstName,
    'phone' => preg_replace('/\D/', '', $faker->phoneNumber),
    'city_id' => \app\models\City::find()->orderBy('RAND()')->one()->id,
    'vat' => rand(0, 1),
    'description' => $faker->text(),
    'created_at' => $faker->dateTime->format('Y-m-d H:i:s')
];