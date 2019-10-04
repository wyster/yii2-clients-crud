<?php

use yii\helpers\ArrayHelper;
// users.php file under the template path (by default @tests/unit/templates/fixtures)
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$faker->languageCode = 'Ru_RU';

$cities = \app\models\City::find()->orderBy('id asc')->limit(20)->all();
$cities = array_values(ArrayHelper::map($cities, 'id', 'id'));
$randomCity = rand(0, count($cities)-1);
return [
    'name' => $faker->firstName,
    'phone' => preg_replace('/\D/', '', $faker->phoneNumber),
    'city_id' => $cities[$randomCity],
    'vat' => rand(0, 1),
    'description' => $faker->text(),
    'created_at' => $faker->dateTime->format('Y-m-d H:i:s')
];