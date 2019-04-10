<?php

use IVSales\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate([
            'title' => 'ТВ, Аудио\Видео',
            'alias' => 'engine-parts',
            'menu_id' => 1,
            'img' => 'cat_2_lt_5.jpg'
        ]);
        Category::updateOrCreate([
            'title' => 'Спортивные товары',
            'alias' => 'suspension-parts',
            'menu_id' => 2,
            'img' => 'cat_5_lt_5.jpg'
        ]);
        Category::updateOrCreate([
            'title' => 'Часы, украшения, подарки',
            'alias' => 'brake-parts',
            'menu_id' => 3,
            'img' => 'cat_4_lt_5.jpg'
        ]);
        Category::updateOrCreate([
            'title' => 'Бытовая техника',
            'alias' => 'steering-parts',
            'menu_id' => 1,
            'img' => 'cat_1_lt_5.jpg'
        ]);
        Category::updateOrCreate([
                'title' => 'Автомобильные расходники',
            'alias' => 'transmission-parts',
            'menu_id' => 3,
            'img' => 'cat_8_lt_5.jpg'
        ]);
        Category::updateOrCreate([
            'title' => 'Подарочные сертификаты',
            'alias' => 'exhaust-parts',
            'menu_id' => 5,
            'img' => 'cat_6_lt_5.jpg'
        ]);
        Category::updateOrCreate([
            'title' => 'Телефоны, планшеты, гаджеты',
            'alias' => 'body-kits',
            'menu_id' => 1,
            'img' => 'cat_7_lt_5.jpg'
        ]);
        Category::updateOrCreate([
            'title' => 'Красота и здоровье',
            'alias' => 'motor-oil',
            'menu_id' => 2,
            'img' => 'cat_3_lt_5.jpg'
        ]);
        Category::updateOrCreate([
            'title' => 'Авто, мототовары',
            'alias' => 'dvrs',
            'menu_id' => 3
        ]);
        Category::updateOrCreate([
            'title' => 'Компьютерная техника',
            'alias' => 'fire-extinguishers',
            'menu_id' => 1
        ]);
        Category::updateOrCreate([
            'title' => 'Одежда и обувь',
            'alias' => 'interior-mats',
            'menu_id' => 4
        ]);
        Category::updateOrCreate([
            'title' => 'Зоотовары',
            'alias' => 'tires-summer',
            'menu_id' => 4
        ]);
        Category::updateOrCreate([
            'title' => 'Товары для дома и сада',
            'alias' => 'tires-winter',
            'menu_id' => 4
        ]);
        Category::updateOrCreate([
            'title' => 'Офис, школа',
            'alias' => 'tires-all-season',
            'menu_id' => 4
        ]);
        Category::updateOrCreate([
            'title' => 'Детские утренники',
            'alias' => 'disks-cast',
            'menu_id' => 5
        ]);
        Category::updateOrCreate([
            'title' => 'Отдых и туризм',
            'alias' => 'disks-pressed',
            'menu_id' => 2
        ]);
        Category::updateOrCreate([
            'title' => 'Напитки и продукты',
            'alias' => 'headlights',
            'menu_id' => 2
        ]);
        Category::updateOrCreate([
            'title' => 'Музыкальные инстурменты',
            'alias' => 'rear-lights',
            'menu_id' => 4
        ]);
        Category::updateOrCreate([
            'title' => 'Книги',
            'alias' => 'fog-lights',
            'menu_id' => 4
        ]);

    }
}
