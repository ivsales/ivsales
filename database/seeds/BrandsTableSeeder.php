<?php

use IVSales\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Brand::create([
            'title' => 'СекондХэнд',
            'alias' => 'secondhand'
        ]);
        Brand::create([
            'title' => 'Моднова',
            'alias' => 'modnova'
        ]);
        Brand::create([
            'title' => 'Первый республиканский',
            'alias' => 'perviy-respublikanskiy'
        ]);
        Brand::create([
            'title' => 'Галактика',
            'alias' => 'galaktika'
        ]);
        Brand::create([
            'title' => 'Мост',
            'alias' => 'most'
        ]);
        Brand::create([
            'title' => 'Донецк сити',
            'alias' => 'donetsk-sity'
        ]);
        Brand::create([
            'title' => 'Парус',
            'alias' => 'parys'
        ]);
        Brand::create([
            'title' => 'Хамелеон',
            'alias' => 'hameleon'
        ]);

        Brand::create([
            'title' => 'Фокс',
            'alias' => 'foks'
        ]);
        Brand::create([
            'title' => 'ЦРБ',
            'alias' => 'crb'
        ]);
        Brand::create([
            'title' => 'Всемсмарт',
            'alias' => 'vsemsmart'
        ]);
        Brand::create([
            'title' => 'Донецкое небо',
            'alias' => 'donetskoe-nebo'
        ]);
        Brand::create([
            'title' => 'Японахата',
            'alias' => 'yaponahata'
        ]);
        Brand::create([
            'title' => 'Хмельная Татьяна',
            'alias' => 'hmelnayatatyana'
        ]);
    }
}
