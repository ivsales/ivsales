<?php

use IVSales\Slider;
use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'title' => '<span style="color: white">Скидки на подарок!</span>',
            'description' => 'Лучшие скидки для вас и ваших близких в их день рождения!',
            'img' => 'slide_1_lt_5.jpg',
            'menu_id' => 5
        ]);
        Slider::create([
            'title' => 'Техно-шара!',
            'description' => '<span style="color: white">Стиральные мащины падают в цене!</span>',
            'img' => 'slide_2_lt_5.jpg',
            'menu_id' => 1
        ]);
        Slider::create([
            'title' => '<span style="color: white">Все за ЗОЖ!</span>',
            'description' => 'Всё для активного вида отдыха',
            'img' => 'slide_3_lt_5.jpg',
            'menu_id' => 2
        ]);
    }
}
