<?php

use Faker\Generator as Faker;

$factory->define(IVSales\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(rand(3, 6), true),
        'price' => $faker->numberBetween(10, 100),
        'old_price' => rand(1, 5) > 3 ? $faker->numberBetween(100, 1000) : null,
        'quantity' => $faker->numberBetween(1, 50),
        'is_top' => rand(1, 4) > 3 ? 1 : 0,
        'is_new' => rand(1, 4) > 3 ? 1 : 0,
        'img' => 'http://via.placeholder.com/800x500?text=Example+product+image',
        'description' => $faker->text(rand(50, 300)),
        'category_id' => $faker->numberBetween(1, 15),
        'brand_id' => $faker->numberBetween(1, 14),
        'weight' => $faker->randomFloat(3, 0.1, 50),
        'width' => $faker->randomFloat(2, 0.1, 5),
        'height' => $faker->randomFloat(2, 0.1, 5),
        'length' => $faker->randomFloat(2, 0.1, 5),
    ];
});
