<?php

use Faker\Generator as Faker;

$factory->define(\IVSales\Comment::class, function (Faker $faker) {
    $name_arr = ["Шарий Т.В.","Бондаренко В.И.","Ермоленко Т.В.","Маруга М.М.", "Котенко В.Н.", "Котенко Ю.В.","Володин Н.А.","Толстых В.К."];
    $comments = ["Хороший подход!","Но где же математика?","В этой работе нет актуальности!","Не определен предмет и объект исследования", "База данных без связей", "А откуда берутся входные данны?","Сколько классов в системе хоть?", "Внедрять думаете?"];
    return [
        'text' => $comments[$faker->numberBetween(0,count($comments)-1)],
        'name' => $name_arr[$faker->numberBetween(0,count($name_arr)-1)],
        'email' => $faker->freeEmail,
        'article_id' => $faker->numberBetween(1, 3)
    ];
});
